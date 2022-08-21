<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function add(Product $product)
    {
        auth()->user()->addToWish($product);

        Cart::instance('wishlist')->add(
            $product->id,
            $product->title,
            1,
            $product->end_price
        )->associate($product);

        return redirect()->back()->with('success', 'Product was added to wish list');
    }

    public function delete(Product $product)
    {
        $status = 'danger';
        $message = 'Oops, smth wrong';

        if ($cartItem = Cart::instance('wishlist')->content()->where('id', $product->id)?->first()) {
            auth()->user()->removeFromWish($product);
            Cart::instance('wishlist')->remove($cartItem->rowId);

            $status = 'success';
            $message = 'Product was removed from wish list';
        }

        return redirect()->back()->with($status, $message);
    }
}
