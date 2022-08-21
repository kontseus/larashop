<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\FileStorageService;
use App\Notifications\ProductUpdateNotification;

class ProductObserver
{

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $old_count = $product->getOriginal('in_stock');
        $old_price = $product->getOriginal('end_price');

        if (($old_count <= 0 && $old_count < $product->in_stock) || $old_price > $product->end_price) {
            $product->followers()
                ->get()
                ->each
                ->notify(new ProductUpdateNotification($product));
        }
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        if ($product->images()->count() > 0) {
            $product->images->each->delete();
        }
        FileStorageService::remove($product->thumbnail);
    }
}
