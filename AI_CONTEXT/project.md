# Project Overview

## Name
MLM Affiliate & Referral Platform

## Purpose
A scalable MLM (multi-level marketing) affiliate platform where users earn commissions and bonuses by selling products and referring others.

## Core Goals
- Enable user registration and referral tracking
- Support multi-level commission distribution
- Provide product marketplace integration
- Ensure transparent earnings system
- Maintain fraud-resistant referral validation
- Provide analytics for users and admins

## Key Features
- Referral link system
- MLM tree structure (multi-level hierarchy)
- Commission engine
- Bonus rules engine
- Wallet & payout system
- Admin dashboard
- Product catalog integration
- Transaction history

## Non-Goals (for now)
- Crypto payments (unless later added)
- AI-generated products
- Open marketplace listings from users

## Success Criteria
- Accurate commission calculations
- No duplicate/referral fraud
- Scalable to 100k+ users
- <200ms response time for core APIs

## Stack
- Laravel 12 (Monolithic)
- Blade (Server-rendered UI)
- TailwindCSS
- PostgreSQL
- Redis (cache + queues optional)
- Spatie Roles & Permissions


## Critical Rules
- No circular referral chains allowed
- No self-referrals
- All commission calculations must be deterministic
- All wallet updates must be transaction-safe