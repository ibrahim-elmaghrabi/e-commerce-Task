<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\{
    ProductRepository,
    StoreRepository,
    UserRepository,
    OrderRepository,
};

use App\Repositories\Contracts\{
    UserRepositoryContract,
    OrderRepositoryContract,
    StoreRepositoryContract,
    ProductRepositoryContract,
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(StoreRepositoryContract::class, StoreRepository::class);
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);
        $this->app->bind(OrderRepositoryContract::class, OrderRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
