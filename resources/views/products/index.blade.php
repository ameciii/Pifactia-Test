@extends('layouts.app')

@section('title', 'Product Management')
@section('page-title', 'Product Management')

@section('content')
<div class="content">
    <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 2rem;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.5rem; font-weight: bold;">Products</h2>
            <a href="{{ route('products.create') }}" style="background-color: #4f46e5; color: white; padding: 10px 16px; border-radius: 8px; font-weight: 600; text-decoration: none;">
                Add New Product
            </a>
        </div>

        @if (session('success'))
            <div style="margin-bottom: 20px; padding: 10px; background-color: #d1fae5; color: #065f46; border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- <div style="display: flex; justify-content: flex-end; align-items: center; gap: 10px; margin-bottom: 1.5rem;">
            <a href="{{ route('products.export') }}" style="background-color: #4f46e5; color: white; padding: 10px 16px; border-radius: 8px; font-weight: 600; text-decoration: none;">
                Export Excel
            </a>

            <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" style="display: flex; align-items: center; gap: 10px;">
                @csrf
                <input type="file" name="file" style="border: 1px solid #d1d5db; border-radius: 8px; padding: 8px 10px; font-size: 14px;">
                <button type="submit" style="background-color: #4f46e5; color: white; padding: 10px 16px; border-radius: 8px; font-weight: 600; border: none;">
                    Import Excel
                </button>
            </form>
        </div> -->

        <div style="overflow-x-auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background-color: #f9fafb;">
                    <tr>
                        <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600; color: #6b7280;">No</th>
                        <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600; color: #6b7280;">Product Name</th>
                        <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600; color: #6b7280;">Category</th>
                        <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600; color: #6b7280;">Price</th>
                        <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600; color: #6b7280;">Status</th>
                        <th style="padding: 12px; text-align: left; font-size: 14px; font-weight: 600; color: #6b7280;">Document</th>
                        <th style="padding: 12px; text-align: right; font-size: 14px; font-weight: 600; color: #6b7280;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                    <tr style="background-color: {{ $index % 2 == 0 ? '#ffffff' : '#f9fafb' }};">
                        <td style="padding: 12px;">{{ $index + 1 }}</td>
                        <td style="padding: 12px;">{{ $product->name }}</td>
                        <td style="padding: 12px;">{{ $product->category->name ?? '-' }}</td>
                        <td style="padding: 12px;">Rp{{ number_format($product->price, 2, ',', '.') }}</td>
                        <td style="padding: 12px;">
                            <span style="padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600;
                                background-color: {{ $product->is_available ? '#d1fae5' : '#fee2e2' }};
                                color: {{ $product->is_available ? '#065f46' : '#991b1b' }};">
                                {{ $product->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                        <td style="padding: 12px;">
                            @if ($product->document)
                                <a href="{{ Storage::url($product->document) }}" target="_blank" style="color: #4f46e5; font-weight: 500;">View PDF</a>
                            @else
                                -
                            @endif
                        </td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="{{ route('products.edit', $product->id) }}" style="color: #4f46e5; font-weight: 500; margin-right: 10px;">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #dc2626; font-weight: 500; background: none; border: none; cursor: pointer;" onclick="return confirm('Are you sure?')">Delete</button>
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
