<?php

namespace App\Providers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Services\Contracts\InvoicesServiceContract;
use App\Services\InvoicesService;
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
            InvoicesServiceContract::class,
            InvoicesService::class
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
        \Illuminate\Filesystem\AwsS3V3Adapter::macro('getClient', fn() => $this->client);
    }
}
