<?php

namespace App\Providers;

use App\Models\AppData;
use App\Models\Institute;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
//vpx_imports
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //vpx_app_register_service_providers
        foreach (config('facades', []) as $alias => $class) {
            AliasLoader::getInstance()->alias($alias, $class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //vpx_binds
        Paginator::useBootstrapFive();
    }
}
