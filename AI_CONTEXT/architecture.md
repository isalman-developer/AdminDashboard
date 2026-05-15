# Architecture Overview

## System Type
Web-based SaaS platform (multi-tenant capable, MLM focus)

## Stack
- Frontend: Blade + TailwindCSS
- Backend: Laravel 12
- Database: PostgreSQL
- Cache: Redis
- Auth: Spatie Roles & Permissions
- Storage: Local Storage

---

## Laravel Architecture Design

### Pattern
- **Service Layer** — Business logic (callable from controllers, queues, actions)
- **Repository Layer** — Data access only (Eloquent queries, no business logic)
- **Form Request Layer** — Validation under `app/Http/Requests/Admin/<Domain>/<Action>Request.php`
- **Controller Layer** — Thin: validate → delegate to service → return response

### Controller → Service → Repository → Model flow

```
Controller                  Service                  Repository             Model
   │                          │                         │                     │
   │── validate() ──────────▶│                         │                     │
   │                            │── repo method() ──────▶│── query ──────────▶│
   │                            │◀── return model ───────│◀── result ─────────│
   │◀── redirect/flash ────────│                         │                     │
```

---

## Folder Structure (Implemented)

```
app/
 ├── Services/
 │    ├── SettingService.php          ✅ completed
 │    ├── UserService.php             ✅ completed
 │    ├── PermissionService.php       ✅ completed (this session)
 │    ├── RoleService.php             ✅ completed (this session)
 │    ├── UserManagementService.php   ✅ completed (this session)
 │    ├── MLM/                        ⬜ pending
 │    ├── Commission/                 ⬜ pending
 │    └── Wallet/                     ⬜ pending
 │
 ├── Repositories/
 │    ├── SettingRepository.php       ✅ completed
 │    ├── UserRepository.php          ✅ completed (refactored this session)
 │    ├── PermissionRepository.php    ✅ completed (this session)
 │    ├── RoleRepository.php          ✅ completed (this session)
 │    └── ReferralRepository.php      ⬜ pending
 │
 ├── Actions/                        ⬜ pending
 ├── DTOs/                           ⬜ pending
 ├── Models/                         (User, Setting, Role, Permission, Media)
 ├── Http/
 │    ├── Controllers/
 │    │    ├── AdminAuthController.php    ✅ (profile/settings via UserService)
 │    │    ├── HomeController.php         ✅
 │    │    ├── PermissionController.php   ✅ (via PermissionService)
 │    │    ├── RoleController.php         ✅ (via RoleService)
 │    │    ├── UserManagementController.php ✅ (via UserManagementService)
 │    │    └── SettingsController.php     ✅ (via SettingService)
 │    └── Requests/Admin/
 │         ├── Permission/                ✅ existing
 │         ├── Role/                      ✅ existing
 │         ├── Setting/                   ✅ existing
 │         └── User/                      ✅ existing (authorize bug fixed)
 └── Observers/
      └── SettingObserver.php        ✅ clears repo cache on CRUD
```

---

## How SettingsController exemplifies the pattern *(SettingsController is the gold standard)*

```php
// Controller — thin, no model logic
public function store(SettingStoreRequest $request, SettingService $settingService)
{
    $validated = $request->validated();           // 1. FormRequest validates
    $settingService->setMultiple([...]);           // 2. Service does business logic
    return redirect()...;                          // 3. Return response
}

// Service — orchestrates, delegates to repo
class SettingService {
    public function setMultiple(array $settings): array {
        foreach ($settings as $key => $value) {
            $results[$key] = $this->set($key, $value);   // calls Repository
        }
    }
}

// Repository — data access only
class SettingRepository {
    public function set(string $key, string $value): Setting {
        $setting = Setting::updateOrCreate([...]);       // raw Eloquent
        $this->cache->put(...);                           // cache management
        return $setting;
    }
}
```

All other controllers were refactored to match this exact structure.

---

## MLM Engine Design
- Tree stored using adjacency list (`parent_id` on `users` table)
- Optimised queries via recursive CTE (PostgreSQL)
- Cached upline chains in Redis (optional)

## Commission Flow
Order Created → Payment Confirmed → CommissionService → Upline Traversal → WalletService → Transaction Logged

## Core Modules

### 1. User Module
- Authentication ✅
- Profile ✅ (`/admin/profile`, `/admin/profile/edit`)
- Wallet ⬜

### 2. Referral Module
- Referral link generation ⬜
- Tree management ⬜
- Upline tracking ⬜ (structure present: `parent()` / `children()` on User model)

### 3. Commission Engine
- Rule-based calculation ⬜
- Level-based rewards ⬜
- Product-based commission rules ⬜

### 4. Product Module
- Product listing ⬜
- Pricing ⬜
- Commission mapping ⬜

### 5. Payment Module
- Earnings wallet ⬜
- Withdrawal requests ⬜
- Payout tracking ⬜

### 6. Admin Module
- User management ✅
- Roles & Permissions ✅
- Settings ✅
- Fraud detection ⬜
- Commission override tools ⬜
