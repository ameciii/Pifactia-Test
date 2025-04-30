@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Produk</h1>

    <p><strong>Nama Produk:</strong> {{ $product->name }}</p>
    <p><strong>Kategori:</strong> {{ $product->category->name ?? '-' }}</p>
    <p><strong>Harga:</strong> Rp{{ number_format($product->price, 2, ',', '.') }}</p>
    <p><strong>Status:</strong> {{ $product->is_available ? 'Tersedia' : 'Tidak Tersedia' }}</p>
    <p><strong>Attributes:</strong> {{ json_encode($product->attributes) }}</p>
    <p><strong>Dokumen:</strong>
        @if ($product->document)
            <a href="{{ Storage::url($product->document) }}" target="_blank">Lihat Dokumen</a>
        @else
            Tidak Ada Dokumen
        @endif
    </p>

    <br>
    <a href="{{ route('products.index') }}">Kembali ke List Produk</a>
</div>
@endsection
