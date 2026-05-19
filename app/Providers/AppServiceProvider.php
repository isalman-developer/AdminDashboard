<?php

namespace App\Providers;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\MediaRepositoryInterface;
use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\RoleRepositoryInterface;
use App\Contracts\Repositories\SettingRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\CategoryServiceInterface;
use App\Contracts\Services\MediaServiceInterface;
use App\Contracts\Services\PermissionServiceInterface;
use App\Contracts\Services\ProductServiceInterface;
use App\Contracts\Services\RoleServiceInterface;
use App\Contracts\Services\SettingServiceInterface;
use App\Contracts\Services\UserManagementServiceInterface;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\Setting;
use App\Observers\CategoryObserver;
use App\Observers\MediaObserver;
use App\Observers\ProductObserver;
use App\Observers\SettingObserver;
use App\Repositories\CategoryRepository;
use App\Repositories\MediaRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use App\Services\CategoryService;
use App\Services\MediaService;
use App\Services\PermissionService;
use App\Services\ProductService;
use App\Services\RoleService;
use App\Services\SettingService;
use App\Services\UserManagementService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // ── Singletons (stateful, shared across the request lifecycle) ─────────
        $this->app->singleton(SettingRepositoryInterface::class, function ($app) {
            return new SettingRepository($app['cache']->store());
        });
        $this->app->singleton(SettingServiceInterface::class, function ($app) {
            return new SettingService($app->make(SettingRepositoryInterface::class));
        });

        $this->app->singleton(MediaRepositoryInterface::class, fn () => new MediaRepository);
        $this->app->singleton(MediaServiceInterface::class, function ($app) {
            return new MediaService($app->make(MediaRepositoryInterface::class));
        });

        // ── Transient bindings (interface → concrete) ─────────────────────────
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);

        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);

        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(PermissionServiceInterface::class, PermissionService::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserManagementServiceInterface::class, UserManagementService::class);
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Setting::observe(SettingObserver::class);
        Media::observe(MediaObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
