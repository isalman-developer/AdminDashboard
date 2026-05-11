# Architecture Decisions

## Decision 1
PostgreSQL chosen for recursive CTE support
Reason: Efficient MLM tree traversal

## Decision 2
Service Layer is mandatory for all business logic
Reason: Ensures testability + maintainability

## Decision 3
Adjacency list model for MLM tree
Reason: Simple + scalable with caching

## Decision 4
Spatie Permissions package used
Reason: Industry standard role system for Laravel