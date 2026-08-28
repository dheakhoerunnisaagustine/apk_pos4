@extends('layouts.app')

@section('title', 'Detail Penjualan - Bakery POS')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">




</h4>


</div>




<div style="
padding:25px;
overflow-x:auto;
">


<table width="100%" style="
border-collapse:collapse;
">


<thead>

<tr style="
background:#FAF4EE;
color:#5C4838;
">


<th style="padding:15px;">
No
</th>

<th style="padding:15px;">
Foto
</th>

<th style="padding:15px;text-align:left;">
Nama Produk
</th>

<th style="padding:15px;">
Harga
</th>


</tr>

</thead>



<tbody>


@forelse ($penjualan->details as $item)


<tr style="
border-bottom:1px solid #F0E2D3;
">


<td style="
text-align:center;
padding:15px;
">

{{ $loop->iteration }}

</td>



<td style="
text-align:center;
padding:15px;
">


@if($item->produk && $item->produk->foto)

<img src="{{ asset('storage/'.$item->produk->foto) }}"

style="
width:65px;
height:65px;
object-fit:cover;
border-radius:15px;
">


@else

<div style="
width:65px;
height:65px;
background:#F5E6D8;
border-radius:15px;
display:flex;
align-items:center;
justify-content:center;
font-size:25px;
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

{{ $item->produk->nama ?? '-' }}

</td>



<td style="
padding:15px;
text-align:center;
color:#8B5E3C;
font-weight:600;
">

Rp {{ number_format($item->harga_satuan,0,',','.') }}

</td>



</tr>



@empty


<tr>

<td colspan="4"
style="
text-align:center;
padding:30px;
color:#8C7A6B;
">

Belum ada produk 🥖

</td>

</tr>


@endforelse


</tbody>


</table>


</div>



</div>



</div>


</div>


@endsection