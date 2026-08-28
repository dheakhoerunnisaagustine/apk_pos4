<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        // Ambil data produk dengan pagination agar $products->firstItem() di view login tidak error
        $products = Produk::paginate(10);

        return view('login', compact('products'));
    }

    public function auth(Request $request)
    {
        // Validasi input email & password
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Selamat Datang, ' . Auth::user()->name);
        }

        // Jika Gagal Login
        return back()->withErrors([
            'email' => 'Email atau Password tidak valid.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah keluar dari aplikasi.');
    }
}