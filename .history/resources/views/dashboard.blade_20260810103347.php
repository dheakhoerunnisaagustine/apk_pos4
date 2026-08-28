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
    <div class="row g-4 mb-4">

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted fw-semibold">Total Penjualan</small>
                        <h4 class="fw-bold text-dark mb-0 fs-4">
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
                        <h4 class="fw-bold text-dark mb-0 fs-4">
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
                        <h4 class="fw-bold text-dark mb-0 fs-4">
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
                        <h4 class="fw-bold text-dark mb-0 fs-4">
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
                <div class="card-header bg-white py-3 fw-bold border-bottom-0">
                    ⚠️ Produk Stok Rendah
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary small text-uppercase">
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
                                    <td class="fw-semibold">📦 {{ $produk->nama }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-1">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-success py-4 small">
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
                <div class="card-header bg-white py-3 fw-bold border-bottom-0">
                    ❌ Produk Habis
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary small text-uppercase">
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
                                    <td class="fw-semibold">🥐 {{ $produk->nama }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger rounded-pill px-3 py-1">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-success py-4 small">
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
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-header bg-white py-3 fw-bold border-bottom-0">
            🏆 Produk Terlaris
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th class="text-center py-2" style="width: 15%;">RANKING</th>
                            <th class="py-2">NAMA PRODUK</th>
                            <th class="text-center py-2" style="width: 20%;">STOK</th>
                            <th class="text-center py-2" style="width: 20%;">TERJUAL</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($produkTerlaris as $index => $produk)
                        <tr>
                            <td class="text-center fs-5">
                                @if($index == 0)
                                    🥇
                                @elseif($index == 1)
                                    🥈
                                @elseif($index == 2)
                                    🥉
                                @else
                                    <span class="text-muted small fw-bold">{{ $index + 1 }}</span>
                                @endif
                            </td>

                            <td class="fw-semibold text-dark">
                                {{ $produk->nama }}
                            </td>

                            <td class="text-center">
                                @if($produk->stok <= 5)
                                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-semibold">
                                        {{ $produk->stok }}
                                    </span>
                                @else
                                    <span class="badge bg-success px-3 py-1 rounded-pill fw-semibold">
                                        {{ $produk->stok }}
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                <span class="badge bg-primary px-3 py-1 rounded-pill fw-normal">
                                    {{ $produk->total_terjual ?? 0 }} pcs
                                </span>
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