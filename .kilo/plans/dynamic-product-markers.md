# Plan: Dynamic Product Markers

## Goal
Use the 6-row `marked_as` table as the single source of truth for product markers, and handle the case where a product still references a marker that gets deleted.

## Marker Data (Seeded)
| id | name |
|----|------|
| 1 | Normal |
| 2 | Featured |
| 3 | Best Seller |
| 4 | Sale |
| 5 | Top Rated |
| 6 | Top Deal |

## Model: `app/Models/MarkedAs.php`
- Use `SoftDeletes` if you want to keep history, **or** no soft deletes.
- Relationship: `public function products(): HasMany`.

## Product Model update (`app/Models/Product.php`)
- `markedAs()` relationship: remove `withTrashed()` so a deleted marker falls back to `withDefault()`.
- Add accessor: `getMarkedAsNameAttribute()` returning `$this->markedAs->name ?? 'Normal'` — lets views use `$product->marked_as_name` instead of conditionals.

## Deleted-marker scenario (core requirement)
Two options; recommend **Option A**:

**Option A (recommended):** Disallow deletion in admin controller, null out FK on request, and if FK becomes null treat as "Normal".
- Admin controller: remove `destroy` route.
- `ProductController` (admin): on update, if `marked_as_id` input is empty/null, set to `1` (Normal).
- Database default: `products.marked_as_id` default `1` on new rows.
- This means a product never has a broken/invalid marker; there is no "orphaned marker" state.

**Option B:** Allow deletion, fallback to `Normal` everywhere.
- Add a global accessor / query scope `scopeMarked($q, $id)` that substitutes `1` when the stored id is missing from `marked_as`.
- More defensive but adds DB round-trips on every listing.

## Admin routes
Add to existing `routes/web.php` admin group:
- `GET /admin/markers` → `MarkedAsController@index`
- `GET /admin/markers/{markedAs}/edit`
- `PUT /admin/markers/{markedAs}` → updates `name` only
- NO `create`, `store`, `destroy` routes.

## Validation
- Accept only integer `marked_as_id` that exists in `marked_as`.
- If not provided, coerce to `1` (Normal).

## Cleanup in `HomeController`
Remove the two stale queries using `marked_as_id = 8` and `marked_as_id = 9`.
Optionally extract the repeated "random active products by marker" pattern into a small private method to reduce duplication.

## Migration needed
If `2026_06_07_000003_add_oldproject_entities_and_product_columns.php` was never found in the filesystem, create a new one with:
- `marked_as` table (id name created_at updated_at)
- Update `products.marked_as_id` nullable FK with default if not already done
- Seed statement using direct SQL / DB::table to lock IDs to 1–6 (so seeded by migration, not by seeder class).
