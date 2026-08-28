@extends('layouts.app')

@section('title', 'Penjualan - Bakery POS')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


<div style="
    background: #FAF4EE;
    min-height: 90vh;
    padding: 40px 20px;
    font-family: 'Poppins', sans-serif;
">

    <div class="container">

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
                    🛒 Manajemen Penjualan
                </h2>

                <p style="
                    color: #8C7A6B;
                    margin-top: 5px;
                ">
                    Kelola seluruh transaksi penjualan bakery
                </p>
            </div>

            <a href="{{ route('penjualan.create') }}" style="
                background: #D97736;
                color: white;
                padding: 12px 25px;
                border-radius: 14px;
                text-decoration: none;
                font-weight: 600;
                box-shadow: 0 8px 18px rgba(217, 119, 54, .25);
            ">
                ➕ Transaksi Baru
            </a>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- CARD SEARCH -->
        <div style="
            background: white;
            border-radius: 25px;
            border: 1px solid #E8D8C8;
            box-shadow: 0 15px 35px rgba(139, 94, 60, .12);
            margin-bottom: 25px;
        ">
            <div style="padding: 25px;">
                <form action="" method="GET">
                    <div style="display: flex; gap: 10px;">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari transaksi..."
                            style="
                                flex: 1;
                                padding: 13px 16px;
                                border-radius: 14px;
                                border: 1px solid #E3D3C3;
                                background: #FFF9F4;
                            "
                        >

                        <button style="
                            background: #8B5E3C;
                            color: white;
                            border: none;
                            padding: 13px 22px;
                            border-radius: 14px;
                            font-weight: 600;
                        ">
                            🔍 Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- TABLE CARD -->
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
                    🥐 Daftar Transaksi
                </h4>
            </div>

            <div style="overflow-x: auto; padding: 0 25px 25px;">
                <table width="100%" style="border-collapse: collapse;">
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