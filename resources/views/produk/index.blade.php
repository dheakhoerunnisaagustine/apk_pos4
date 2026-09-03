@extends('layouts.app')

@section('title', 'Produk - Bakery Theme')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<div style="background:#FAF4EE; min-height:85vh; padding:40px 20px; font-family:'Poppins',sans-serif;">

    <div style="max-width:1200px; margin:auto;">

        <!-- HEADER -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <div>
                <h2 style="font-family:'Playfair Display',serif; color:#4A3525; font-weight:700; margin:0;">
                    🍞 Manajemen Produk
                </h2>
                <p style="color:#8C7A6B; margin-top:5px; margin-bottom:0;">
                    Kelola produk bakery, harga dan stok
                </p>
            </div>

            @can('create', App\Models\Produk::class)
            <a href="{{ route('produk.create') }}"
               style="background:#D97736; color:white; padding:12px 25px; border-radius:14px; text-decoration:none; font-weight:600; box-shadow:0 8px 18px rgba(217,119,54,.25);">
                ➕ Tambah Produk
            </a>
            @endcan
        </div>

        <!-- CARD -->
        <div style="background:white; border-radius:25px; border:1px solid #E8D8C8; box-shadow:0 15px 35px rgba(139,94,60,.12); overflow:hidden;">

            <div style="padding:25px; background:linear-gradient(135deg,#FFF8F1,#F5E6D8); border-bottom:1px solid #F0E2D3;">
                <h4 style="margin:0; font-family:'Playfair Display',serif; color:#4A3525;">
                    🥐 Daftar Produk
                </h4>
            </div>

            <!-- SEARCH & NOTIFIKASI -->
            <div style="padding:25px;">
                
                {{-- NOTIFIKASI SUKSES --}}
                @if(session('success'))
                    <div style="
                        background: #D1E7DD;
                        color: #0F5132;
                        padding: 15px;
                        border-radius: 14px;
                        margin-bottom: 20px;
                        border: 1px solid #BADBCC;
                        font-weight: 500;
                    ">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <form action="{{route('produk.index')}}" method="GET">
                    <div style="display:flex; gap:10px;">
                        <input type="text" name="search" value="{{request('search')}}" placeholder="Cari nama produk..."
                               style="flex:1; padding:13px 16px; border-radius:14px; border:1px solid #E3D3C3; background:#FFF9F4; outline:none;">

                        <button style="background:#8B5E3C; color:white; border:none; padding:13px 22px; border-radius:14px; font-weight:600; cursor:pointer;">
                            🔍 Cari
                        </button>
                    </div>
                </form>
            </div>

            <!-- TABLE -->
            <div style="overflow-x:auto; padding:0 25px 25px;">
                <table width="100%" style="border-collapse:collapse;">
                    <thead>
                        <tr style="background:#FAF4EE; color:#5C4838; font-size:14px; text-transform:uppercase; letter-spacing:0.5px;">
                            <th style="padding:15px; text-align:center; width:6%;">No</th>
                            <th style="padding:15px; text-align:center; width:10%;">Foto</th>
                            <th style="padding:15px; text-align:left; width:28%;">Nama Produk</th>
                            <th style="padding:15px 20px; text-align:right; width:14%;">Harga Beli</th>
                            <th style="padding:15px 20px; text-align:right; width:14%;">Harga Jual</th>
                            <th style="padding:15px; text-align:center; width:12%;">Jenis</th>
                            <th style="padding:15px; text-align:center; width:12%;">Stok</th>
                            <th style="padding:15px; text-align:center; width:16%;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($products as $product)
                        <tr style="border-bottom:1px solid #F0E2D3;">

                            <!-- No -->
                            <td style="text-align:center; padding:15px; color:#8C7A6B; font-weight:500;">
                                {{ $products->firstItem() + $loop->index }}
                            </td>

                            <!-- Foto -->
                            <td style="text-align:center; padding:15px;">
                                @if($product->foto)
                                    <img src="{{asset('storage/'.$product->foto)}}"
                                         style="width:52px; height:52px; object-fit:cover; border-radius:14px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                                @else
                                    <div style="width:52px; height:52px; background:#F5E6D8; border-radius:14px; display:inline-flex; align-items:center; justify-content:center; font-size:24px;">
                                        🥐
                                    </div>
                                @endif
                            </td>

                            <!-- Nama Produk & Pembuat/Supplier -->
                            <td style="padding:15px; text-align:left;">
                                <div style="font-weight:600; color:#4A3525; font-size:15px;">
                                    {{ $product->nama }}
                                </div>
                                <small style="color:#8C7A6B; font-size:13px;">
                                    {{ $product->jenisProduk->nama ?? '-' }}
                                </small>
                            </td>

                            <!-- Harga Beli (Rata Kanan) -->
                            <td style="padding:15px 20px; text-align:right; color:#6C5C50; font-weight:500;">
                                Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                            </td>

                            <!-- Harga Jual (Rata Kanan & Bold) -->
                            <td style="padding:15px 20px; text-align:right; color:#8B5E3C; font-weight:700;">
                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                            </td>

                            <!-- JENIS (Diperbaiki memanggil relasi jenisProduk) -->
                            <td style="text-align:center; padding:15px;">
                                <span style="background:#D1E7DD; color:#0F5132; padding:6px 14px; border-radius:20px; font-weight:600; font-size:13px; display:inline-block;">
                                    {{ $product->jenisProduk->nama_jenis ?? '-' }}
                                </span>
                            </td>

                            <!-- STOK -->
                            <td style="text-align:center; padding:15px;">
                                @if($product->stok <= 0)
                                    <span style="background:#FADBD8; color:#78281F; padding:6px 14px; border-radius:20px; font-weight:600; font-size:13px; display:inline-block;">
                                        0 pcs
                                    </span>
                                @elseif($product->stok <= 5)
                                    <span style="background:#FCF3CF; color:#7D6608; padding:6px 14px; border-radius:20px; font-weight:600; font-size:13px; display:inline-block;">
                                        {{ $product->stok }} pcs
                                    </span>
                                @else
                                    <span style="background:#D4EFDF; color:#145A32; padding:6px 14px; border-radius:20px; font-weight:600; font-size:13px; display:inline-block;">
                                        {{ $product->stok }} pcs
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td style="text-align:center; padding:15px;">
                                <div style="display:inline-flex; gap:6px; align-items:center;">
                                    @can('view', $product)
                                    <a href="{{route('produk.show', $product->id)}}" title="Detail"
                                       style="background:#DDEBE7; color:#35685A; padding:8px 12px; border-radius:10px; text-decoration:none; font-weight:600; font-size:13px; display:inline-flex; align-items:center;">
                                        👁
                                    </a>
                                    @endcan

                                    @can('update', $product)
                                    <a href="{{route('produk.edit', $product)}}" title="Edit"
                                       style="background:#F5D7B8; color:#6B4328; padding:8px 12px; border-radius:10px; text-decoration:none; font-weight:600; font-size:13px; display:inline-flex; align-items:center;">
                                        ✏️
                                    </a>
                                    @endcan

                                    @can('delete', $product)
                                    <form action="{{route('produk.destroy', $product)}}" method="POST" style="display:inline; margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus produk ini?')" title="Hapus"
                                                style="background:#E8B4A8; color:#7A2E22; border:none; padding:8px 12px; border-radius:10px; cursor:pointer; font-weight:600; font-size:13px; display:inline-flex; align-items:center;">
                                            🗑
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding:30px; text-align:center; color:#8C7A6B;">
                                Belum ada produk 🥐
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div style="padding:0 25px 25px;">
                {{ $products->links() }}
            </div>

        </div>

    </div>

</div>

@endsection