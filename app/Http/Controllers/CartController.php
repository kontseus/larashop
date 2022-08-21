<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart/index');
    }

    public function add(Request $request, Product $product)
    {
        Cart::instance('cart')->add(
            $product->id,
            $product->title,
            $request->product_count,
            $product->endPrice
        )->associate(Product::class);

        return redirect()->back()->with('success', 'The product was added into the cart');
    }

    public function remove(Request $request)
    {
        Cart::instance('cart')->remove($request->rowId);
        return redirect()->back();
    }

    public function countUpdate(Request $request, Product $product)
    {
        if ($product->in_stock < $request->product_count) {
            return redirect()->back()
                ->with('warn', 'The product [' . $product->title . '] has only ' . $product->in_stock . ' items');
        }

        Cart::instance('cart')->update(
            $request->rowId,
            $request->product_count
        );

        return redirect()->back();
    }
}
