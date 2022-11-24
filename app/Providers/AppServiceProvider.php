<?php

namespace App\Providers;

use App\Services\JsonOutputService;
use App\Services\PermissionService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('json_output_service', function () {
            return new JsonOutputService();
        });

        $this->app->bind('permission_service', function () {
            return new PermissionService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
