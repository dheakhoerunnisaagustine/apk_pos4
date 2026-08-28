@extends('layouts.app') {{-- Sesuaikan dengan layout utama aplikasi Anda --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tentang</h4>
                </div>
                <div class="card-body">
                    <h5>Aplikasi Penjualan & Kasir</h5>
                    <p class="text-muted">Versi 1.0.0</p>
                    <hr>
                    <p>
                        Aplikasi ini dirancang khusus untuk mempermudah proses pencatatan transaksi penjualan, 
                        pengelolaan stok produk, serta memantau laporan kasir secara cepat dan akurat.
                    </p>
                    <p class="mb-0">Dibangun menggunakan framework Laravel.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection