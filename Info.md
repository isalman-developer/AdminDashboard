MLM & Referral Marketing Platform
Software Requirements Specification (SRS)
Version: 1.0
Prepared By: Salman
Technology Stack: Laravel 12, PHP 8.4, PostgreSQL, Tailwind CSS, Livewire, Alpine.js, Redis
Document Type: Client-Facing Requirements & Technical Specification
Last Updated: April 2026

1. Executive Summary
    1.1 Project Overview
    The MLM & Referral Marketing Platform is a custom web-based application developed for a single client to manage referral and multi-level marketing (MLM) operations.
    The system will provide a centralized platform to manage:
    • Users and distributors
    • Referral links and registrations
    • MLM genealogy trees
    • Products and packages
    • Commission calculations
    • Wallets and withdrawals
    • Analytics and reporting
    • Multi-language content and interface translations
    The platform is designed as a financial-grade transactional system with strong auditability, scalability, security, and maintainability.

1.2 Business Objectives
The platform aims to:
    • Automate referral and MLM commission distribution.
    • Support product sales and package upgrades.
    • Deliver detailed analytics and reporting.
    • Ensure regulatory compliance (GDPR, audit logging).
    • Provide a multilingual web-based experience for administrators and members.

1.3 Target Users
Super Admin
Has full control over the entire application and system settings.
Admin
Manages the MLM business operations for the client.
Members / Distributors
Participate in the network, earn commissions, and manage withdrawals.
Finance Team
Reviews and processes payouts.
Support Team
Handles customer inquiries and tickets.

2. Scope of Work
    Included in Scope
    • Public website and registration flow
    • Admin panel
    • Member dashboard
    • MLM engine
    • Referral system
    • Wallet and payout system
    • Product and package management
    • Analytics
    • Multi-language support
    • Audit logging
    • GDPR features
    Out of Scope (Phase 1)
    • Native mobile applications
    • Automated banking integrations
    • Cryptocurrency payments
    • Mobile applications

3. Technology Stack
    Backend
    • Laravel 12
    • PHP 8.4
    • PostgreSQL 16+
    • Redis
    • Laravel Horizon
    • Laravel Queue Workers
    Frontend
    • Blade
    • Tailwind CSS
    • Livewire
    • Alpine.js
    Infrastructure
    • Ubuntu Server
    • Nginx
    • Supervisor
    • SSL via Let's Encrypt
    Integrations
    • Email (SMTP / SES)

4. Functional Requirements
    4.1 Authentication & Authorization
    Features
    • User registration
    • Login/logout
    • Password reset
    • Email verification
    • Two-factor authentication (optional)
    • Role-based access control
    Roles
    • Super Admin
    • Admin
    • Finance Manager
    • Support Agent
    • Member

4.2 User Management
Admin Capabilities
• Create/edit/delete users
• Activate/deactivate accounts
• View genealogy tree
• Reset passwords
• Assign sponsors
• Update KYC status
Member Data
• Profile information
• Contact details
• Government ID (optional)
• Bank/payment details

4.4 Referral System
Features
• Unique referral code
• Referral links
• Sponsor tracking
• Referral registration
• Direct referral reports
Example Referral Link
https://example.com/register?ref=ABC123

4.5 MLM Tree Management
Supported Plans
• Unilevel
• Binary
• Matrix
• Hybrid (future)
Tree Features
• Tree view visualization
• Sponsor tree
• Placement tree
• Downline reports
• Left/right leg statistics

4.6 Packages & Registration Plans
Features
• Multiple package tiers
• Registration fees
• PV/BV assignment
• Upgrade paths
• Activation rules
Fields:
• Name
• Price
• Business Volume (BV)
• Point Volume (PV)
• Commission eligibility

4.7 Product Management
Features
• Categories
• Products
• Images
• Inventory
• Product purchases
• Product-triggered commissions
Fields:
• Name
• SKU
• Description
• Price
• PV/BV value
• Stock quantity

4.8 Commission Engine
Supported Commission Types
• Direct referral commission
• Level commission
• Binary commission
• Matching bonus
• Rank bonus
• Matching bonus
Commission Workflow 1. Trigger event (registration, purchase, upgrade) 2. Queue commission job 3. Traverse hierarchy 4. Apply rules 5. Create commission records 6. Credit wallet 7. Generate audit logs

4.10 Wallet System
Wallet Types
• Commission Wallet
• Bonus Wallet
• Reward Wallet
• Withdrawable Wallet
Features
• Ledger-based transactions
• Balance tracking
• Credits/debits
• Transfer history

4.11 Withdrawal System
Member Features
• Request withdrawal
• View withdrawal history
Admin Features
• Approve/reject withdrawals
• Mark as paid
• Apply fees
Rules
• Minimum withdrawal amount
• Processing fee
• Available withdrawal windows

4.12 Awards & Rewards
• Cash awards
• Travel rewards
• Physical prizes
• Achievement tracking

