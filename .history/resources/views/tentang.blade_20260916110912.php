@extends('layouts.app') {{-- Sesuaikan dengan layout utama aplikasi Anda --}}

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header text-white text-center py-4" style="background: #8B5E3C;">
                    <h3 class="mb-0 fw-bold">Tentang Aplikasi</h3>
                    <p class="mb-0 text-white-50">Informasi detail mengenai sistem dan pengembang</p>
                </div>
                
                <div class="card-body p-4 p-md-5 bg-white">
                    
                    {{-- Bagian Foto dan Nama Pengembang --}}
                    <div class="text-center mb-5">
                        <img src="{{ asset('images/foto.jpeg') }}" alt="Foto Pengembang"
                       
                            class="rounded-circle shadow mb-3 border border-3 border-light" 
                            style="width: 150px; height: 150px; object-fit: cover;">
                        
                        <h4 class="fw-bold mb-1">Dhea Khoerun Nisa Agustine</h4>
                        <p class="text-muted">Full Stack Developer / Mahasiswa / Programmer</p>
                    </div>

                    <hr class="text-muted my-4">

                    {{-- Informasi Pengembangan Aplikasi --}}
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">
                            <i class="bi bi-laptop me-2" style="color: #8B5E3C;"></i>Pengembangan Aplikasi
                        </h5>
                        <p class="text-secondary" style="text-align: justify;">
                            Aplikasi <strong>Holland Bakery Management System</strong> ini dikembangkan sebagai solusi digital untuk mempermudah pengelolaan produk, pencatatan transaksi penjualan, serta manajemen pengguna secara efisien dan terstruktur.
                        </p>
                    </div>

                    {{-- Teknologi yang Digunakan --}}
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">
                            <i class="bi bi-cpu me-2" style="color: #8B5E3C;"></i>Teknologi yang Digunakan
                        </h5>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-danger px-3 py-2 fs-6">Laravel 12</span>
                            <span class="badge bg-primary px-3 py-2 fs-6">PHP 8+</span>
                            <span class="badge bg-info text-dark px-3 py-2 fs-6">Bootstrap 5</span>
                            <span class="badge bg-secondary px-3 py-2 fs-6">MySQL</span>
                            <span class="badge bg-dark px-3 py-2 fs-6">HTML5 & CSS3</span>
                        </div>
                    </div>

                    {{-- Informasi Kontak / Pengembang --}}
                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-3">
                            <i class="bi bi-person-badge me-2" style="color: #8B5E3C;"></i>Informasi Pengembang
                        </h5>
                        <ul class="list-unstyled text-secondary">
                            <li class="mb-2"><i class="bi bi-envelope me-2"></i> Email: emailanda@domain.com</li>
                            <li class="mb-2"><i class="bi bi-github me-2"></i> GitHub: github.com/usernameanda</li>
                            <li class="mb-2"><i class="bi bi-instagram me-2"></i> Instagram: @usernameanda</li>
                        </ul>
                    </div>

                    {{-- Tombol Kembali sesuai desain gambar --}}
                    <div class="text-center mt-5">
                        <a href="{{ route('dashboard') }}" class="btn px-4 py-2 rounded-pill fw-semibold shadow-sm" style="background-color: #EFECE6; color: #4A403A; border: none;">
                            &larr; Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection