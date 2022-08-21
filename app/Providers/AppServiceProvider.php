<?php

namespace App\Providers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Repositories\Contracts\ProductRepositoryContract;
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