4.13 Analytics Dashboard
Metrics
• Total members
• Active members
• Sales revenue
• Commissions paid
• Pending withdrawals
• Top performers
• Growth trends

4.14 Support System
• Support tickets
• Ticket replies
• Status tracking
• Internal notes

4.16 Notifications
• Email notifications
• In-app notifications
Events:
• Registration
• Commission earned
• Withdrawal status
• Rank achievement

4.16 CMS Management
• FAQs
• Terms & Conditions
• Privacy Policy
• Contact Page

5. Non-Functional Requirements
    Performance
    • < 2 second average response time
    • Queue-based background processing
    • Optimized recursive queries
    Scalability
    • Support millions of commission records
    • Horizontal queue scaling
    Security
    • OWASP best practices
    • CSRF/XSS protection
    • Rate limiting
    • Encrypted sensitive data
    Reliability
    • Database transactions
    • Idempotent jobs
    • Daily backups
    Usability
    • Responsive web design
    • Accessible UI
    Compliance
    • GDPR
    • Audit logging

6. GDPR Compliance Requirements
    • Consent capture
    • Privacy policy acceptance
    • Data export
    • Right to erasure
    • Data retention controls

7. System Architecture
    Architectural Pattern
    • MVC + Service Layer
    • Repository Pattern
    • DTOs
    • Domain Services
    • Event-Driven Processing
    Key Layers
    • Controllers
    • Form Requests
    • Services
    • Repositories
    • Jobs
    • Events & Listeners
    • Policies

8. Database Overview
    Core Tables
    • users
    • roles
    • permissions
    • referral_codes
    • tree_nodes
    • packages
    • products
    • orders
    • commissions
    • wallets
    • wallet_transactions
    • withdrawals
    • support_tickets
    • notifications
    • audit_logs

9. MLM Data Model
    User Hierarchy
    • sponsor_id
    • placement_parent_id
    • position (left/right)
    Tree Storage
    • Adjacency list for simplicity
    • Optional closure table for performance

10. Commission Calculation Rules
    Commission rules are configurable through the admin panel.
    Each rule contains:
    • Trigger event
    • Eligibility criteria
    • Percentage/fixed amount
    • Maximum levels
    • Qualification requirements

11. API Requirements (Optional)
    REST APIs for:
    • Authentication
    • Dashboard data
    • Wallet transactions
    • Tree visualization
    • Withdrawals

12. User Interface Requirements
    Public Website
    • Home
    • About
    • Compensation Plan
    • Products
    • Register
    • Login
    Member Dashboard
    • Earnings summary
    • Referral link
    • Tree view
    • Wallet
    • Withdrawals
    Admin Dashboard
    • Analytics
    • User management
    • Commission settings

13. Audit Logging
    Track:
    • Admin actions
    • Commission creation
    • Wallet changes
    • Withdrawal approvals
    • Login attempts

14. Development Phases
    Phase 1 – Foundation
    • Authentication
    • Roles and permissions
    • Application setup
    Phase 2 – Core MLM
    • Referral registration
    • Tree management
    • Packages
    Phase 3 – Financial System
    • Commissions
    • Wallets
    • Withdrawals
    Phase 4 – Product Management
    • Product catalog
    • Product-triggered commissions
    Phase 5 – Reporting & Localization
    • Analytics
    • Multi-language support
    Phase 6 – Hardening
    • GDPR
    • Audit logs
    • Performance tuning

15. Deliverables
    • Source code
    • Database migrations
    • Seeders
    • API documentation
    • Technical documentation
    • Deployment guide
    • Test suite
    • Admin/user manuals

16. Testing Strategy
    Automated Tests
    • Unit tests
    • Feature tests
    • Integration tests
    Manual QA
    • User acceptance testing
    • Regression testing

17. Deployment Requirements
    • CI/CD pipeline
    • Staging environment
    • Production environment
    • Monitoring and alerts

18. Acceptance Criteria
    The project will be accepted when:
    • All specified modules are implemented.
    • Commission calculations are accurate.
    • Wallet balances reconcile with ledger transactions.
    • Multi-language support is fully functional.
    • Security and performance benchmarks are met.

19. Risks & Mitigation
    Risk
    Mitigation
    Complex commission logic
    Configurable rule engine and extensive testing
    Large tree queries
    Optimized schema and caching
    Financial inconsistencies
    Ledger-based accounting
    Fraud
    KYC, audit logs, anomaly detection
    Performance issues
    Queue workers and indexing

20. Estimated Timeline
    Phase
    Duration
    Discovery & Planning
    1–2 weeks
    Architecture & Database
    1 week
    Core Development
    8–12 weeks
    Testing & QA
    2–3 weeks
    Deployment
    1 week
    Total Estimated Duration: 12–18 weeks

21. Conclusion
    This MLM & Referral Marketing Platform is designed as a robust, scalable web application for a single client. It supports complex commission structures, referral hierarchies, multilingual content, and financial workflows. The architecture emphasizes maintainability, security, and extensibility, making it suitable for long-term business operations.
