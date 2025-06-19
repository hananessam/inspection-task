# Laravel Modular SaaS App (Team Availability & Booking System)

Laravel 12-based SaaS application using:

- `nWidart/laravel-modules` for modular architecture
- Team management
- Weekly availability & slot generation
- Token-based authentication via Laravel Sanctum
- `spatie/laravel-multitenancy` for tenant isolation

---

## 📦 Features

- Modular service-based structure (Teams, Auth, Tenants, Bookings, etc.)
- Recurring weekly availability per team
- Slot generation per date range (1-hour slots)
- Booking conflict prevention
- Multi-tenant support with automatic scoping
- RESTful API

---

## 🛠️ Installation

```bash
composer install
cp .env.example .env
php artisan key:generate

php artisan migrate

php artisan db:seed

php artisan module:seed Tenant Team
```
## 🌐 Usage
login as `admin@example.com` with password `password`