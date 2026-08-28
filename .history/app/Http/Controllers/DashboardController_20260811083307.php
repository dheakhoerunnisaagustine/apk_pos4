<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        // Total penjualan hari ini (Hanya yang bukan 'OPEN')
        $totalPenjualan = Penjualan::whereDate('created_at', $hariIni)
            ->where('status', '!=', 'OPEN')
            ->sum('total_pembayaran');

        // Jumlah transaksi hari ini (Hanya yang bukan 'OPEN')
        $jumlahTransaksi = Penjualan::whereDate('created_at', $hariIni)
            ->where('status', '!=', 'OPEN')
            ->count();

        // Total pembayaran cash (Hanya yang bukan 'OPEN')
        $totalTunai = Penjualan::whereDate('created_at', $hariIni)
            ->where('status', '!=', 'OPEN')
            ->where('metode_pembayaran', 'cash')
            ->sum('total_pembayaran');

        // Total pembayaran non tunai (QRIS + Transfer) (Hanya yang bukan 'OPEN')
        $totalNonTunai = Penjualan::whereDate('created_at', $hariIni)
            ->where('status', '!=', 'OPEN')
            ->whereIn('metode_pembayaran', ['QRIS', 'transfer'])
            ->sum('total_pembayaran');


        // Produk stok rendah (stok 1-5)
        $produkStokRendah = Produk::where('stok', '<=', 5)
            ->where('stok', '>', 0)
            ->get();


        // Produk stok habis
        $produkStokHabis = Produk::where('stok', 0)
            ->get();


        // Produk terlaris
        $produkTerlaris = DB::table('item_penjualan')
            ->join('produk', 'produk.id', '=', 'item_penjualan.produk_id')
            ->select(
                'produk.nama',
                'produk.stok',
                DB::raw('SUM(item_penjualan.kuantitas) as terjual')
            )
            ->groupBy(
                'produk.id',
                'produk.nama',
                'produk.stok'
            )
            ->orderByDesc('terjual')
            ->limit(5)
            ->get();


        return view('dashboard', [

            'tanggalHariIni' => $hariIni,

            'ringkasan' => [
                'total_penjualan'  => $totalPenjualan,
                'jumlah_transaksi' => $jumlahTransaksi,
                'total_tunai'      => $totalTunai,
                'total_non_tunai'  => $totalNonTunai,
            ],

            'produkTerlaris' => $produkTerlaris,
            'produkStokRendah' => $produkStokRendah,
            'produkStokHabis' => $produkStokHabis,

        ]);
    }
}<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        // Total penjualan hari ini (Hanya yang bukan 'OPEN')
        $totalPenjualan = Penjualan::whereDate('created_at', $hariIni)
            ->where('status', '!=', 'OPEN')
            ->sum('total_pembayaran');

        // Jumlah transaksi hari ini (Hanya yang bukan 'OPEN')
        $jumlahTransaksi = Penjualan::whereDate('created_at', $hariIni)
            ->where('status', '!=', 'OPEN')
            ->count();

        // Total pembayaran cash (Hanya yang bukan 'OPEN')
        $totalTunai = Penjualan::whereDate('created_at', $hariIni)
            ->where('status', '!=', 'OPEN')
            ->where('metode_pembayaran', 'cash')
            ->sum('total_pembayaran');

        // Total pembayaran non tunai (QRIS + Transfer) (Hanya yang bukan 'OPEN')
        $totalNonTunai = Penjualan::whereDate('created_at', $hariIni)
            ->where('status', '!=', 'OPEN')
            ->whereIn('metode_pembayaran', ['QRIS', 'transfer'])
            ->sum('total_pembayaran');


        // Produk stok rendah (stok 1-5)
        $produkStokRendah = Produk::where('stok', '<=', 5)
            ->where('stok', '>', 0)
            ->get();


        // Produk stok habis
        $produkStokHabis = Produk::where('stok', 0)
            ->get();


        // Produk terlaris
        $produkTerlaris = DB::table('item_penjualan')
            ->join('produk', 'produk.id', '=', 'item_penjualan.produk_id')
            ->select(
                'produk.nama',
                'produk.stok',
                DB::raw('SUM(item_penjualan.kuantitas) as terjual')
            )
            ->groupBy(
                'produk.id',
                'produk.nama',
                'produk.stok'
            )
            ->orderByDesc('terjual')
            ->limit(5)
            ->get();


        return view('dashboard', [

            'tanggalHariIni' => $hariIni,

            'ringkasan' => [
                'total_penjualan'  => $totalPenjualan,
                'jumlah_transaksi' => $jumlahTransaksi,
                'total_tunai'      => $totalTunai,
                'total_non_tunai'  => $totalNonTunai,
            ],

            'produkTerlaris' => $produkTerlaris,
            'produkStokRendah' => $produkStokRendah,
            'produkStokHabis' => $produkStokHabis,

        ]);
    }
}