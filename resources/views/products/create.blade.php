@extends('layouts.app')

@section('title', 'Add New Product')
@section('page-title', 'Add New Product')

@section('content')
<div class="content">
    <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 2rem;">

        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem;">Add New Product</h2>

        @if ($errors->any())
            <div style="margin-bottom: 20px; padding: 10px; background-color: #fee2e2; color: #991b1b; border-radius: 8px;">
                <ul style="list-style: disc; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li style="font-size: 14px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.2rem;">
            @csrf

            <div>
                <label for="category_id" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Category</label>
                <select name="category_id" id="category_id" required
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="name" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Product Name</label>
                <input type="text" id="name" name="name" required
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>

            <div>
                <label for="price" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Price</label>
                <input type="number" id="price" name="price" required
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>

            <div>
                <label for="is_available" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Status</label>
                <select name="is_available" id="is_available" required
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                </select>
            </div>

            <div>
                <label for="document" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Upload Document (PDF)</label>
                <input type="file" id="document" name="document" accept="application/pdf"
                    style="font-size: 14px; padding: 8px 0; width: 100%;">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 1.5rem;">
                <a href="{{ route('products.index') }}"
                    style="padding: 10px 20px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #374151; background: #f9fafb; text-decoration: none;">Cancel</a>
                <button type="submit"
                    style="padding: 10px 20px; border-radius: 8px; background-color: #4f46e5; color: white; font-size: 14px; font-weight: 600; border: none;">Save</button>
            </div>

        </form>
    </div>
</div>
@endsection
