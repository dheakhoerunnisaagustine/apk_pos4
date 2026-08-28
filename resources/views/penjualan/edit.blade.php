@extends('layouts.app')

@section('title', 'Edit Penjualan - Bakery POS')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<div style="
    background:#FAF4EE;
    min-height:90vh;
    padding:40px 20px;
    font-family:'Poppins',sans-serif;
">

    <div style="max-width:1200px;margin:auto;">

        <!-- HEADER -->
        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        ">
            <div>
                <h2 style="
                    font-family:'Playfair Display',serif;
                    color:#4A3525;
                    margin:0;
                    font-weight:700;
                ">
                    ✏️ Edit Penjualan
                </h2>

                <p style="
                    color:#8C7A6B;
                ">
                    Ubah produk dan transaksi bakery.
                </p>
            </div>

            <a href="{{ route('penjualan.index') }}" style="
                background:#EFE6DC;
                color:#5C4838;
                padding:12px 22px;
                border-radius:14px;
                text-decoration:none;
                font-weight:600;
            ">
                ← Kembali
            </a>
        </div>

        <div class="row g-4">

            <!-- PRODUK -->
            <div class="col-md-6">

                <div style="
                    background:white;
                    border-radius:25px;
                    border:1px solid #E8D8C8;
                    box-shadow:0 15px 35px rgba(139,94,60,.12);
                    overflow:hidden;
                ">

                    <div style="
                        padding:25px;
                        background:linear-gradient(135deg,#FFF8F1,#F5E6D8);
                    ">
                        <h4 style="
                            font-family:'Playfair Display',serif;
                            color:#4A3525;
                            margin:0;
                        ">
                            🥐 Pilih Produk
                        </h4>
                    </div>

                    <div style="
                        padding:25px;
                    ">

                        <form method="GET" action="{{ route('penjualan.edit',$penjualan->id) }}">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." style="
                                width:100%;
                                padding:13px;
                                border-radius:14px;
                                border:1px solid #E3D3C3;
                                background:#FFF9F4;
                                margin-bottom:20px;
                            ">
                        </form>

                        @foreach($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" style="
                                margin-bottom:12px;
                            ">
                                @csrf

                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <button type="submit" style="
                                    width:100%;
                                    padding:15px;
                                    border-radius:15px;
                                    border:1px solid #E8D8C8;
                                    background:#FAF4EE;
                                    text-align:left;
                                    cursor:pointer;
                                ">
                                    <b style="color:#4A3525;">
                                        {{ $product->nama }}
                                    </b>

                                    <br>

                                    <span style="
                                        color:#8B5E3C;
                                    ">
                                        Rp {{ number_format($product->harga_jual,0,',','.') }}
                                    </span>
                                </button>
                            </form>
                        @endforeach

                    </div>

                </div>

            </div>

            <!-- KERANJANG -->
            <div class="col-md-6">

                <div style="
                    background:white;
                    border-radius:25px;
                    border:1px solid #E8D8C8;
                    box-shadow:0 15px 35px rgba(139,94,60,.12);
                    overflow:hidden;
                ">

                    <div style="
                        padding:25px;
                        background:linear-gradient(135deg,#FFF8F1,#F5E6D8);
                    ">
                        <h4 style="
                            font-family:'Playfair Display',serif;
                            color:#4A3525;
                            margin:0;
                        ">
                            🛒 Keranjang
                        </h4>
                    </div>

                    <div style="padding:25px;">

                        @forelse($penjualan->details as $item)
                            <div style="
                                display:flex;
                                justify-content:space-between;
                                align-items:center;
                                padding:15px;
                                background:#FAF4EE;
                                border-radius:15px;
                                margin-bottom:12px;
                            ">
                                <div>
                                    <b style="color:#4A3525;">
                                        {{ $item->produk->nama }}
                                    </b>

                                    <br>

                                    <span style="color:#8B5E3C;">
                                        Rp {{ number_format($item->harga_satuan,0,',','.') }}
                                    </span>
                                </div>

                                <form action="{{ route('itempenjualan.destroy',$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button style="
                                        width:35px;
                                        height:35px;
                                        border:none;
                                        border-radius:10px;
                                        background:#E8B4A8;
                                        cursor:pointer;
                                    ">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p style="text-align:center;color:#8C7A6B;">
                                Belum ada produk
                            </p>
                        @endforelse

                        <hr>

                        <h4 style="
                            color:#8B5E3C;
                        ">
                            Total: Rp {{ number_format($penjualan->total_pembayaran,0,',','.') }}
                        </h4>

                        <form action="{{ route('penjualan.update',$penjualan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <select name="payment_method" style="
                                width:100%;
                                padding:12px;
                                border-radius:14px;
                                border:1px solid #E3D3C3;
                                margin-bottom:15px;
                            ">
                                <option value="">
                                    Pilih Pembayaran
                                </option>
                                <option value="CASH">
                                    Cash
                                </option>
                                <option value="QRIS">
                                    QRIS
                                </option>
                                <option value="TRANSFER">
                                    Transfer
                                </option>
                            </select>

                            <button style="
                                width:100%;
                                background:#D97736;
                                color:white;
                                padding:14px;
                                border:none;
                                border-radius:15px;
                                font-weight:600;
                            ">
                                ✨ Simpan Perubahan
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection