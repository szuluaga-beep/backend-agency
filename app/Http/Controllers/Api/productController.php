<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function getAllProducts()
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Products not found'], 404);
        }

        return response()->json($products, 200);
    }
}
