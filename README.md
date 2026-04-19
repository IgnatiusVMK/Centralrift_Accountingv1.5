# Centralrift Accounting v1.5

> Farm management and financial accounting platform for **Centralrift Fresh Produce Kenya Limited**  a registered farm operation in Kenya's Rift Valley producing kale, spinach, tomatoes, and premium culinary herbs.

---

## Background

Running a small-scale commercial farm generates more paperwork than most people expect. Sales across multiple crop cycles, input purchases spread across dozens of suppliers, stock allocations per planting block, and financial reports that need to reflect only *approved* data  not drafts, not errors, not unreviewed entries.

This platform was built from scratch to handle that reality. It is not a generic accounting tool adapted for agriculture; it is purpose-built for how this farm actually operates.

---

## Key Features

### Cycle-Based Accounting
All financial activity  sales, expenses, credits, and stock usage  is scoped to a **Cycle ID**. A cycle represents a single planting-to-harvest run for a specific crop on a specific block. This means profit and loss reports are meaningful at the cycle level, not just at the year or month level.

### Maker-Checker Approval Workflow
Every financial entry (sales, expenses, credits, purchases, stock allocations) follows a dual-control approval pattern:

- A **maker** (Management role) submits a record  it enters `pending` state
- A **checker** (Admin / Executive role) reviews and approves or rejects it
- Only **approved** entries are included in P&L calculations

This prevents unreviewed or erroneous data from affecting financial reports. The same pattern is used by financial institutions to ensure data integrity on sensitive transactions.

Implementation uses Laravel Gates and Policies (`MakerPolicy`, `CheckerPolicy`), middleware-enforced route access, and `@can` directives for role-sensitive UI rendering.

### Stock Management
A two-layer inventory system:

- **General Stock Pool**  tracks all purchased inputs (seeds, fertilizers, chemicals) across the whole farm
- **Cycle Allocation Table**  records stock drawn from the pool into a specific cycle, with depletion tracking as inputs are used

This makes it possible to answer both "how much fertilizer do we have on the farm?" and "how much of that fertilizer was used in Cycle C-2024-03?" independently.

### OTP Authentication
Time-based OTP as a second authentication factor for sensitive operations.

### Role-Based Access Control
Granular permission system with distinct roles (Admin, Executive, Management) controlling what each user can create, view, and approve.

### Redis Integration
Redis backend used for session management and job queuing.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8 · Laravel |
| Templating | Blade |
| Frontend | Tailwind CSS · SCSS · JavaScript |
| Build | Vite |
| Cache / Queue | Redis |
| Database | MySQL |
| Auth | Laravel Auth · OTP |

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/       # Feature controllers (Sales, Expenses, Cycles, Stock, Checker...)
│   ├── Middleware/        # Role and permission middleware
│   └── Requests/          # Form validation
├── Models/                # Eloquent models
├── Policies/              # MakerPolicy, CheckerPolicy, and feature policies
database/
├── migrations/            # Full schema  cycles, stocks, allocations, usages, purchases...
resources/
├── views/                 # Blade templates
│   ├── layouts/
│   ├── checker/           # Approval queue UI
│   ├── cycles/
│   ├── stock/
│   └── ...
routes/
└── web.php
```

---

## Feature Documentation

Detailed design and implementation documentation is maintained alongside the codebase:

- [`Maker-Checker-Validation_DOCSv1.0.md`](./Maker-Checker-Validation_DOCSv1.0.md.md)  Approval workflow design, policy implementation, and database schema
- [`Stock-Management-DOCS-v1.0.md`](./Stock-Management-DOCS-v1.0.md)  Stock purchase, allocation, depletion workflow, and full migration structures
- [`Otp_Authentication.md`](./Otp_Authentication.md)  OTP auth implementation notes

---

## Roadmap

This codebase (v1.5) is the working Laravel implementation. Active development continues on the `Centralrift_Accounting_V2.0` branch.

A full migration to **Java / Spring Boot** is in progress, targeting:
- Stateless REST API backend
- JWT + OAuth 2.0 authentication
- JPA/Hibernate persistence with Flyway migrations
- Decoupled frontend
- Improved scalability for multi-farm expansion

---

## Local Setup

```bash
git clone https://github.com/IgnatiusVMK/Centralrift_Accountingv1.5.git
cd Centralrift_Accountingv1.5

composer install
npm install

cp .env.example .env
php artisan key:generate

# Configure your database and Redis in .env, then:
php artisan migrate
php artisan db:seed

npm run dev
php artisan serve
```

> **Note:** The committed `.env.encrypted` file contains encrypted environment configuration. You will need to provide your own `.env` for local development.

---

## About

**Centralrift Fresh Produce Kenya Limited** is a registered farm operation in Kenya's Rift Valley. Products include kale, spinach, tomatoes, and premium culinary herbs (basil, chives, rosemary, marjoram, oregano).

This platform is actively used for farm financial management and continues to evolve alongside the business.

---

*Built by [Ignatius V. M. Kariuki](https://github.com/IgnatiusVMK)*