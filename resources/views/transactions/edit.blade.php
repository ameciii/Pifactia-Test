@extends('layouts.app')

@section('title', isset($transaction) ? 'Edit Transaction' : 'Add New Transaction')
@section('page-title', isset($transaction) ? 'Edit Transaction' : 'Add New Transaction')

@section('content')
<div class="content">
    <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 2rem;">

        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem;">
            {{ isset($transaction) ? 'Edit Transaction' : 'Add New Transaction' }}
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

        <form action="{{ isset($transaction) ? route('transactions.update', $transaction->id) : route('transactions.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.2rem;">
            @csrf
            @if (isset($transaction))
                @method('PUT')
            @endif

            <div>
                <label for="product_id" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Product</label>
                <select name="product_id" id="product_id" required
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                    <option value="">-- Select Product --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ (isset($transaction) && $transaction->product_id == $product->id) ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="quantity" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $transaction->quantity ?? '') }}" required
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>

            <div>
                <label for="is_completed" style="font-size: 14px; font-weight: 600; margin-bottom: 6px; display: block;">Status</label>
                <select name="is_completed" id="is_completed" required
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                    <option value="0" {{ (isset($transaction) && !$transaction->is_completed) ? 'selected' : '' }}>Pending</option>
                    <option value="1" {{ (isset($transaction) && $transaction->is_completed) ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 1.5rem;">
                <a href="{{ route('transactions.index') }}"
                    style="padding: 10px 20px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #374151; background: #f9fafb; text-decoration: none;">Cancel</a>
                <button type="submit"
                    style="padding: 10px 20px; border-radius: 8px; background-color: #4f46e5; color: white; font-size: 14px; font-weight: 600; border: none;">
                    {{ isset($transaction) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>

        @if(isset($transaction) && $transaction->audits->count())
            <div style="margin-top: 3rem;">
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem;">History & Note</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background-color: #f9fafb;">
                            <tr>
                                <th style="padding: 10px; text-align: left; font-size: 0.85rem;">Date</th>
                                <th style="padding: 10px; text-align: left; font-size: 0.85rem;">Action</th>
                                <th style="padding: 10px; text-align: left; font-size: 0.85rem;">User</th>
                                <th style="padding: 10px; text-align: left; font-size: 0.85rem;">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction->audits as $audit)
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
