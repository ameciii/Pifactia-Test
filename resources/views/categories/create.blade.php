@extends('layouts.app')

@section('title', isset($category) ? 'Edit Category' : 'Add New Category')
@section('page-title', 'Category Management')

@section('content')
<div class="content">
    <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 2rem;">

        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem;">
            {{ isset($category) ? 'Edit Category' : 'Add New Category' }}
        </h2>

        @if ($errors->any())
            <div style="margin-bottom: 20px; padding: 10px; background-color: #fee2e2; color: #991b1b; border-radius: 8px;">
                <ul style="list-style: disc; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li style="font-size: 14px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.2rem;">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif

            <div>
                <label for="name" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Category Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>

            <div>
                <label for="is_active" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Status</label>
                <select name="is_active" id="is_active" required
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                    <option value="1" {{ (old('is_active', $category->is_active ?? '') == 1) ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ (old('is_active', $category->is_active ?? '') == 0) ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 1.5rem;">
                <a href="{{ route('categories.index') }}"
                    style="padding: 10px 20px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #374151; background: #f9fafb; text-decoration: none;">Cancel</a>
                <button type="submit"
                    style="padding: 10px 20px; border-radius: 8px; background-color: #4f46e5; color: white; font-size: 14px; font-weight: 600; border: none;">
                    {{ isset($category) ? 'Update' : 'Save' }}
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
