@extends('layouts.app')

@section('title', 'Detail Penjualan - Bakery POS')

@section('content')

{{-- Navbar disembunyikan saat dicetak --}}
<div class="no-print">
    @include('layouts.navbar')
</div>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    #receipt-print-area {
        display: none;
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
            width: 58mm;
            margin: 0;
            padding: 5px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            color: #000;
            background: #fff;
        }
    }
</style>

<div style="background: #FAF4EE; min-height: 90vh; padding: 40px 20px; font-family: 'Poppins', sans-serif;" class="no-print">
    <div style="max-width: 1100px; margin: auto;">

        @if(session('error'))
            <div style="background: #F8D7DA; color: #842029; padding: 15px; border-radius: 15px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <!-- HEADER -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h2 style="font-family: 'Playfair Display', serif; color: #4A3525; font-weight: 700; margin: 0;">
                    🧾 Detail Penjualan
                </h2>
                <p style="color: #8C7A6B; margin-top: 5px;">Informasi transaksi dan produk yang dibeli.</p>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="button" onclick="window.print()" style="background: #D97736; color: #ffffff; padding: 12px 22px; border-radius: 14px; border: none; cursor: pointer; font-weight: 600; font-family: 'Poppins', sans-serif;">
                    🖨️ Cetak Struk
                </button>

                <a href="{{ route('penjualan.index') }}" style="background: #EFE6DC; color: #5C4838; padding: 12px 22px; border-radius: 14px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center;">
                    ← Kembali
                </a>
            </div>
        </div>

        <!-- DETAIL CARD -->
        <div style="background: white; border-radius: 25px; border: 1px solid #E8D8C8; box-shadow: 0 15px 35px rgba(139, 94, 60, .12); overflow: hidden; margin-bottom: 25px;">
            <div style="padding: 25px; background: linear-gradient(135deg, #FFF8F1, #F5E6D8); border-bottom: 1px solid #F0E2D3;">
                <h4 style="margin: 0; font-family: 'Playfair Display', serif; color: #4A3525;">
                    🍞 Informasi Transaksi
                </h4>
            </div>

            <div style="padding: 25px;">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <p style="color: #8C7A6B; margin-bottom: 5px;">Tanggal</p>
                        <h6 style="color: #4A3525; font-weight: 600;">{{ $penjualan->created_at->format('d-m-Y H:i') }}</h6>
                    </div>

                    <div class="col-md-3 mb-3">
                        <p style="color: #8C7A6B; margin-bottom: 5px;">Kasir</p>
                        <h6 style="color: #4A3525; font-weight: 600;">{{ $penjualan->kasir->name ?? '-' }}</h6>
                    </div>

                    <div class="col-md-3 mb-3">
                        <p style="color: #8C7A6B; margin-bottom: 5px;">Metode Pembayaran</p>
                        <h6 style="color: #4A3525; font-weight: 600;">
                            <span style="background: #EFE6DC; padding: 4px 10px; border-radius: 8px; font-size: 13px;">
                                {{ $penjualan->metode_pembayaran ?? 'CASH' }}
                            </span>
                        </h6>
                    </div>

                    <div class="col-md-3 mb-3">
                        <p style="color: #8C7A6B; margin-bottom: 5px;">Status</p>
                        <h6 style="font-weight: 600;">
                            <span style="background: #D1E7DD; color: #0F5132; padding: 4px 10px; border-radius: 8px; font-size: 13px;">
                                SELESAI
                            </span>
                        </h6>
                    </div>
                </div>

                <hr style="border-color: #F0E2D3; margin: 15px 0;">

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <p style="color: #8C7A6B; margin-bottom: 5px;">Total Pembayaran</p>
                        <h5 style="color: #8B5E3C; font-weight: 700; margin: 0;">
                            Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                        </h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <p style="color: #8C7A6B; margin-bottom: 5px;">Uang Dibayar (Tunai)</p>
                        <h5 style="color: #4A3525; font-weight: 700; margin: 0;">
                            Rp {{ number_format($penjualan->uang_dibayar ?? $penjualan->total_pembayaran, 0, ',', '.') }}
                        </h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <p style="color: #8C7A6B; margin-bottom: 5px;">Kembalian</p>
                        <h5 style="color: #2E7D32; font-weight: 700; margin: 0;">
                            Rp {{ number_format($penjualan->kembalian ?? 0, 0, ',', '.') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- PRODUK CARD -->
        <div style="background: white; border-radius: 25px; border: 1px solid #E8D8C8; box-shadow: 0 15px 35px rgba(139, 94, 60, .12); overflow: hidden;">
            <div style="padding: 25px; background: linear-gradient(135deg, #FFF8F1, #F5E6D8); border-bottom: 1px solid #F0E2D3;">
                <h4 style="margin: 0; font-family: 'Playfair Display', serif; color: #4A3525;">🥐 Produk Dibeli</h4>
            </div>

            <div style="padding: 25px; overflow-x: auto;">
                <table width="100%" style="border-collapse: collapse;">
                    <thead>
                        <tr style="background: #FAF4EE; color: #5C4838;">
                            <th style="padding: 15px;">No</th>
                            <th style="padding: 15px;">Foto</th>
                            <th style="padding: 15px; text-align: left;">Nama Produk</th>
                            <th style="padding: 15px; text-align: center;">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penjualan->details as $item)
                            <tr style="border-bottom: 1px solid #F0E2D3;">
                                <td style="text-align: center; padding: 15px;">{{ $loop->iteration }}</td>
                                <td style="text-align: center; padding: 15px;">
                                    @if($item->produk && $item->produk->foto)
                                        <img src="{{ asset('storage/'.$item->produk->foto) }}" style="width: 65px; height: 65px; object-fit: cover; border-radius: 15px;">
                                    @else
                                        <div style="width: 65px; height: 65px; background: #F5E6D8; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 25px;">🥐</div>
                                    @endif
                                </td>
                                <td style="padding: 15px; font-weight: 600; color: #4A3525;">
                                    {{ $item->produk->nama ?? '-' }}
                                </td>
                                <td style="padding: 15px; text-align: center; color: #8B5E3C; font-weight: 600;">
                                    Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 30px; color: #8C7A6B;">Belum ada produk 🥖</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


{{-- ========================================================= --}}
{{-- TEMPLATE STRUK UNTUK PRINTER THERMAL (SAAT DICETAK) --}}
{{-- ========================================================= --}}
<div id="receipt-print-area">
    <div style="text-align: center; margin-bottom: 8px;">
        <h3 style="margin: 0; font-size: 14px; font-weight: bold;">HOLLAND BAKERY</h3>
        <p style="margin: 2px 0; font-size: 9px;">Struk Pembayaran POS</p>
    </div>

    <div style="border-top: 1px dashed #000; border-bottom: 1px dashed #000; padding: 4px 0; margin-bottom: 6px; font-size: 9px;">
        <div>No Transaksi: #{{ $penjualan->id }}</div>
        <div>Tanggal: {{ $penjualan->created_at->format('d/m/Y H:i') }}</div>
        <div>Kasir: {{ $penjualan->kasir->name ?? '-' }}</div>
        <div>Metode: {{ $penjualan->metode_pembayaran ?? 'CASH' }}</div>
    </div>

    <div style="margin-bottom: 6px;">
        <table style="width: 100%; font-size: 9px; border-collapse: collapse;">
            @foreach($penjualan->details as $item)
                <tr>
                    <td colspan="2" style="padding-top: 2px;">{{ $item->produk->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div style="border-top: 1px dashed #000; border-bottom: 1px dashed #000; padding: 4px 0; font-size: 9px; margin-bottom: 6px;">
        <div style="display: flex; justify-content: space-between;">
            <span>TOTAL:</span>
            <span>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</span>
        </div>
        <div style="display: flex; justify-content: space-between;">
            <span>TUNAI:</span>
            <span>Rp {{ number_format($penjualan->uang_dibayar ?? $penjualan->total_pembayaran, 0, ',', '.') }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; font-weight: bold;">
            <span>KEMBALIAN:</span>
            <span>Rp {{ number_format($penjualan->kembalian ?? 0, 0, ',', '.') }}</span>
        </div>
    </div>

    <div style="text-align: center; margin-top: 12px; font-size: 9px;">
        <p style="margin: 0;">Terima Kasih</p>
        <p style="margin: 0;">Selamat Menikmati!</p>
    </div>
</div>

@endsection