@extends('layouts.app')

@section('title', 'Category Management')
@section('page-title', 'Category Management')

@section('content')
<div class="content">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Categories</h2>
            <a href="{{ route('categories.create') }}" class="btn-primary">Add New Category</a>
        </div>

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead class="table-header">
                    <tr>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="table-row">
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $category->created_at->format('Y-m-d') }}</td>
                        <td class="text-right">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline" style="display: inline;">
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
