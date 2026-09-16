@extends('layouts.app')

@section('title', 'POS')

@section('content')

{{-- Navbar disembunyikan saat mode cetak --}}
<div class="no-print">
    @include('layouts.navbar')
</div>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    body {
        background: #FAF4EE;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        border: none;
        border-radius: 22px;
        box-shadow: 0 15px 35px rgba(139, 94, 60, .12);
        overflow: hidden;
    }

    .card-body {
        background: #fff;
    }

    .card-footer {
        background: #FFF8F1;
    }

    .table thead {
        background: #F5E6D8;
    }

    .table th {
        color: #4A3525;
    }

    .btn-primary,
    .btn-success {
        background: #D97736 !important;
        border: none !important;
    }

    .btn-outline-primary {
        border-color: #D97736 !important;
        color: #8B5E3C !important;
    }

    .btn-outline-primary:hover {
        background: #D97736 !important;
        color: white !important;
    }

    .form-control,
    .form-select {
        border-radius: 14px;
    }

    h4 {
        font-family: 'Playfair Display', serif;
        color: #4A3525;
        font-weight: 700;
    }

    /* =========================================
        PENGATURAN CETAK STRUK (THERMAL / POS)
       ========================================= */
    #receipt-print-area {
        display: none; /* Sembunyikan di layar normal */
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .no-print, nav, footer, header {
            display: none !important;
        }

        #receipt-print-area, #receipt-print-area * {
            visibility: visible;
        }

        #receipt-print-area {
            display: block !important;
            position: absolute;
            left: 0;
            top: 0;
            width: 58mm; /* Lebar standar kertas printer thermal */
            margin: 0;
            padding: 5px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            background: #fff;
        }
    }
</style>

@if(session('error'))
    <div class="alert alert-danger mb-3 no-print">
        {{ session('error') }}
    </div>
@endif

<h4 class="my-4 no-print">
    🍞 {{ $mode === 'edit' ? 'Edit Penjualan' : 'Kasir Bakery' }}
</h4>

