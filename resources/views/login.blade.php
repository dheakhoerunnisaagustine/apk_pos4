@extends('layouts.app')

@section('title', 'Login - Bakery POS')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


<div style="
min-height:90vh;
background:#FAF4EE;
display:flex;
align-items:center;
justify-content:center;
font-family:'Poppins',sans-serif;
padding:30px;
">


<div style="
width:100%;
max-width:420px;
background:white;
border-radius:30px;
overflow:hidden;
border:1px solid #E8D8C8;
box-shadow:0 15px 35px rgba(139,94,60,.15);
">



<!-- HEADER -->

<div style="
background:linear-gradient(135deg,#FFF8F1,#F5E6D8);
padding:35px 25px;
text-align:center;
">


<div style="
width:70px;
height:70px;
background:white;
border-radius:22px;
display:flex;
align-items:center;
justify-content:center;
margin:auto;
font-size:35px;
box-shadow:0 5px 15px rgba(139,94,60,.15);
">

🥐

</div>


<h2 style="
font-family:'Playfair Display',serif;
color:#4A3525;
margin-top:15px;
">

Bakery POS

</h2>


<p style="
color:#8C7A6B;
font-size:14px;
">

Login untuk mengakses sistem

</p>


</div>





<!-- FORM -->

<div style="padding:35px;">



<form action="{{ route('auth') }}" method="POST">

@csrf



<div style="margin-bottom:20px;">


<label style="
font-weight:600;
color:#5C4838;
">

📧 Email

</label>


<input

type="email"

name="email"

class="form-control"

value="{{ old('email') }}"

placeholder="Masukkan email"

style="
margin-top:8px;
padding:13px 16px;
border-radius:14px;
border:1px solid #E3D3C3;
background:#FAF8F5;
"


>


@error('email')

<div style="
color:#B42318;
font-size:13px;
margin-top:5px;
">

{{ $message }}

</div>

@enderror


</div>






<div style="margin-bottom:25px;">


<label style="
font-weight:600;
color:#5C4838;
">

🔑 Password

</label>



<input

type="password"

name="password"

class="form-control"

placeholder="Masukkan password"

style="
margin-top:8px;
padding:13px 16px;
border-radius:14px;
border:1px solid #E3D3C3;
background:#FAF8F5;
"

>


@error('password')

<div style="
color:#B42318;
font-size:13px;
margin-top:5px;
">

{{ $message }}

</div>

@enderror



</div>





<button type="submit"

style="
width:100%;
background:#D97736;
color:white;
border:none;
padding:14px;
border-radius:16px;
font-weight:600;
font-size:16px;
cursor:pointer;
box-shadow:0 8px 18px rgba(217,119,54,.25);
">

✨ Masuk

</button>




</form>


</div>


</div>


</div>


@endsection