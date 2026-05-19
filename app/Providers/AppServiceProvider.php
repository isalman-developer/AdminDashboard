<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\Setting;
use App\Observers\CategoryObserver;
use App\Observers\MediaObserver;
use App\Observers\ProductObserver;
use App\Observers\SettingObserver;
use App\Repositories\MediaRepository;
use App\Repositories\SettingRepository;
use App\Services\MediaService;
use App\Services\SettingService;
use Illuminate\Pagination\Paginator;
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

        $this->app->singleton(MediaRepository::class, fn() => new MediaRepository);
        $this->app->singleton(MediaService::class, function ($app) {
            return new MediaService(
                $app->make(MediaRepository::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Setting::observe(SettingObserver::class);
        Media::observe(MediaObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
