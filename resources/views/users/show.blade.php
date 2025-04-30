@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail User</h1>

    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ $user->role->name ?? '-' }}</p>

    <br>
    <a href="{{ route('users.index') }}">Kembali ke List User</a>
</div>
@endsection
