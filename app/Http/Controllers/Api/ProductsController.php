<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return response()->json(['data' => ProductResource::collection(Product::all())]);
    }

    public function show(Product $product)
    {
        return response()->json(['data' => new ProductResource($product)]);
    }
}
