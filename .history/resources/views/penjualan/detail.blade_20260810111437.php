@extends('layouts.app')

@section('title', 'Detail Penjualan - Bakery POS')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


<div style="
    background: #FAF4EE;
    min-height: 90vh;
    padding: 40px 20px;
    font-family: 'Poppins', sans-serif;
">
    <div style="
        max-width: 1100px;
        margin: auto;
    ">

        @if(session('error'))
            <div style="
                background: #F8D7DA;
                color: #842029;
                padding: 15px;
                border-radius: 15px;
                margin-bottom: 20px;
            ">
                {{ session('error') }}
            </div>
        @endif

        <!-- HEADER -->
        <div style="
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        ">
            <div>
                <h2 style="
                    font-family: 'Playfair Display', serif;
                    color: #4A3525;
                    font-weight: 700;
                    margin: 0;
                ">
                    🧾 Detail Penjualan
                </h2>

                <p style="
                    color: #8C7A6B;
                    margin-top: 5px;
                ">
                    Informasi transaksi dan produk yang dibeli.
                </p>
            </div>

            <a href="{{ route('penjualan.index') }}" style="
                background: #EFE6DC;
                color: #5C4838;
                padding: 12px 22px;
                border-radius: 14px;
                text-decoration: none;
                font-weight: 600;
            ">
                ← Kembali
            </a>
        </div>

        <!-- DETAIL CARD -->
        <div style="
            background: white;
            border-radius: 25px;
            border: 1px solid #E8D8C8;
            box-shadow: 0 15px 35px rgba(139, 94, 60, .12);
            overflow: hidden;
            margin-bottom: 25px;
        ">
            <div style="
                padding: 25px;
                background: linear-gradient(135deg, #FFF8F1, #F5E6D8);
                border-bottom: 1px solid #F0E2D3;
            ">
                <h4 style="
                    margin: 0;
                    font-family: 'Playfair Display', serif;
                    color: #4A3525;
                ">
                    🍞 Informasi Transaksi
                </h4>
            </div>

            <div style="padding: 25px;">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <p style="
                            color: #8C7A6B;
                            margin-bottom: 5px;
                        ">
                            Tanggal
                        </p>
                        <h6 style="
                            color: #4A3525;
                            font-weight: 600;
                        ">
                            {{ $penjualan->created_at->format('d-m-Y H:i') }}
                        </h6>
                    </div>

                    <div class="col-md-4 mb-3">
                        <p style="
                            color: #8C7A6B;
                            margin-bottom: 5px;
                        ">
                            Kasir
                        </p>
                        <h6 style="
                            color: #4A3525;
                            font-weight: 600;
                        ">
                            {{ $penjualan->kasir->name ?? '-' }}
                        </h6>
                    </div>

                    <div class="col-md-4 mb-3">
                        <p style="
                            color: #8C7A6B;
                            margin-bottom: 5px;
                        ">
                            Total Pembayaran
                        </p>
                        <h5 style="
                            color: #8B5E3C;
                            font-weight: 700;
                        ">
                            Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- PRODUK CARD -->
        <div style="
            background: white;
            border-radius: 25px;
            border: 1px solid #E8D8C8;
            box-shadow: 0 15px 35px rgba(139, 94, 60, .12);
            overflow: hidden;
        ">
            <div style="
                padding: 25px;
                background: linear-gradient(135deg, #FFF8F1, #F5E6D8);
                border-bottom: 1px solid #F0E2D3;
            ">
                <h4 style="
                    margin: 0;
                    font-family: 'Playfair Display', serif;
                    color: #4A3525;
                ">
                    🥐 Produk Dibeli
                    

