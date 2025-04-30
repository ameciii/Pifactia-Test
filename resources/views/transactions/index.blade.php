@extends('layouts.app')

@section('title', 'Transaction Management')
@section('page-title', 'Transaction Management')

@section('content')
<div class="content">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 class="text-lg font-semibold">Transactions</h2>
            <a href="{{ route('transactions.create') }}" class="btn-primary">Add New Transaction</a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead class="table-header">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Transaction Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr class="table-row">
                        <td>{{ $transaction->product->name ?? '-' }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>Rp{{ number_format($transaction->total_price, 2, ',', '.') }}</td>
                        <td>{{ $transaction->is_completed ? 'Completed' : 'Pending' }}</td>
                        <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                        <td class="text-right">
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
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
