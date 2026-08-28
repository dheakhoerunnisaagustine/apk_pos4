@extends('layouts.app')

@section('title', 'Edit User - Bakery Theme')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<div style="
    background:#FAF4EE;
    min-height:85vh;
    padding:45px 20px;
    font-family:'Poppins', sans-serif;
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
Edit User
</h2>


<p style="
    color:#8C7A6B;
    margin:0;
">
Perbarui informasi akun pengguna
</p>

</div>



<!-- FORM -->

<div style="padding:35px;">


<form action="{{ route('admin.users.update',$user) }}" method="POST">

@csrf
@method('PUT')



<!-- Nama -->

<div style="margin-bottom:20px;">

<label style="
font-weight:600;
color:#5C4838;
">
👤 Nama Lengkap
</label>


<input 
type="text"
name="name"
value="{{old('name',$user->name)}}"
required

style="
width:100%;
margin-top:8px;
padding:14px 16px;
border-radius:14px;
border:1px solid #E3D3C3;
background:#FFF9F4;
font-size:15px;
outline:none;
"
>

</div>



<!-- Email -->

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
value="{{old('email',$user->email)}}"
required

style="
width:100%;
margin-top:8px;
padding:14px 16px;
border-radius:14px;
border:1px solid #E3D3C3;
background:#FFF9F4;
font-size:15px;
"
>

</div>



<!-- Role -->

<div style="margin-bottom:20px;">

<label style="
font-weight:600;
color:#5C4838;
">
🍰 Role User
</label>


<select 
name="role_id"

style="
width:100%;
margin-top:8px;
padding:14px 16px;
border-radius:14px;
border:1px solid #E3D3C3;
background:#FFF9F4;
font-size:15px;
">

@foreach($roles as $role)

<option 
value="{{$role->id}}"
{{$user->role_id==$role->id?'selected':''}}
>
{{$role->name}}
</option>

@endforeach

</select>

</div>




<!-- Password -->

<div style="margin-bottom:25px;">

<label style="
font-weight:600;
color:#5C4838;
">
🔑 Password Baru
</label>


<input 
type="password"
name="password"
placeholder="Kosongkan jika tidak diganti"

style="
width:100%;
margin-top:8px;
padding:14px 16px;
border-radius:14px;
border:1px solid #E3D3C3;
background:#FFF9F4;
font-size:15px;
"
>

</div>



<!-- BUTTON -->

<div style="
display:flex;
justify-content:space-between;
align-items:center;
border-top:1px solid #F0E2D3;
padding-top:25px;
">


<a href="{{route('admin.users')}}"

style="
background:#EFE6DC;
color:#5C4838;
padding:12px 25px;
border-radius:14px;
text-decoration:none;
font-weight:600;
"
>
← Kembali
</a>



<button 
type="submit"

style="
background:#D97736;
color:white;
padding:12px 30px;
border:none;
border-radius:14px;
font-weight:600;
cursor:pointer;
box-shadow:0 8px 18px rgba(217,119,54,.3);
"
>

✨ Simpan

</button>


</div>



</form>


</div>

</div>


</div>

</div>


@endsection