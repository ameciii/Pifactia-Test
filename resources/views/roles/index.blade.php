@extends('layouts.app')

@section('title', 'Role Management')
@section('page-title', 'Role Management')

@section('content')
<div class="content">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Roles</h2>
            <a href="{{ route('roles.create') }}" class="btn-primary">Add New Role</a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead class="table-header">
                    <tr>
                        <th>Role Name</th>
                        <th>Description</th>
                        <th>Created Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr class="table-row">
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>{{ $role->created_at->format('Y-m-d') }}</td>
                        <td class="text-right">
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
