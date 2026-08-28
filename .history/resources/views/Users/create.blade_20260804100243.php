
@extends('layouts.app')

@section('title', 'Tambah User - Bakery POS')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


<div style="
    background:#FAF4EE;
    min-height:85vh;
    padding:45px 20px;
    font-family:'Poppins',sans-serif;
">


<div style="
    max-width:600px;
    margin:auto;
">


<div style="
    background:white;
    border-radius:28px;
    overflow:hidden;
    border:1px solid #E8D8C8;
    box-shadow:0 15px 35px rgba(139,94,60,.15);
">



<!-- HEADER -->

<div style="
    padding:35px 25px;
    text-align:center;
    background:linear-gradient(135deg,#FFF8F1,#F5E6D8);
">


<div style="
    width:70px;
    height:70px;
    background:white;
    border-radius:22px;
    margin:auto;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:35px;
    box-shadow:0 8px 20px rgba(139,94,60,.12);
">
👤
</div>


<h2 style="
    margin-top:15px;
    font-family:'Playfair Display',serif;
    color:#4A3525;
">
Tambah User
</h2>


<p style="
    color:#8C7A6B;
    margin:0;
">
Buat akun baru untuk Admin atau Kasir
</p>


</div>




<!-- FORM -->

<div style="padding:35px;">


<form action="{{ route('admin.users.store') }}" method="POST">

@csrf


@include('users._form')



<div style="
display:flex;
justify-content:space-between;
align-items:center;
border-top:1px solid #F0E2D3;
padding-top:25px;
margin-top:25px;
">


<a href="{{route('admin.users')}}"
style="
background:#EFE6DC;
color:#5C4838;
padding:12px 25px;
border-radius:14px;
text-decoration:none;
font-weight:600;
">
← Kembali
</a>



<button type="submit"
style="
background:#D97736;
color:white;
padding:12px 30px;
border:none;
border-radius:14px;
font-weight:600;
cursor:pointer;
box-shadow:0 8px 18px rgba(217,119,54,.3);
">
✨ Simpan
</button>


</div>


</form>


</div>


</div>


</div>


</div>


@endsection
