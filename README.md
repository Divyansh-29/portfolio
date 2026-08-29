# Divyansh Chawla — Full-Stack Laravel Portfolio & CMS

A full-stack portfolio and dynamic content management system built with Laravel 12, Blade, SQLite/MySQL, REST APIs, authentication, and security protections.

---

## Features

- **Dynamic Frontend**: High-performance Blade templates preserving the original design, prelude loader, custom art badges, responsive design, and smooth interactions.
- **Admin Dashboard**: Full CRUD management for:
  - **Projects** (Titles, descriptions, slugs, art styles, tags, live links, sort ordering)
  - **Experience & Education** (Companies, institutions, roles, dates, descriptions)
  - **Toolkit & Capabilities** (Skills, categories, tools list, ordering)
  - **Inquiries Inbox** (Incoming contact submissions, read/unread states, IP tracking)
  - **Site Settings & Bio** (Live editing for hero headlines, copy, facts/counters, marquee strip, SEO tags, contact info)
- **Interactive Contact System**: Direct message submission with CSRF protection, rate limiting (`throttle:5,1`), email formatting, and backend inbox storage.
- **RESTful APIs**: Clean JSON endpoints under `/api/v1/` for headless use or integrations.
- **Security**: Bcrypt password hashing, session regeneration, rate limiting, XSS escaping, SQL injection prevention via Eloquent ORM.

---

## Getting Started

### 1. Requirements
- PHP 8.2+ (with `pdo_sqlite`, `mbstring`, `openssl`, `tokenizer`, `curl`, `xml`)
- Composer 2+

### 2. Setup & Database
```bash
# Install dependencies (already installed)
composer install

# Run migrations and seed sample content
php artisan migrate:fresh --seed

# Start the local development server
php artisan serve
```

---

## Admin Credentials

- **Admin Login URL**: `http://127.0.0.1:8000/admin/login`
- **Email**: `admin@divyansh.dev`
- **Password**: `Admin12345!` *(Can be updated directly in the Admin Settings panel)*

---

## RESTful API Endpoints

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/v1/profile` | Get public bio, settings, and statistics |
| `GET` | `/api/v1/projects` | List all featured projects |
| `GET` | `/api/v1/projects/{id_or_slug}` | Get single project details |
| `GET` | `/api/v1/experiences` | List career timeline entries |
| `GET` | `/api/v1/skills` | List toolkit and skills |
| `POST` | `/api/v1/contact` | Submit contact inquiry (rate limited) |

---

## Running Automated Tests

```bash
php artisan test
```
All feature and unit test cases run against in-memory SQLite with database refreshing.
