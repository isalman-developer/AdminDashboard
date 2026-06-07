# Plan: Migrate OldProject Client-Side to Main Laravel App

## 1. Required Directory Structure

```
resources/views/client/          <- copy from OldProject
app/Http/Controllers/Client/     <- already exists, populate
routes/client.php                <- separate route file
routes/web.php                   <- update to include client.php
```

---

## 2. Copy Client-Side Views

Copy all from `OldProject/resources/views/client/` → `resources/views/client/`:

```
resources/views/client/
├── layouts/
│   └── master.blade.php
├── partials/
│   ├── footer.blade.php
│   ├── head.blade.php
│   ├── header.blade.php
│   ├── scripts.blade.php
│   ├── features.blade.php
│   └── search.blade.php
├── about-us/
│   └── about-us.blade.php
├── contact-us/
│   └── contact-us.blade.php
├── products/
│   └── listing.blade.php
└── index.blade.php
```

Also copy `resources/views/welcome.blade.php` (it's client-facing) and `resources/views/test.blade.php` (debug).

---

## 3. Copy Required Front-End Assets

From `OldProject/public/` copy to project `public/`:

### Client libraries & styles
- `OldProject/public/client/` → `public/client/`
  - `css/` (mg-menu.css, responsive.css, style.css)
  - `js/` (jquery-3.6.1.min.js, popper.min.js, mg-menu.js, mg-common.js, shop.js, jquery.validate.min.js, jquery.ui.touch-punch.min.js, mg-send-email.js, about-us.js, single-product.js)
  - `libs/` (jquery-ui-1.13.2.custom/, bootstrap-5.0.2-dist/, slick-1.8.1/, Magnific-Popup-master/, fontawesome-free-6.2.1-web/)

### Admin assets (keep/restructure if needed in Admin area)
- `OldProject/public/admin/` → `public/admin/`

### Uploaded images (keep shared)
- `OldProject/public/client/css/`, `OldProject/public/client/js/`, `OldProject/public/client/libs/` — all to `public/client/`
- `OldProject/public/sliderImages/` → `public/sliderImages/`
- `OldProject/public/productImages/` → `public/productImages/`
- `OldProject/public/brandImages/` → `public/brandImages/`
- `OldProject/public/siteSettingImages/` → `public/siteSettingImages/`
- `OldProject/public/default-image.jpg` → `public/default-image.jpg`
- `OldProject/public/favicon.ico` → `public/favicon.ico`
- `OldProject/public/robots.txt` → `public/robots.txt`

### Keep OldProject public root
- `OldProject/public/index.php` is NOT needed (main app has its own)

---

## 4. Separate Route File: `routes/client.php`

Create `/home/salmankhan/LearningProjects/AdminDashboard/routes/client.php` with:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\SiteSettingController;

/*
|--------------------------------------------------------------------------
| Client / Front-end Web Routes
|--------------------------------------------------------------------------
*/

Route::namespace('App\Http\Controllers\Client')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('aboutUs');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contactUs');

    Route::resource('products', ProductController::class)->only(['index', 'show']);

    // Site settings public page (optional use of SiteSettingController)
    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('siteSettings.index');

});
```

Then update `routes/web.php` to include this file:

```php
// Load client routes first (front-end, no auth)
require base_path('routes/client.php');

