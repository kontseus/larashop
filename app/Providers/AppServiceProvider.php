<?php

namespace App\Providers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Database\Factories\UserFactory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            OrderRepositoryContract::class,
            OrderRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }
}
