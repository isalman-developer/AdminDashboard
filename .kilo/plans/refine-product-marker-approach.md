# Refine Product Marker Approach

## Use-case
Render exactly six marker badges on storefront: Normal, Featured, Best Seller, Sale, Top Rated, Top Deal.

## Decision: Dynamic lookup with fixed IDs
Create the `marked_as` table with six rows seeded at explicit IDs 1–6. This is the best approach because:
- Existing storefront controllers already filter by `marked_as_id` (1–6) — no controller/view churn.
- Admin can rename the labels later without code changes.
- Preserves stable IDs if any seeders or fixtures already depend on them.

## Remove stale IDs 8 and 9
`HomeController` still references `marked_as_id = 8` and `9`. Since you only want six markers, those queries will be removed rather than preserved.

## Admin control
Add a lightweight admin CRUD for markers behind the existing `admin.` boundary:
- `MarkedAsController@index` / `edit` / `update`
- Disallow create/delete so the six records and their IDs remain stable.
- Enforce `name` max-length and trim whitespace.

## Invariants to enforce
- Exactly six rows with IDs 1–6.
- If a marker is accidentally deleted, a reseeder restores it; the controller rejects create/destroy routes.
- Front-end always checks `product->markedAs->name` rather than numeric constants when rendering badges.
