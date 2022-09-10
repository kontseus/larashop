<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);

        return view('products.index', compact('products'));
    }

    public function show(Product $product): Renderable
    {
        $userRating = $product->getUserRating();
        $comments = $product->comments()->paginate(2);

        return view('products.show', compact('product', 'userRating', 'comments'));
    }

    public function addRating(Request $request, Product $product)
    {
        $product->rateOnce($request->get('star'));

        return redirect()->back();
    }
}
