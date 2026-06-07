# Plan: Fix `config('brands')` null error — replace with cached dynamic data

## Problem
`config('brands')` returns `null` at runtime. There is no `config/brands.php` file, and nothing populates it during the application boot. Three Blade views (`client/index.blade.php`, `client/partials/header.blade.php`, `client/products/listing.blade.php`) loop over `config('brands')` and crash with:

```
foreach() argument must be of type array|object, null given
```

Current state of `brands` data:
- `brands` table has 8 records (seeded via `BrandSeeder`).
- `BrandObserver` flushes cache key `brands.ordered` on create/update/delete.
- `BrandService::allOrdered()` already caches brands with key `brands.ordered`.
- Media for brands is stored via morphMany (`brands.media`).

The `AppServiceProvider` was previously partially edited to inject `Config::set('brands', ...)`, but that approach has a problem: the config is effectively static for the request lifecycle and does not properly sync with the existing `brands.ordered` cache invalidation strategy.

## Goal (from user)
Make the call **dynamic with cache handling** instead of relying on `config('brands')`.

## Solution: Replace `config('brands')` with a view composer + cache

### Step 1 — Create a dedicated Brand data helper / service method
**File:** `app/Services/BrandService.php`

Add a new method that returns the brands in the shape the views need (same keys used in Blade: `path`, `id`, `title`/`name` etc.), backed by the existing `brands.ordered` cache key.

```php
public function getClientBrands(): Collection
{
    return Cache::remember('brands.ordered', 600, function () {
        return Brand::with('media')
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(fn ($brand) => [
                'id'    => $brand->id,
                'name'  => $brand->name,
                'slug'  => $brand->slug,
                'title' => $brand->name,        // header.listing uses $brand['title']
                'path'  => optional($brand->media->firstWhere('pivot.type', 'logo'))->file_path ?? '',
            ])
            ->all();
    });
}
```

If the pivot table has no `type` column (the `media` table has `file_type` directly on the model), use `firstWhere('file_type', 'logo')` instead.

### Step 2 — Make the data available to all client views via a composer
**File:** `app/Providers/AppServiceProvider.php` (already has `use Brand;`)

```php
use Illuminate\Support\Facades\View;

public function boot(): void
{
    // existing observer setup …

    View::composer(
        [
            'client.index',
            'client.products.listing',
            'client.partials.header',
        ],
        function ($view) {
            $brands = app(\App\Services\BrandService::class)->getClientBrands();
            $view->with('brands', $brands);
        }
    );
}
```

### Step 3 — Update Blade views to use `$brands` variable instead of `config('brands')`

**Files to edit:**

- `resources/views/client/index.blade.php:307`
  Replace:
  ```blade
  @foreach (config('brands') as $key => $item)
  ```
  With:
  ```blade
  @foreach ($brands as $key => $item)
  ```
  — Note: also fix the active class logic (`$loop->index` is fine, but `$loop->first` is more idiomatic).

- `resources/views/client/partials/header.blade.php:99`
  Replace:
  ```blade
  @foreach (config('brands') as $key => $brand)
  ```
  With:
  ```blade
  @foreach ($brands as $key => $brand)
  ```

- `resources/views/client/products/listing.blade.php:141`
  Replace:
  ```blade
  @foreach (config('brands') as $brand)
  ```
  With:
  ```blade
  @foreach ($brands as $brand)
  ```

### Step 4 — Revert the prior `Config::set` change in AppServiceProvider
The earlier edit to `boot()` that does `Config::set('brands', ...)` should be removed to avoid confusion and to honor the "dynamic + cache" requirement. Change ownership from config to view-composer.

### Step 5 — Verify keys referenced in views match the new shape
| View | Keys used |
|------|-----------|
| `client/index.blade.php` | `$item['path']` |
| `client/partials/header.blade.php` | `$brand['title']` (via `?? 'N/A'`) |
| `client/products/listing.blade.php` | `$brand['id']`, `$brand['title']` (via `?? ''`) |

The new helper must ensure `title`, `id`, and `path` are present. If the views reference any other keys, add them to the map.

### Step 6 — Keep existing `BrandObserver` cache flush
No change needed. `BrandObserver::creating/updating/deleting` already calls `Cache::forget('brands.ordered')`, so the composer-backed cache will auto-refresh.

### Step 7 — Validation
- Run `php artisan tinker` to confirm `brands.ordered` cache key is correctly set.
- Hit `http://127.0.0.1:8000` in the browser and confirm 200.
- Confirm no more `foreach() argument must be of type array|object, null given` error.

## Tradeoffs / Alternatives considered
- **Config file (`config/brands.php`) + artisan command to refresh**: rejected because user explicitly asked for dynamic + cache handling instead of config.
- **Direct query without cache**: rejected because that hits the database on every page load.
- **View composer + cache**: selected because it lazily hydrates the collection, auto-invalidates via existing observer, and avoids touching individual controllers.

## Final files changed
1. `app/Services/BrandService.php` — add `getClientBrands()` method.
2. `app/Providers/AppServiceProvider.php` — add `View::composer(...)` call; remove `Config::set('brands', ...)` block.
3. `resources/views/client/index.blade.php` — replace `config('brands')` with `$brands`.
4. `resources/views/client/partials/header.blade.php` — replace `config('brands')` with `$brands`.
5. `resources/views/client/products/listing.blade.php` — replace `config('brands')` with `$brands`.
