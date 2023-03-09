<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\StoreRepository;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Contracts\StoreRepositoryContract;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(StoreRepositoryContract::class, StoreRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
