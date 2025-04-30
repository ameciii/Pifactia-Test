<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithValidation
{
    public function model(array $row)
    {
        return new Product([
            'name' => $row[1],
            'price' => $row[2],
            'is_available' => $row[3],
        ]);
    }

    public function rules(): array
    {
        return [
            '1' => 'required|string|max:255',
            '2' => 'required|numeric|min:0',
            '3' => 'required|boolean',
        ];
    }
}
