<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Dashboard')

<!-- batas awal isi konten -->
@section('content')

@include('layouts.navbar')

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color:#8B5E3C;">
                🍞 Beranda Bakery 
            </h2>

            <p class="text-muted mb-0">
                Selamat datang,
                <strong class="text-dark">{{ Auth::user()->name }}</strong> 👋
            </p>

            <small class="text-secondary">
                {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
            </small>
        </div>php
    </div>

    <!-- 1. Ringkasan Kartu / Ringkasan Transaksi -->
    <div class="row g-4 mb-4">

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold">Total Penjualan</small>
                        <h4 class="fw-bold text-dark mb-0 fs-4 mt-1">
                            Rp {{ number_format($ringkasan['total_penjualan'] ?? $ringkasan['total_harga'] ?? 0, 0, ',', '.') }}
                        </h4>
                    </div>

                    <div class="fs-1 text-success">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold">Total Transaksi</small>
                        <h4 class="fw-bold text-dark mb-0 fs-4 mt-1">
                            {{ $ringkasan['jumlah_transaksi'] ?? 0 }}
                        </h4>
                    </div>

                    <div class="fs-1 text-primary">
                        <i class="bi bi-cart-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold">Pembayaran Tunai</small>
                        <h4 class="fw-bold text-dark mb-0 fs-4 mt-1">
                            Rp {{ number_format($ringkasan['total_cash'] ?? $ringkasan['total_tunai'] ?? 0, 0, ',', '.') }}
                        </h4>
                    </div>

                    <div class="fs-1 text-warning">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold">Non Tunai</small>
                        <h4 class="fw-bold text-dark mb-0 fs-4 mt-1">
                            Rp {{ number_format($ringkasan['total_non_tunai'] ?? $ringkasan['total_cashless'] ?? 0, 0, ',', '.') }}
                        </h4>
                    </div>

                    <div class="fs-1 text-danger">
                        <i class="bi bi-credit-card"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- 2. Inventory / Stok Produk -->
    <div class="row g-4 mb-4">

        <!-- Produk Stok Rendah -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h6 class="fw-bold mb-0 text-dark">⚠️ Produk Stok Rendah</h6>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-dark fw-bold small text-uppercase">
                                <tr>
                                    <th class="text-center py-2" style="width: 15%;">NO</th>
                                    <th class="py-2">PRODUK</th>
                                    <th class="text-center py-2" style="width: 25%;">STOK</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($produkStokRendah as $produk)
                                <tr>
                                    <td class="text-center text-muted fw-medium">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-1 rounded-pill fw-bold">
                                            {{ $produk->stok }} pcs
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-success py-4 small fw-medium">
                                        ✅ Semua stok masih aman
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk Habis -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h6 class="fw-bold mb-0 text-dark">❌ Produk Habis</h6>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-dark fw-bold small text-uppercase">
                                <tr>
                                    <th class="text-center py-2" style="width: 15%;">NO</th>
                                    <th class="py-2">PRODUK</th>
                                    <th class="text-center py-2" style="width: 25%;">STOK</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($produkStokHabis as $produk)
                                <tr>
                                    <td class="text-center text-muted fw-medium">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger-subtle text-danger-emphasis px-3 py-1 rounded-pill fw-bold">
                                            {{ $produk->stok }} pcs
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-success py-4 small fw-medium">
                                        ✅ Tidak ada produk yang habis
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- 3. Best Seller -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-header bg-white py-3 border-bottom-0 d-flex align-items-center justify-content-between">
            <h6 class="fw-bold mb-0 text-dark">
                🏆 Produk Terlaris
            </h6>
            <span class="badge bg-light text-muted fw-normal">Berdasarkan Total Penjualan</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-dark fw-bold small text-uppercase">
                        <tr>
                            <th class="text-center py-3" style="width: 12%;">RANKING</th>
                            <th class="py-3">NAMA PRODUK</th>
                            <th class="text-center py-3" style="width: 20%;">STOK SISA</th>
                            <th class="text-center py-3" style="width: 20%;">TOTAL TERJUAL</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($produkTerlaris as $index => $produk)
                        <tr>
                            <!-- Ranking dengan Lingkaran Berwarna Khusus -->
                            <td class="text-center">
                                @if($index == 0)
                                    <span class="badge rounded-circle bg-warning text-dark p-2 fs-6 shadow-sm" style="width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">1</span>
                                @elseif($index == 1)
                                    <span class="badge rounded-circle bg-secondary text-white p-2 fs-6 shadow-sm" style="width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">2</span>
                                @elseif($index == 2)
                                    <span class="badge rounded-circle text-white p-2 fs-6 shadow-sm" style="background-color: #cd7f32; width:32px; height:32px; display:inline-flex; align-items:center; justify-content:center;">3</span>
                                @else
                                    <span class="text-muted fw-bold">{{ $index + 1 }}</span>
                                @endif
                            </td>

                            <!-- Nama Produk -->
                            <td class="fw-semibold text-dark fs-6">
                                {{ $produk->nama }}
                            </td>

                            <!-- Stok Sisa -->
                            <td class="text-center">
                                @if($produk->stok <= 5)
                                    <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-1 rounded-pill fw-bold">
                                        {{ $produk->stok }} pcs
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success-emphasis px-3 py-1 rounded-pill fw-bold">
                                        {{ $produk->stok }} pcs
                                    </span>
                                @endif
                            </td>

                            <!-- Total Terjual -->
                            <td class="text-center">
                                <span class="fw-bold fs-6 text-dark">
                                    {{ $produk->total_terjual ?? 0 }}
                                </span>
                                <small class="text-muted">pcs</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4 small">
                                Belum ada data penjualan.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection