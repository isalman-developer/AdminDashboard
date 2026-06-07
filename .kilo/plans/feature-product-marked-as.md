# Plan: Product Catalog "Marked As" Feature

## Goal
Replace the current implicit numeric IDs with a proper **Normal | Featured | Best Seller | Sale | Top Rated | Top Deal** catalog on `products`.

## Approach
Use a lookup model + seeded enum-like records + accessor on `Product`.

## 1. Seedable marker records
Create `app/Models/MarkedAs.php` and a migration. The seed/factory will create exactly these 6 entries with fixed IDs so existing queries (`marked_as_id = 1..6`) keep working without hardcoding.

## 2. Stable seeded IDs
Seed with explicit IDs:
1 => Normal
2 => Featured
3 => Best Seller
4 => Sale
5 => Top Rated
6 => Top Deal

This avoids changing the controllers or views.

## 3. Model relationship
`Product::markedAs()` exists already in `app/Models/Product.php:71`.
Update `MarkedAs` as needed for the relationship shape.

## 4. Validation / untrusted input for `marked_as_id`
- Reject non-numeric input early
- Enforce `marked_as_id` must be one of `1..6`
- Use a Form Request or inline guard; never trust raw query param values

## 5. Keep UI / admin flows isolated
Leave the sealed `admin.` boundary intact; do not add public CRUD or registration for markers.
