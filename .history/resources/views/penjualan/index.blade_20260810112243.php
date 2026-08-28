@extends('layouts.app')

@section('title', 'Penjualan - Bakery POS')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">



<thead>

<tr style="
background:#FAF4EE;
color:#5C4838;
">


<th style="padding:15px;">
No
</th>

<th style="padding:15px;">
Tanggal
</th>

<th style="padding:15px;">
Kasir
</th>

<th style="padding:15px;">
Total
</th>

<th style="padding:15px;">
Metode
</th>

<th style="padding:15px;">
Status
</th>

<th style="padding:15px;">
Aksi
</th>


</tr>

</thead>




<tbody>


@forelse($sales as $sale)


<tr style="
border-bottom:1px solid #F0E2D3;
">


<td style="padding:15px;text-align:center;">
{{$sales->firstItem()+$loop->index}}
</td>



<td style="padding:15px;">
{{$sale->updated_at->format('d-m-Y H:i')}}
</td>



<td style="padding:15px;font-weight:600;color:#4A3525;">
{{$sale->kasir->name ?? '-'}}
</td>



<td style="
padding:15px;
color:#8B5E3C;
font-weight:600;
">

Rp {{number_format($sale->total_pembayaran,0,',','.')}}

</td>




<td style="padding:15px;">

{{strtoupper($sale->metode_pembayaran)}}

</td>





<td style="padding:15px;">


@if($sale->status=='OPEN')

<span style="
background:#F5D7B8;
color:#6B4328;
padding:7px 14px;
border-radius:15px;
font-weight:600;
font-size:13px;
">

OPEN

</span>


@else


<span style="
background:#DDEBE7;
color:#35685A;
padding:7px 14px;
border-radius:15px;
font-weight:600;
font-size:13px;
">

SELESAI

</span>


@endif


</td>





<td style="padding:15px;">


<div style="
display:flex;
justify-content:center;
gap:8px;
">



<!-- DETAIL -->

<a href="{{route('penjualan.show',$sale->id)}}"

style="
width:38px;
height:38px;
background:#DDEBE7;
color:#35685A;
border-radius:12px;
display:flex;
align-items:center;
justify-content:center;
text-decoration:none;
">

👁

</a>





@can('view',$sale)

@if($sale->status=='OPEN')


<a href="{{route('penjualan.edit',$sale->id)}}"

style="
width:38px;
height:38px;
background:#F5D7B8;
color:#6B4328;
border-radius:12px;
display:flex;
align-items:center;
justify-content:center;
text-decoration:none;
">

✏️

</a>


@endif

@endcan






@can('delete',$sale)

@if($sale->status=='OPEN')


<form action="{{route('penjualan.destroy',$sale->id)}}"
method="POST">

@csrf
@method('DELETE')


<button

onclick="return confirm('Yakin hapus transaksi?')"

style="
width:38px;
height:38px;
background:#E8B4A8;
color:#7A2E22;
border:none;
border-radius:12px;
cursor:pointer;
">

🗑️

</button>


</form>


@endif

@endcan



</div>


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

Belum ada transaksi 🥐

</td>


</tr>


@endforelse


</tbody>


</table>


</div>


</div>




<div style="margin-top:20px;">

{{$sales->links()}}

</div>



</div>


</div>


@endsection