<?php

if (!function_exists('is_user_followed')) {
    function is_user_followed(\App\Models\Product $product):bool
    {
        return (bool)auth()->user()->wishes()->find($product->id);
    }
}
