<?php

namespace App\Providers;

use App\Models\Setting;
use App\Observers\SettingObserver;
use App\Repositories\SettingRepository;
use App\Services\SettingService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingRepository::class, function ($app) {
            return new SettingRepository($app['cache']->store());
        });

        $this->app->singleton(SettingService::class, function ($app) {
            return new SettingService(
                $app->make(SettingRepository::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Setting::observe(SettingObserver::class);
    }
}
