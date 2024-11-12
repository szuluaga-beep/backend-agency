<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image_url' => 'required',
            'price' => 'required|decimal:2'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error in validation data',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'price' => $request->price
        ]);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            $data = [
                'message' => 'Product not found'
            ];

            return response()->json($data, 404);
        }

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            $data = [
                'message' => 'Product not found'
            ];

            return response()->json($data, 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted'], 200);
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);

        if (!$product) {

            return response()->json(['message' => 'Product not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'description' => 'max:255',
            'image_url' => 'url:http,https',
            'price' => 'decimal:2'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error in validation data',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('name')) {
            $product->name = $request->name;
        }
        if ($request->has('description')) {
            $product->description = $request->description;
        }
        if ($request->has('image_url')) {
            $product->image_url = $request->image_url;
        }
        if ($request->has('price')) {
            $product->price = $request->price;
        }

        $product->save();

        $data = [
            'message' => 'Product updated'
        ];

        return response()->json($data, 200);
    }
}
