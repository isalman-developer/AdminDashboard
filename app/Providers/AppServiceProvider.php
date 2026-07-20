<?php

namespace App\Providers;

use App\Models\Media;
use App\Models\Setting;
use App\Observers\MediaObserver;
use App\Observers\SettingObserver;
use App\Repositories\MediaRepository;
use App\Repositories\SettingRepository;
use App\Services\MediaService;
use App\Services\SettingService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // SettingRepository needs a Cache store injected — explicit singleton so the
        // same in-memory $loaded array is shared for the full request lifecycle.
        $this->app->singleton(SettingRepository::class, function ($app) {
            return new SettingRepository($app['cache']->store());
        });
        $this->app->singleton(SettingService::class, function ($app) {
            return new SettingService($app->make(SettingRepository::class));
        });

        // MediaRepository is stateless but registered as a singleton for consistency
        // with SettingRepository so both infrastructure repos share the same lifecycle.
        $this->app->singleton(MediaRepository::class, fn() => new MediaRepository);
        $this->app->singleton(MediaService::class, function ($app) {
            return new MediaService($app->make(MediaRepository::class));
        });

        // All other repositories and services are concrete classes that Laravel
        // auto-resolves — no explicit bindings required.
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Setting::observe(SettingObserver::class);
        Media::observe(MediaObserver::class);
    }
}
