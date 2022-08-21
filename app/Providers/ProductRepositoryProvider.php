<?php

namespace App\Providers;

use App\Http\Controllers\Admin\ProductsController;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProductRepositoryContract::class,
            ProductRepository::class
        );
    }
}
