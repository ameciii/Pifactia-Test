@extends('layouts.app')

@section('title', 'User Management')
@section('page-title', 'User Management')

@section('content')
<div class="content">
    <div class="card">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Users</h2>
            <a href="{{ route('users.create') }}" class="btn-primary">Add New User</a>
        </div>

        @if (session('success'))
            <div style="margin-bottom: 20px; padding: 12px; background-color: #dcfce7; color: #166534; border-radius: 8px;">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead class="table-header">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                    <tr class="table-row">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name ?? '-' }}</td>
                        <td class="text-right">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn-edit" style="margin-right: 8px;">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if ($users->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No users found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