// Admin routes here...
```

This keeps `routes/web.php` purely admin-focused.

---

## 5. Client Controllers: `app/Http/Controllers/Client/`

Update the three existing controllers to match OldProject logic:

### `HomeController.php`
```php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $data['normal_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 1)
            ->inRandomOrder()->take(10)->get();
        $data['random_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 1)
            ->inRandomOrder()->take(5)->get();
        $data['featured_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 2)
            ->inRandomOrder()->take(6)->get();
        $data['best_seller_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 3)
            ->inRandomOrder()->take(6)->get();
        $data['sale_item_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 4)
            ->inRandomOrder()->take(2)->get();
        $data['top_rated_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 5)
            ->inRandomOrder()->take(6)->get();
        $data['top_deal_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 6)
            ->inRandomOrder()->take(6)->get();
        $data['primary_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 8)
            ->inRandomOrder()->take(2)->get();
        $data['grand_sale_product'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 9)
            ->inRandomOrder()->take(6)->get();

        return view('client.index', compact('data'));
    }

    public function aboutUs()
    {
        return view('client.about-us.about-us');
    }

    public function contactUs()
    {
        return view('client.contact-us.contact-us');
    }
}
```

### `ProductController.php`
```php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::whereStatus(true)
            ->with(['brand', 'files'])
            ->when(request()->input('marked_as_id'), function ($query) {
                $query->where('marked_as_id', request()->input('marked_as_id'));
            })->paginate(12);

        return view('client.products.listing', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('files');
        return view('client.products.detail', compact('product'));
    }
}
```

### `SiteSettingController.php`
Update to use `app/helpers.php` style or return empty — keep minimal.

---

## 6. Models: Extend Product for Client-Side Fields

The current `Product` model has: `name, slug, sku, price, stock_quantity, is_active`.  
OldProject needs additional fields:

- `title` (string) — used in OldProduct Product
- `series` (string)
- `ram` (string)
- `ram_type` (string)
- `storage` (string)
- `graphical_memory` (string)
- `backlight` (tinyInteger/boolean)
- `screen_size` (string)
- `color` (string)
- `marked_as_id` (foreign id)
- `description` (text) — existing as `description` in current model

**Also required new OldProject models:**
- `Files` — morphable file tracker
- `MarkedAs` — status markers (1=normal, 2=featured, 3=best-seller, etc.)
- `Brand`, `Category`, `Generation`, `Processor`, `SiteSetting`, `Slider`

### Migration plan for new columns/tables
Add a new migration to extend `products` table with OldProject-specific columns:

- `title`, `series`, `ram`, `ram_type`, `storage`, `graphical_memory`, `backlight`, `screen_size`, `color`, `marked_as_id`, `generation_id`, `processor_id`, `processor_type`

Also create migrations for:
- `files` table
- `marked_as` table
- `site_settings` table
- `sliders` table
- `generations` table
- `processors` table

Populate `marked_as` with seed values (IDs 1-9 matching OldProject queries).

---

## 7. Assets & Helpers: Copy OldProject Shared Code

Copy `OldProject/app/helpers.php` → project root `app/helpers.php` (functions like `showImage`, `storeImage`, `deleteImage`, `checkActive`, `statusBadge`, `writeConfigFile`).

These are used by OldProject views and will be needed by the new client views.

---

## 8. Remove Unused Files from OldProject

After migration, the following OldProject directories become safe to delete:

- `OldProject/resources/views/client/` (copied out)
- `OldProject/app/Http/Controllers/Client/` (migrated to main app)
- `OldProject/routes/web.php` (client routes migrated to `routes/client.php`; old file becomes redundant)
- Optionally `OldProject/routes/` entirely once admin routes are also migrated
- Optionally `OldProject/app/helpers.php` (copied to project root)

Keep OldProject assets (CSS, JS, images) intact but move plan is covered — after the client assets are successfully copied to the main `public/`, OldProject's `public/client/`, `public/sliderImages/`, etc. may be removed but only AFTER verifying the main app works.

---

## 9. Steps Summary For Implementation

1. **Create** `resources/views/client/` (copy from OldProject)
2. **Create** `public/client/` (copy CSS/JS/libs from OldProject)
3. **Move** shared images to `public/` (sliderImages, productImages, brandImages, siteSettingImages)
4. **Create** `routes/client.php`
5. **Update** `routes/web.php` to `require base_path('routes/client.php')`
6. **Create migrations** for missing tables (`files`, `marked_as`, etc.) and product columns
7. **Update** `app/Models/Product.php` with OldProject fillable + relationships
8. **Update/create** `app/Http/Controllers/Client/*.php`
9. **Copy** `app/helpers.php` to project root
10. **After all passes**, remove the OldProject file trees listed above
