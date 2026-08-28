<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::all();
        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        return view('jenis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        Jenis::create($request->all());

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil ditambahkan.');
    }

    public function edit(Jenis $jenis)
    {
        return view('jenis.edit', compact('jenis'));
    }

    public function update(Request $request, Jenis $jenis)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        $jenis->update($request->all());

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil diperbarui.');
    }

    public function destroy(Jenis $jenis)
    {
        $jenis->delete();
        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil dihapus.');
    }
}