<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;



class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'document' => 'nullable|file|mimes:pdf',
        ]);

        $path = null;
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('documents', 'public');
        }

        Product::create([
            'uuid' => Str::uuid(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'is_available' => $request->has('is_available'),
            'attributes' => $request->input('attributes') ? json_decode($request->input('attributes'), true) : null,
            'document' => $path, // hanya simpan path relatif (documents/namafile.pdf)
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'document' => 'nullable|file|mimes:pdf',
        ]);

        $product = Product::findOrFail($id);

        $path = $product->document;
        if ($request->hasFile('document')) {
            // Hapus file lama kalau ada
            if ($path) {
                Storage::delete('public/' . $path);
            }
            // Upload file baru
            $path = $request->file('document')->store('documents', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'is_available' => $request->has('is_available'),
            'attributes' => $request->input('attributes') ? json_decode($request->input('attributes'), true) : null,
            'document' => $path,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Hapus file dokumen kalau ada
        if ($product->document) {
            Storage::delete('public/' . $product->document);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
    
        Excel::import(new ProductsImport, $request->file('file'));
    
        return back()->with('success', 'Import sukses!');
    }
    

}
