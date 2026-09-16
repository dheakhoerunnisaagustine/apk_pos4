<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::with('kasir') // ⬅️ PENTING
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('kasir', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status'  => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%");
            })
            ->orderBy('nama')
            ->get();

        return view('penjualan.pos', [
            'sale'     => $sale,
            'products' => $products,
            'mode'     => 'create'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['details.produk', 'kasir']);

        return view('penjualan.detail', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        abort_if($penjualan->status === 'COMPLETED', 403);

        $penjualan->load('itemPenjualan');
        $products = Produk::orderBy('nama')->get();

        return view('penjualan.pos', [
            'sale'     => $penjualan,
            'products' => $products,
            'mode'     => 'edit'
        ]);
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        // 1. Validasi awal metode pembayaran & uang dibayar (nullable agar fleksibel untuk non-cash)
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS,TRANSFER',
            'uang_dibayar'   => 'nullable|numeric|min:0'
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('errors', 'Transaksi sudah diproses');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang masih kosong');
        }

        // 2. Hitung total belanja dari database
        $total = $penjualan->itemPenjualan()->sum('subtotal');
        $metode = $request->payment_method;
        $uangDibayar = $request->input('uang_dibayar');

        // 3. Logika perhitungan berdasarkan metode pembayaran
        if ($metode === 'CASH') {
            if (empty($uangDibayar)) {
                return back()->with('errors', 'Uang tunai wajib diisi untuk pembayaran CASH!');
            }
            if ($uangDibayar < $total) {
                return back()->with('errors', 'Uang tunai yang dibayarkan kurang dari total pembayaran!');
            }
            $kembalian = $uangDibayar - $total;
        } else {
            // Jika QRIS / TRANSFER, uang dibayar dianggap pas dan kembalian 0
            $uangDibayar = $total;
            $kembalian = 0;
        }

        // 4. Simpan ke database dan ubah status jadi COMPLETED
        DB::transaction(function () use ($penjualan, $metode, $total, $uangDibayar, $kembalian) {
            $penjualan->update([
                'metode_pembayaran' => $metode,
                'total_pembayaran'  => $total,
                'uang_dibayar'      => $uangDibayar,
                'kembalian'         => $kembalian,
                'status'            => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);
        
        // 🔴 JIKA STATUS COMPLETED
        if ($penjualan->status === 'COMPLETED') {
            return redirect()
                ->route('penjualan.show', $penjualan->id)
                ->with('error', 'Penjualan dengan status COMPLETED tidak bisa langsung dihapus. Silakan lihat detail.');
        }

        // 🟢 JIKA STATUS OPEN → BOLEH DIHAPUS
        DB::transaction(function () use ($penjualan) {
            // hapus item penjualan dulu
            $penjualan->details()->delete();

            // hapus penjualan
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Penjualan berhasil dihapus');
    }
}