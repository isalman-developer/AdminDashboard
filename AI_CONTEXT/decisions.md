# Architecture Decisions

## Decision 1
**PostgreSQL** chosen for recursive CTE support.
Reason: Efficient MLM tree traversal.

## Decision 2
**Service Layer is mandatory** for all business logic — controllers must be thin.
Reason: Ensures testability + maintainability.

## Decision 3
**Repository Layer is mandatory** for all data access — services must not call Eloquent directly.
Reason: Separation of concerns; allows swapping data sources without touching business logic.

## Decision 4
**Adjacency list model** for MLM tree (`parent_id` on users table).
Reason: Simple + scalable with Redis caching.

## Decision 5
**Spatie Permissions package** for RBAC.
Reason: Industry standard, battle-tested on Laravel.

## Decision 6
**FormRequest classes** for all input validation, placed under `app/Http/Requests/Admin/<Domain>/<Action>Request.php`.
Reason: Consistent with existing project convention (RoleStoreRequest, PermissionUpdateRequest, SettingStoreRequest).

## Decision 7
**Settings stored in `settings` table**, accessed via `setting()` / `settings()` helpers backed by `SettingService` + `SettingRepository`.
Reason: Centralised, cached, type-safe config alternative to `.env`.

## Decision 8
**Navbar user-dropdown** contains exactly three items: Profile, Settings, Logout.
Reason: Clean UX; Billing/Pricing/FAQ template placeholders removed; identity header with dynamic name/role only.
