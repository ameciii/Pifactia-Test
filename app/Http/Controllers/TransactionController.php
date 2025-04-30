<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('product', 'user')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        Transaction::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'details' => $request->input('details') ? json_decode($request->input('details'), true) : null,
            'transaction_date' => now(),
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    public function edit(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $products = Product::all();
        return view('transactions.edit', compact('transaction', 'products'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $transaction = Transaction::findOrFail($id);
        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        $transaction->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'details' => $request->input('details') ? json_decode($request->input('details'), true) : null,
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
