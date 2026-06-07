# Laptop E-Commerce Admin Panel Refactor Plan

## Goal
Convert the mixed-domain admin panel (currently MLM/referral + generic admin) into a **clean Laptop E-Commerce Store** admin panel.

---

## Analysis Summary
The codebase still contains a fully wired **MLM/referral system** that conflicts with a laptop store:
- `User` model has `referral_code`, `parent_id`, `wallet_balance` + parent/children relationships
- `ReferralService`, `ReferralRepository`, `ReferralController`, `referrals.blade.php`
- `api.php` has `/referral/link` and `/referral/tree` endpoints
- `web.php` has `UserManagementController::referrals()` route
- `UserSeeder` creates users with referral codes and parent/upline links
- Blade views (users/index, create, edit, edit_roles, referrals) display wallet balances and referral trees
- `CreateUserRequest` validates `referral_code`
- BV/PV on `Product` are MLM commission/volume concepts — irrelevant for e-commerce

**Decision: Strip the referral/MLM subsystem entirely. Add e-commerce-relevant fields where needed.**

---

## Changes Overview

### 1. Database Migration — Remove MLM Columns from Users
- **New migration**: Drop `referral_code`, `parent_id`, `wallet_balance` from `users` table

### 2. Models
- **`User.php`**:
  - Remove `referral_code`, `parent_id`, `wallet_balance` from `$fillable`
  - Remove `parent()` and `children()` relationship methods
- **`Product.php`**:
  - Remove `bv` and `pv` from `$fillable`
  - Add `warranty_months` (integer, default 12) and `discount_percent` (integer, default 0) to `$fillable`
  - Update casts for new fields
- **`Category.php`**: No changes needed (already laptop-themed)

### 3. Remove Referral Subsystem Files
- Delete `app/Services/ReferralService.php`
- Delete `app/Repositories/ReferralRepository.php`
- Delete `app/Http/Controllers/Api/ReferralController.php`
- Delete `resources/views/admin/users/referrals.blade.php`
- Delete `database/factories/` referral-related factory logic if any

### 4. Routes
- **`routes/web.php`**:
  - Remove `UserManagementController@referrals` route (`admin.users.referrals`)
- **`routes/api.php`**:
  - Remove `ReferralController` routes (`/referral/link`, `/referral/tree`)
  - Keep `/health` endpoint (already updated to "Laptop Store API")

### 5. Services
- **`UserManagementService.php`**:
  - Remove `ReferralService` from constructor dependency
  - Remove `getReferralTree()` method
  - Remove referral logic from `createUser()` (remove sponsor lookup, referral code generation, parent_id assignment)
  - Simplify `createUser()` to just create user with name, username, email, password, status
- **`UserRepository.php`**:
  - Remove `referralCodeExists()` method

### 6. Controllers
- **`UserManagementController.php`**:
  - Remove `referrals()` method

### 7. Form Requests
- **`CreateUserRequest.php`** (and UserRequest if separate):
  - Remove `referral_code` validation rule

### 8. Seeders
- **`UserSeeder.php`**:
  - Remove `referral_code`, `parent_id`, `wallet_balance` from admin creation
  - Create 10 regular users without parent/upline links
  - Assign 'User' role to all
- **`ProductSeeder.php`**: Already updated with laptop products ✓
- **`CategorySeeder.php`**: Already updated with laptop categories ✓

### 9. Product Form & Validation Updates
- **`ProductStoreRequest.php`** & **`ProductUpdateRequest.php`**:
  - Remove `bv` and `pv` validation rules
  - Add `warranty_months` (nullable, integer, min:0)
  - Add `discount_percent` (nullable, integer, min:0, max:100)
- **`resources/views/admin/products/form.blade.php`**:
  - Remove BV and PV input fields
  - Add Warranty (months) and Discount (%) input fields
- **`resources/views/admin/products/index.blade.php`**:
  - Remove BV / PV column, replace with Warranty column
- **`resources/views/admin/products/show.blade.php`**:
  - Remove BV / PV detail row, add Warranty row
- **`ProductService.php`**: No structural changes needed (uses repository pattern)

### 10. Blade Views — Remove Referral/MLM References
- **`users/index.blade.php`**:
  - Remove Wallet Balance column from table
  - Remove Referral Code column from table
  - Remove "Referral Tree" action button
  - Remove wallet_balance and referral_code from view modal
- **`users/create.blade.php`**:
  - Remove entire "Auto-Managed Fields" card (Referral Code, Wallet Balance, Parent/Upline)
  - Remove sidebar info about referral/wallet/parent
- **`users/edit.blade.php`**:
  - Remove Wallet Balance row
  - Remove Referral Code row
  - Remove Parent/Upline row
  - Remove "System Fields (Read-Only)" card entirely
- **`users/edit_roles.blade.php`**:
  - Remove Wallet Balance row from user info sidebar
- **`partials/sidebar.blade.php`**:
  - Remove "Referrals" menu item from eCommerce submenu

### 11. Dashboard — E-Commerce Content
- **`welcome.blade.php`**:
  - Replace "Website Analytics" with "Store Overview" (laptop inventory stats)
  - Replace "Average Daily Sales" with "Total Products" / "Low Stock Alerts"
  - Replace "Sales Overview" with "Revenue Overview" (store revenue, orders)
  - Replace "Earning Reports" with "Top Categories" or "Inventory Status"
  - Replace "Support Tracker" with "Recent Activity" or "Orders Overview"
  - Replace "Total Earning" with "Category Performance" or "Stock Value"
  - Replace "Monthly Campaign State" with "Brand Distribution" or "Orders by Brand"
  - Remove `scripts` and `endpush` sections that reference dashboard analytics JS (if those JS files are MLM-specific)

### 12. Config
- **`config/app.php`**:
  - Remove `referral_register_path` config entry

### 13. Cleanup
- Run `php artisan migrate:fresh --seed` after migration is written
- Verify no remaining `referral`, `wallet_balance`, `parent_id`, `bv`, `pv` references in PHP/Blade files

---

## Execution Order
1. Database migration (remove MLM columns)
2. Model updates (User + Product)
3. Delete referral subsystem files
4. Update routes (web + api)
5. Update services (UserManagementService + UserRepository)
6. Update controllers
7. Update form requests
8. Update seeders
9. Update product form/validation/views (BV/PV → warranty/discount)
10. Update user blade views (remove wallet/referral)
11. Update dashboard (welcome.blade.php)
12. Update config
13. Migrate + seed
14. Final grep verification

---

## Risks / Notes
- `User` factory (`database/factories/`) may reference `referral_code`/`wallet_balance`/`parent_id` — needs inspection and cleanup
- Dashboard components (`<x-dashboard.*>`) may be vendor-provided; if they don't support new props, the dashboard update may need simplification
- BV/PV removal changes the product table schema — new migration needed to drop those columns and add new ones
