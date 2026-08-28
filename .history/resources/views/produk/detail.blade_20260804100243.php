@extends('layouts.app')

@section('title', 'Detail Produk - Bakery Theme')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<div style="
background:#FAF4EE;
min-height:85vh;
padding:40px 20px;
font-family:'Poppins',sans-serif;
">

    <div style="max-width:900px;margin:auto;">

        <!-- Header -->
        <div style="margin-bottom:30px;">
            <h2 style="
                font-family:'Playfair Display',serif;
                color:#4A3525;
                font-weight:700;
                margin:0;
            ">
                🥐 Detail Produk
            </h2>

            <p style="color:#8C7A6B;margin-top:5px;">
                Informasi lengkap produk bakery
            </p>
        </div>

        <!-- Card -->
        <div style="
            background:white;
            border-radius:25px;
            padding:35px;
            border:1px solid #E8D8C8;
            box-shadow:0 15px 35px rgba(139,94,60,.12);
        ">

            <div style="
                display:flex;
                gap:35px;
                align-items:center;
                flex-wrap:wrap;
            ">

                <!-- Foto -->
                <div>
                    @if($product->foto)
                        <img src="{{ asset('storage/'.$product->foto) }}"
                             style="
                             width:220px;
                             height:220px;
                             object-fit:cover;
                             border-radius:20px;
                             border:4px solid #F5E6D8;
                             ">
                    @else
                        <div style="
                        width:220px;
                        height:220px;
                        background:#F5E6D8;
                        border-radius:20px;
                        display:flex;
                        justify-content:center;
                        align-items:center;
                        font-size:70px;">
                            🥐
                        </div>
                    @endif
                </div>

                <!-- Detail -->
                <div style="flex:1;">

                    <h3 style="
                        font-family:'Playfair Display',serif;
                        color:#4A3525;
                        margin-bottom:25px;
                    ">
                        {{ $product->nama }}
                    </h3>

                    <div style="margin-bottom:18px;">
                        <strong>💰 Harga Beli</strong><br>
                        Rp {{ number_format($product->harga_beli,0,',','.') }}
                    </div>

                    <div style="margin-bottom:18px;">
                        <strong>🏷️ Harga Jual</strong><br>
                        Rp {{ number_format($product->harga_jual,0,',','.') }}
                    </div>

                    <div style="margin-bottom:30px;">
                        <strong>📦 Stok</strong><br>

                        <span style="
                        background:#EFE6DC;
                        color:#5C4838;
                        padding:8px 18px;
                        border-radius:20px;
                        font-weight:600;
                        display:inline-block;
                        margin-top:8px;
                        ">
                            {{ $product->stok }}
                        </span>

                    </div>

                    <a href="{{ route('produk.index') }}"
                       style="
                       display:inline-block;
                       background:#D97736;
                       color:white;
                       padding:12px 28px;
                       border-radius:15px;
                       text-decoration:none;
                       font-weight:600;
                       box-shadow:0 8px 18px rgba(217,119,54,.25);
                       ">
                        ← Kembali
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection