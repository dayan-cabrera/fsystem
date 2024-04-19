<?php

namespace App\Providers;

use App\Services\ClienteService;
use App\Services\Contracts\ClienteServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(ClienteServiceInterface::class, ClienteService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
