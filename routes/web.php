<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MarkedAsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

// Admin Authentication Routes
Route::middleware('guest:web')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
});

Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout')->middleware('auth:web');

// Authenticated admin routes
Route::middleware('auth:web')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [AdminAuthController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [AdminAuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AdminAuthController::class, 'updateProfile'])->name('profile.update');
    Route::resource('settings', SettingsController::class)->only(['index', 'store']);

    // ── Brand Management ──────────────────────────────────────────────────────
    Route::prefix('brands')->name('brands.')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/', [BrandController::class, 'store'])->name('store');
        Route::get('/{brand}', [BrandController::class, 'show'])->name('show');
        Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('edit');
        Route::put('/{brand}', [BrandController::class, 'update'])->name('update');
        Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('destroy');
    });

    // ── Category Management ───────────────────────────────────────────────────
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // ── Product Management ────────────────────────────────────────────────────
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::patch('/{product}/toggle-status', [ProductController::class, 'toggleStatus'])
            ->name('toggle-status');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // ── Slider Management ────────────────────────────────────────────────────
    Route::prefix('sliders')->name('sliders.')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        Route::get('/create', [SliderController::class, 'create'])->name('create');
        Route::post('/', [SliderController::class, 'store'])->name('store');
        Route::get('/{slider}/edit', [SliderController::class, 'edit'])->name('edit');
        Route::put('/{slider}', [SliderController::class, 'update'])->name('update');
        Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('destroy');
    });

    // ── Pages Content Management ──────────────────────────────────────────────
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/about',   [PageController::class, 'editAbout'])->name('about');
        Route::put('/about',   [PageController::class, 'updateAbout'])->name('about.update');
        Route::get('/contact', [PageController::class, 'editContact'])->name('contact');
        Route::put('/contact', [PageController::class, 'updateContact'])->name('contact.update');
    });

    Route::prefix('contact-messages')->name('contact-messages.')->group(function () {
        Route::get('/',                 [ContactMessageController::class, 'index'])->name('index');
        Route::patch('/{message}/read', [ContactMessageController::class, 'markRead'])->name('markRead');
        Route::delete('/{message}',     [ContactMessageController::class, 'destroy'])->name('destroy');
    });

    // ── Invoice Management ────────────────────────────────────────────────────
    Route::prefix('invoices')->name('invoices.')->group(function () {
        Route::get('/',                    [InvoiceController::class, 'index'])->name('index');
        Route::get('/{invoice}',           [InvoiceController::class, 'show'])->name('show');
        Route::get('/{invoice}/edit',      [InvoiceController::class, 'edit'])->name('edit');
        Route::put('/{invoice}',           [InvoiceController::class, 'update'])->name('update');
        Route::patch('/{invoice}/paid',    [InvoiceController::class, 'markPaid'])->name('markPaid');
        Route::delete('/{invoice}',        [InvoiceController::class, 'destroy'])->name('destroy');
        Route::post('/from-order/{order}', [InvoiceController::class, 'generateFromOrder'])->name('fromOrder');
    });

    // ── Order Management ──────────────────────────────────────────────────────
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');
        Route::put('/{order}', [OrderController::class, 'update'])->name('update');
        Route::patch('/{order}/status', [OrderController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
    });

    // ── Marker Management ─────────────────────────────────────────────────────
    Route::prefix('markers')->name('markers.')->group(function () {
        Route::get('/', [MarkedAsController::class, 'index'])->name('index');
        Route::get('/{markedAs}/edit', [MarkedAsController::class, 'edit'])->name('edit');
        Route::put('/{markedAs}', [MarkedAsController::class, 'update'])->name('update');
    });

    // Role Management Routes
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}', [RoleController::class, 'show'])->name('show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    });

    // Permission Management Routes
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::get('/create', [PermissionController::class, 'create'])->name('create');
        Route::post('/', [PermissionController::class, 'store'])->name('store');
        Route::get('/{permission}', [PermissionController::class, 'show'])->name('show');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('edit');
        Route::put('/{permission}', [PermissionController::class, 'update'])->name('update');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
    });

    // User Management Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('index');
        Route::get('/create', [UserManagementController::class, 'create'])->name('create');
        Route::post('/', [UserManagementController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserManagementController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserManagementController::class, 'update'])->name('update');
        Route::get('/{user}/edit/roles', [UserManagementController::class, 'editRoles'])->name('edit-roles');
        Route::put('/{user}/roles', [UserManagementController::class, 'updateRoles'])->name('update-roles');
        Route::delete('/{user}/roles/{role}', [UserManagementController::class, 'removeRole'])->name('remove-role');
        Route::delete('/{user}/permissions/{permission}', [UserManagementController::class, 'removePermission'])->name('remove-permission');
    });
});
