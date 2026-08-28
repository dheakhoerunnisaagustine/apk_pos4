@extends('layouts.app')

@section('title', 'POS')

@section('content')

@include('layouts.navbar')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">



<div class="row">

    {{-- ===================== PRODUK ===================== --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="max-height:70vh; overflow:auto">

                <form method="GET" action="{{ route('penjualan.create') }}" class="mb-3">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control"
                           placeholder="Cari produk..."
                           onkeyup="this.form.submit()">
                </form>

                @foreach($products as $product)
                <form method="POST"
                      action="{{ route('itempenjualan.store') }}"
                      class="row mb-2 align-items-center">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="col-7">
                        <button type="submit"
                                class="btn btn-outline-primary w-100 text-start p-2
                                {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            <div class="fw-semibold">{{ $product->nama }}</div>
                            <small class="text-muted">
                                Rp {{ number_format($product->harga_jual) }}
                            </small>
                        </button>
                    </div>

                    <div class="col-3">
                        <input type="number"
                               name="quantity"
                               value="1"
                               min="1"
                               class="form-control"
                               {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}>
                    </div>

                    <div class="col-2">
                        <button type="submit"
                                class="btn btn-primary w-100
                                {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            +
                        </button>
                    </div>
                </form>
                @endforeach

            </div>
        </div>
    </div>

    {{-- ===================== KERANJANG ===================== --}}
    <div class="col-md-6">
        <div class="card">

            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th width="80">Qty</th>
                            <th>Subtotal</th>
                            <th width="80">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($sale->itemPenjualan as $item)
                        <tr>
                            <td>{{ $item->produk->nama }}</td>
                            <td>Rp {{ number_format($item->produk->harga_jual) }}</td>
                            <td>
                                <form method="POST"
                                      action="{{ route('itempenjualan.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="number"
                                           name="quantity"
                                           value="{{ $item->kuantitas }}"
                                           min="1"
                                           class="form-control form-control-sm"
                                           {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}>
                                </form>
                            </td>
                            <td>Rp {{ number_format($item->subtotal) }}</td>
                            <td>
                                @if(auth()->user()->role->name === 'admin')
                                <form method="POST"
                                      action="{{ route('itempenjualan.destroy', $item->id) }}"
                                      onsubmit="return confirm('Hapus item ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada produk
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <strong>Total: Rp {{ number_format($sale->total_pembayaran) }}</strong>

                <form method="POST"
                      action="{{ route('penjualan.update', $sale->id) }}"
                      class="mt-2"
                      onsubmit="return confirm('Yakin ingin checkout?')">
                    @csrf
                    @method('PUT')

                    <select name="payment_method" class="form-select mb-2">
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <button class="btn btn-success w-100
                        {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        Checkout
                    </button>
                </form>

                @if(auth()->user()->role->name === 'admin')
                <form action="{{ route('penjualan.destroy', $sale->id) }}"
                      method="POST"
                      class="mt-2"
                      onsubmit="return confirm('Batalkan transaksi ini?')">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outline-danger w-100
                        {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        Batalkan Transaksi
                    </button>
                </form>
                @endif
            </div>

        </div>
    </div>

</div>

@endsection
