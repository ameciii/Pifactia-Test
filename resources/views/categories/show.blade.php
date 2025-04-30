@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Kategori</h1>

    <p><strong>Nama:</strong> {{ $category->name }}</p>
    <p><strong>Status:</strong> {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}</p>
    <p><strong>Metadata:</strong> {{ json_encode($category->metadata) }}</p>

    <br>
    <a href="{{ route('categories.index') }}">Kembali ke List Kategori</a>
</div>
@endsection
