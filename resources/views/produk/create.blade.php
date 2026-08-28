@extends('layouts.app')

@section('title', 'Tambah Produk - Bakery Theme')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<div style="
background:#FAF4EE;
min-height:100vh;
padding:40px 20px;
font-family:'Poppins',sans-serif;
">

    <div style="max-width:850px;margin:auto;">

        <!-- Header -->
        <div style="margin-bottom:25px;">
            <h2 style="
                font-family:'Playfair Display',serif;
                color:#4A3525;
                font-weight:700;
            ">
                🍞 Tambah Produk
            </h2>

            <p style="color:#8C7A6B;">
                Tambahkan produk bakery baru
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

            <form action="{{ route('produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @include('Produk._form')

            </form>

        </div>

    </div>

</div>

@endsection