<div class="row no-print">

    {{-- ===================== PRODUK ===================== --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="max-height:70vh; overflow:auto">

                <form method="GET" action="{{ route('penjualan.create') }}" class="mb-3">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control"
                           placeholder="Cari produk..."
                           onkeyup="this.form.submit()">
                </form>

                @foreach($products as $product)
                    <form method="POST"
                          action="{{ route('itempenjualan.store') }}"
                          class="row mb-2 align-items-center">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="col-7">
                            <button type="submit"
                                    class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                <div class="fw-semibold">{{ $product->nama }}</div>
                                <small class="text-muted">
                                    Rp {{ number_format($product->harga_jual) }}
                                </small>
                            </button>
                        </div>

                        <div class="col-3">
                            <input type="number"
                                   name="quantity"
                                   value="1"
                                   min="1"
                                   class="form-control"
                                   {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}>
                        </div>

                        <div class="col-2">
                            <button type="submit"
                                    class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                +
                            </button>
                        </div>
                    </form>
                @endforeach

            </div>
        </div>
    </div>

    {{-- ===================== KERANJANG ===================== --}}
    <div class="col-md-6">
        <div class="card">

            <div class="card-body p-0">
                <table class="table table-bordered mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th width="80">Qty</th>
                            <th>Subtotal</th>
                            <th width="80" style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($sale->itemPenjualan as $item)
                            <tr>
                                <td>{{ $item->produk->nama }}</td>
                                <td>Rp {{ number_format($item->produk->harga_jual) }}</td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('itempenjualan.update', $item->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="number"
                                               name="quantity"
                                               value="{{ $item->kuantitas }}"
                                               min="1"
                                               class="form-control form-control-sm"
                                               {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}>
                                    </form>
                                </td>
                                <td>Rp {{ number_format($item->subtotal) }}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <form method="POST"
                                          action="{{ route('itempenjualan.destroy', $item->id) }}"
                                          onsubmit="return confirm('Hapus item ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="
                                            width: 38px;
                                            height: 38px;
                                            background: #E8B4A8;
                                            color: #7A2E22;
                                            border: none;
                                            border-radius: 12px;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            cursor: pointer;
                                            font-size: 18px;
                                            margin: 0 auto;
                                        ">
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada produk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <strong>Total: Rp {{ number_format($sale->total_pembayaran) }}</strong>

                <form method="POST"
                      action="{{ route('penjualan.update', $sale->id) }}"
                      class="mt-2"
                      onsubmit="return confirm('Yakin ingin checkout?')">
                    @csrf
                    @method('PUT')

                    <select name="payment_method" id="payment_method" class="form-select mb-2" onchange="togglePaymentInput()">
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    {{-- KOTAK KASIR TUNAI --}}
                    <div id="cash_input_container" class="mb-2" style="display: none;">
                        <label class="form-label mb-1" style="font-size: 13px; font-weight: 500; color: #4A3525;">Uang Tunai (Cash):</label>
                        <input type="number" id="cash_amount" class="form-control mb-1" placeholder="Masukkan jumlah uang..." oninput="hitungKembalian()">
                        <div id="kembalian_info" class="fw-semibold" style="font-size: 13px;"></div>
                    </div>

                    {{-- KODE QRIS (Gunakan qris.jpg) --}}
                    <div id="qris_container" class="mb-2 text-center p-3 bg-white rounded-3 border" style="display: none;">
                        <p class="mb-2 fw-semibold" style="font-size: 13px; color: #4A3525;">Scan QRIS untuk Pembayaran:</p>
                        <img src="{{ asset('images/qris.jpg') }}" alt="QRIS Code" style="width: 150px; height: 150px; object-fit: contain;">
                        <p class="text-muted mt-2 mb-0" style="font-size: 11px;">Silakan scan menggunakan m-Banking atau E-Wallet</p>
                    </div>

                    <button class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        Checkout
                    </button>
                </form>

                {{-- TOMBOL CETAK STRUK (MUNCUL SETELAH STATUS COMPLETED) --}}
                @if($sale->status === 'COMPLETED')
                    <button type="button" onclick="window.print()" class="btn btn-primary w-100 mt-2">
                        🖨️ Cetak Struk
                    </button>
                @endif

                @if(auth()->user()->role->name === 'admin')
                    <form action="{{ route('penjualan.destroy', $sale->id) }}"
                          method="POST"
                          class="mt-2"
                          onsubmit="return confirm('Batalkan transaksi ini?')">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-outline-danger w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            Batalkan Transaksi
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>

</div>


{{-- ========================================================= --}}
{{-- TEMPLATE STRUK UNTUK DICETAK KETIKA TOMBOL PRINT DITEKAN --}}
{{-- ========================================================= --}}
<div id="receipt-print-area">
    <div style="text-align: center; margin-bottom: 10px;">
        <h3 style="margin: 0; font-size: 16px; font-weight: bold;">HOLLAND BAKERY</h3>
        <p style="margin: 2px 0; font-size: 10px;">Kasir Bakery</p>
    </div>

    <div style="border-top: 1px dashed #000; border-bottom: 1px dashed #000; padding: 4px 0; margin-bottom: 6px; font-size: 10px;">
        <div>No Transaksi: #{{ $sale->id }}</div>
        <div>Tanggal: {{ date('d/m/Y H:i') }}</div>
        <div>Kasir: {{ auth()->user()->name ?? 'Kasir' }}</div>
    </div>

    <div style="margin-bottom: 6px;">
        <table style="width: 100%; font-size: 10px; border-collapse: collapse;">
            @foreach($sale->itemPenjualan as $item)
                <tr>
                    <td colspan="3" style="padding-top: 2px;">{{ $item->produk->nama }}</td>
                </tr>
                <tr>
                    <td>{{ $item->kuantitas }} x {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div style="border-top: 1px dashed #000; padding-top: 4px; font-size: 10px;">
        <div style="display: flex; justify-content: space-between;">
            <span>TOTAL:</span>
            <span style="font-weight: bold; float: right;">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span>
        </div>
        <div style="display: flex; justify-content: space-between;">
            <span>Metode:</span>
            <span style="float: right;">{{ $sale->payment_method ?? 'CASH' }}</span>
        </div>
    </div>

    <div style="text-align: center; margin-top: 15px; font-size: 10px;">
        <p style="margin: 0;">Terima Kasih</p>
        <p style="margin: 0;">Selamat Menikmati!</p>
    </div>
</div>


{{-- SCRIPT JAVASCRIPT --}}
<script>
    const totalBelanja = {{ $sale->total_pembayaran }};

    function togglePaymentInput() {
        const paymentMethod = document.getElementById('payment_method').value;
        const cashContainer = document.getElementById('cash_input_container');
        const qrisContainer = document.getElementById('qris_container');
        const cashInput = document.getElementById('cash_amount');

        cashContainer.style.display = 'none';
        qrisContainer.style.display = 'none';
        cashInput.value = '';
        document.getElementById('kembalian_info').innerHTML = '';

        if (paymentMethod === 'CASH') {
            cashContainer.style.display = 'block';
        } else if (paymentMethod === 'QRIS') {
            qrisContainer.style.display = 'block';
        }
    }

    function hitungKembalian() {
        const cashInput = document.getElementById('cash_amount').value;
        const infoDiv = document.getElementById('kembalian_info');

        if (cashInput === '' || isNaN(cashInput)) {
            infoDiv.innerHTML = '';
            return;
        }

        const bayar = parseFloat(cashInput);
        const selisih = bayar - totalBelanja;

        if (selisih < 0) {
            infoDiv.style.color = '#dc3545';
            infoDiv.innerHTML = '⚠️ Uang kurang Rp ' + Math.abs(selisih).toLocaleString('id-ID');
        } else if (selisih === 0) {
            infoDiv.style.color = '#198754';
            infoDiv.innerHTML = '✅ Uang pas!';
        } else {
            infoDiv.style.color = '#198754';
            infoDiv.innerHTML = '💰 Kembalian: Rp ' + selisih.toLocaleString('id-ID');
        }
    }
</script>

@endsection