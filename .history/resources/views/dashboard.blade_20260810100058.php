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
            <h2 class="fw-bold" style="color:#8B5E3C;">
                🍞 Dashboard Bakery POS
            </h2>

            <p class="text-muted mb-0">
                Selamat datang,
                <strong>{{ Auth::user()->name }}</strong> 👋
            </p>

            <small class="text-secondary">
                {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
            </small>
        </div>
    </div>

    <!-- 1. Ringkasan Kartu / Ringkasan Transaksi -->
    <div class="row g-4 mb-5">

        <div class="col-lg-3 col-md-6">
            <div class="card shadow border-0 rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Penjualan</small>
                        <h4 class="fw-bold text-dark mb-0 fs-3">
                            Rp {{ number_format($ringkasan['total_penjualan'] ?? $ringkasan['total_harga'] ?? 0) }}
                        </h4>
                    </div>

                    <div class="fs-1 text-success">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow border-0 rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Transaksi</small>
                        <h4 class="fw-bold text-dark mb-0 fs-3">
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
            <div class="card shadow border-0 rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Pembayaran Tunai</small>
                        <h4 class="fw-bold text-dark mb-0 fs-3">
                            Rp {{ number_format($ringkasan['total_cash'] ?? $ringkasan['total_tunai'] ?? 0) }}
                        </h4>
                    </div>

                    <div class="fs-1 text-warning">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow border-0 rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Non Tunai</small>
                        <h4 class="fw-bold text-dark mb-0 fs-3">
                            Rp {{ number_format($ringkasan['total_non_tunai'] ?? $ringkasan['total_cashless'] ?? 0) }}
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
    <div class="row g-4 mb-5">

        <!-- Produk Stok Rendah -->
        <div class="col-lg-6">
            <div class="card table-card">
                <div class="card-header">
                    ⚠️ Produk Stok Rendah
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light text-secondary small text-uppercase">
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($produkStokRendah as $index => $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>🍞 {{ $produk->nama }}</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-success py-3">
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
            <div class="card table-card">
                <div class="card-header">
                    ❌ Produk Habis
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse($produkStokHabis as $index => $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>🥐 {{ $produk->nama }}</td>
                                    <td>
                                        <span class="badge bg-danger">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-success py-3">
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
    <div class="card table-card mb-4">
        <div class="card-header">
            🏆 Produk Terlaris
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>Nama Produk</th>
                            <th>Stok</th>
                            <th>Terjual</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($produkTerlaris as $index => $produk)
                        <tr>
                            <td>
                                @if($index==0)
                                    🥇
                                @elseif($index==1)
                                    🥈
                                @elseif($index==2)
                                    🥉
                                @else
                                    {{ $index+1 }}
                                @endif
                            </td>

                            <td class="fw-semibold">
                                {{ $produk->nama }}
                            </td>

                            <td>
                                @if($produk->stok <= 5)
                                    <span class="badge bg-warning text-dark">
                                        {{ $produk->stok }}
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        {{ $produk->stok }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="badge bg-primary">
                                    {{ $produk->total_terjual ?? 0 }} pcs
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
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