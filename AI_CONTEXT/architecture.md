# Architecture Overview

## System Type
Web-based SaaS platform (multi-tenant capable)

## Suggested Stack
- Frontend: Blade + TailwindCSS
- Backend: Laravel 12
- Database: PostgreSQL
- Cache: Redis
- Queue: Redis
- Auth: Spatie Roles & Permissions
- Storage: Local Storage
# Laravel Architecture Design

## Pattern
- Service Layer (Business Logic)
- Repository Layer (Database Access)
- Action Classes (Single-purpose operations)
- DTOs (Data Transfer Objects)

---

## Folder Structure (Core)

app/
 ├── Services/
 │    ├── MLM/
 │    ├── Commission/
 │    ├── Wallet/
 │
 ├── Repositories/
 │    ├── UserRepository.php
 │    ├── ReferralRepository.php
 │
 ├── Actions/
 │    ├── CreateUserAction.php
 │    ├── ProcessCommissionAction.php
 │
 ├── DTOs/
 │    ├── CommissionDTO.php
 │
 ├── Models/
 ├── Http/
 │    ├── Controllers/
 │    ├── Requests/

---

## MLM Engine Design
- Tree stored using adjacency list (parent_id)
- Optimized queries via recursive CTE (PostgreSQL)
- Cached upline chains in Redis (optional)


## Commission Flow

Order Created →
Payment Confirmed →
CommissionService →
Upline Traversal →
WalletService →
Transaction Logged

## Core Modules

### 1. User Module
- Authentication
- Profile
- Wallet

### 2. Referral Module
- Referral link generation
- Tree management
- Upline tracking

### 3. Commission Engine
- Rule-based calculation
- Level-based rewards
- Product-based commission rules

### 4. Product Module
- Product listing
- Pricing
- Commission mapping

### 5. Payment Module
- Earnings wallet
- Withdrawal requests
- Payout tracking

### 6. Admin Module
- User management
- Fraud detection
- Commission override tools

## Data Flow (High Level)
User Purchase → Order Service → Commission Engine → Wallet Update → Notifications