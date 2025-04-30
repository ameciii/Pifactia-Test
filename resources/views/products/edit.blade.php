@extends('layouts.app')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('content')
<div class="content">
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 2rem;">

        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 2rem;">Edit Product</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            @method('PUT')

            <div>
                <label for="category_id" style="display: block; font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem;">Category</label>
                <select name="category_id" id="category_id" required
                    style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px;">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="name" style="display: block; font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem;">Product Name</label>
                <input type="text" id="name" name="name" value="{{ $product->name }}" 
                    style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px;" required>
            </div>

            <div>
                <label for="price" style="display: block; font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem;">Price</label>
                <input type="number" id="price" name="price" value="{{ $product->price }}" 
                    style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px;" required>
            </div>

            <div>
                <label for="is_available" style="display: block; font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem;">Status</label>
                <select name="is_available" id="is_available" required
                    style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px;">
                    <option value="1" {{ $product->is_available ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ !$product->is_available ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>

            <div>
                <label for="document" style="display: block; font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem;">Upload New Document (Optional)</label>
                <input type="file" id="document" name="document" accept="application/pdf" 
                    style="width: 100%; padding: 0.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px;">
            </div>

            @if ($product->document)
            <div class="mt-4">
                <span style="font-size: 0.95rem; font-weight: 500;">Current Document:</span>
                <a href="{{ Storage::url($product->document) }}" target="_blank" 
                   style="color: #6366f1; font-weight: 600; text-decoration: underline;">View PDF</a>
            </div>
            @endif

            <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                <a href="{{ route('products.index') }}" 
                    style="padding: 0.8rem 1.5rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px; background-color: #f9fafb; color: #374151; text-decoration: none;">
                    Cancel
                </a>
                <button type="submit" 
                    style="padding: 0.8rem 1.5rem; border-radius: 8px; background-color: #6366f1; color: white; font-size: 15px; font-weight: 600; border: none;">
                    Update
                </button>
            </div>
        </form>

        @if($product->audits->count())
            <div style="margin-top: 3rem;">
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem;">History & Note</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background-color: #f9fafb;">
                            <tr>
                                <th style="padding: 10px; font-size: 0.85rem;">Date</th>
                                <th style="padding: 10px; font-size: 0.85rem;">Action</th>
                                <th style="padding: 10px; font-size: 0.85rem;">User</th>
                                <th style="padding: 10px; font-size: 0.85rem;">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->audits as $audit)
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 10px;">{{ $audit->created_at->format('d-m-Y H:i') }}</td>
                                    <td style="padding: 10px;">{{ ucfirst($audit->event) }}</td>
                                    <td style="padding: 10px;">{{ $audit->user->name ?? 'Guest' }}</td>
                                    <td style="padding: 10px;">-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
