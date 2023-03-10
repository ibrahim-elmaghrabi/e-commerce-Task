<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\StoreRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Contracts\StoreRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;

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


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
