@extends('layouts.app')

@section('title', 'Produk - Bakery Theme')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


<div style="
background:#FAF4EE;
min-height:85vh;
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
font-weight:700;
margin:0;
">
🍞 Manajemen Produk
</h2>


<p style="
color:#8C7A6B;
margin-top:5px;
">
Kelola produk bakery, harga dan stok
</p>

</div>



@can('create', App\Models\Produk::class)

<a href="{{ route('produk.create') }}"

style="
background:#D97736;
color:white;
padding:12px 25px;
border-radius:14px;
text-decoration:none;
font-weight:600;
box-shadow:0 8px 18px rgba(217,119,54,.25);
">

➕ Tambah Produk

</a>

@endcan


</div>





<!-- CARD -->

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
border-bottom:1px solid #F0E2D3;
">

<h4 style="
margin:0;
font-family:'Playfair Display',serif;
color:#4A3525;
">
🥐 Daftar Produk
</h4>

</div>




<!-- SEARCH -->

<div style="padding:25px;">

<form action="{{route('produk.index')}}" method="GET">

<div style="
display:flex;
gap:10px;
">

<input
type="text"
name="search"
value="{{request('search')}}"
placeholder="Cari nama produk..."

style="
flex:1;
padding:13px 16px;
border-radius:14px;
border:1px solid #E3D3C3;
background:#FFF9F4;
">


<button

style="
background:#8B5E3C;
color:white;
border:none;
padding:13px 22px;
border-radius:14px;
font-weight:600;
">

🔍 Cari

</button>


</div>

</form>

</div>




<div style="overflow-x:auto;padding:0 25px 25px;">


<table width="100%" style="border-collapse:collapse;">


<thead>

<tr style="
background:#FAF4EE;
color:#5C4838;
">

<th style="padding:15px;">No</th>
<th style="padding:15px;">Foto</th>
<th style="padding:15px;text-align:left;">Nama</th>
<th style="padding:15px;">Harga Beli</th>
<th style="padding:15px;">Harga Jual</th>
<th style="padding:15px;">Stok</th>
<th style="padding:15px;">Aksi</th>

</tr>

</thead>



<tbody>


@forelse($products as $product)


<tr style="
border-bottom:1px solid #F0E2D3;
">


<td style="text-align:center;padding:15px;">
{{ $products->firstItem()+$loop->index }}
</td>



<td style="text-align:center;padding:15px;">


@if($product->foto)

<img src="{{asset('storage/'.$product->foto)}}"

style="
width:70px;
height:70px;
object-fit:cover;
border-radius:18px;
">


@else

<div style="
width:70px;
height:70px;
background:#F5E6D8;
border-radius:18px;
display:flex;
align-items:center;
justify-content:center;
font-size:30px;
">
🥐
</div>

@endif


</td>




<td style="
padding:15px;
font-weight:600;
color:#4A3525;
">

{{$product->nama}}

<br>

<small style="color:#8C7A6B;">
{{$product->user->name}}
</small>

</td>




<td style="text-align:center;padding:15px;">

Rp {{number_format($product->harga_beli,0,',','.')}}

</td>



<td style="
text-align:center;
padding:15px;
color:#8B5E3C;
font-weight:600;
">

Rp {{number_format($product->harga_jual,0,',','.')}}

</td>



<td style="text-align:center;padding:15px;">

<span style="
background:#EFE6DC;
padding:8px 15px;
border-radius:20px;
font-weight:600;
color:#5C4838;
">

{{$product->stok}}

</span>

</td>




<td style="text-align:center;padding:15px;">



@can('view',$product)

<a href="{{route('produk.show',$product->id)}}"

style="
background:#DDEBE7;
color:#35685A;
padding:8px 12px;
border-radius:10px;
text-decoration:none;
font-weight:600;
font-size:13px;
">
👁
</a>

@endcan




@can('update',$product)

<a href="{{route('produk.edit',$product)}}"

style="
background:#F5D7B8;
color:#6B4328;
padding:8px 12px;
border-radius:10px;
text-decoration:none;
font-weight:600;
font-size:13px;
">
✏️
</a>

@endcan




@can('delete',$product)

<form action="{{route('produk.destroy',$product)}}"
method="POST"
style="display:inline;">

@csrf
@method('DELETE')


<button

onclick="return confirm('Yakin hapus produk ini?')"

style="
background:#E8B4A8;
color:#7A2E22;
border:none;
padding:8px 12px;
border-radius:10px;
cursor:pointer;
font-weight:600;
">

🗑

</button>


</form>

@endcan



</td>


</tr>


@empty


<tr>

<td colspan="7"
style="
padding:30px;
text-align:center;
color:#8C7A6B;
">

Belum ada produk 🥐

</td>

</tr>


@endforelse


</tbody>


</table>


</div>



<div style="padding:0 25px 25px;">

{{ $products->links() }}

</div>



</div>


</div>

</div>


@endsection