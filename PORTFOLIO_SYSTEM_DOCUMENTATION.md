# Full System Documentation: Laravel Portfolio & CMS

**Project Name**: Divyansh Chawla Portfolio & CMS  
**Framework**: Laravel 12.x / PHP 8.5+  
**Database**: SQLite (`database/database.sqlite`) (Compatible with MySQL / PostgreSQL)  
**Document Path**: `/home/divyansh/Documents/portfolio/PORTFOLIO_SYSTEM_DOCUMENTATION.md`  
**Generated On**: 2026-08-29  

---

## 1. Executive Summary & What Was Done

Your portfolio originally existed as a single static HTML file (`index.html`). It has been converted into a full-stack, dynamic Laravel application with:

1. **Dynamic Frontend Engine**: Converted static HTML into Blade layouts and views (`resources/views/layouts/app.blade.php`, `resources/views/portfolio/index.blade.php`). All animations, custom styling, typography, the interactive prelude loader, and responsive layouts have been preserved 100%.
2. **Database Schema & Eloquent ORM**: 7 tables created with migrations and seeders for `users`, `projects`, `experiences`, `skills`, `facts`, `contact_messages`, and `site_settings`.
3. **Admin Dashboard (CMS)**: A custom admin panel created at `/admin/dashboard` allowing full CRUD control over every aspect of the portfolio without touching code.
4. **Authentication & Access Control**: Secure login/logout system with session management and `AdminMiddleware`.
5. **Interactive Contact Form**: Saves messages directly to the database, displays notifications to visitors, and alerts the admin.
6. **RESTful APIs (`/api/v1/*`)**: Standardized JSON endpoints for headless consumption, mobile apps, or external integrations.
7. **Security Layers**: CSRF tokens, rate limiters (`throttle`), XSS protection via Blade escaping, and Bcrypt password hashing.
8. **Automated Testing Suite**: 9 feature and unit tests with 70 assertions passing.

---

## 2. Credentials & Sensitive Information

> [!IMPORTANT]
> Keep these credentials safe. You can change your admin email and password at any time inside the Admin Dashboard under **Settings & Bio**.

| Service / Role | URL / Location | Username / Email | Password |
|---|---|---|---|
| **Admin Dashboard** | `http://127.0.0.1:8000/admin/login` | `admin@divyansh.dev` | `Admin12345!` |
| **Database File** | `database/database.sqlite` | *(No password needed for local SQLite)* | *(None)* |
| **App Secret Key** | `.env` (`APP_KEY`) | Generated via `php artisan key:generate` | Automatically set in `.env` |

---

## 3. What Works and HOW

### A. Dynamic Frontend (`http://127.0.0.1:8000/`)
* **How it works**: The router dispatches `GET /` to `App\Http\Controllers\PortfolioController@index`.
* **Data Flow**:
  1. Fetches featured projects from the `projects` table (`Project::where('is_featured', true)`).
  2. Fetches timeline items from `experiences`.
  3. Fetches 4-quadrant skill boxes from `skills`.
  4. Fetches statistics/counters from `facts`.
  5. Fetches site copy, headings, and contacts from `site_settings`.
  6. Passes all data to `resources/views/portfolio/index.blade.php`.
* **Visual Identity**:
  - The custom prelude loader counts up dynamically and transitions into the page.
  - The marquee ribbon animates infinitely with dynamic text loaded from settings.
  - Art badges on projects dynamically render the geometric CSS artwork (`tax`, `bhoomi`, `core`, `custom`).

### B. Interactive Contact Form (`POST /contact`)
* **How it works**:
  1. Visitor fills out the form at the bottom of the landing page.
  2. Submits via POST with CSRF verification (`@csrf`).
  3. Handled by `App\Http\Controllers\ContactController@store` with validation rules in `ContactRequest`.
  4. Rate limiter prevents spam (max 5 submissions per minute per IP).
  5. The message is stored in the `contact_messages` table with the visitor's IP address.
  6. Visitor is redirected back with a success alert message (`session('success')`), or receives a JSON response (`201 Created`) if requested via AJAX/fetch.

### C. Admin Panel & CMS (`http://127.0.0.1:8000/admin`)
* **Login & Auth (`/admin/login`)**:
  - Validates credentials using `Auth::attempt()`.
  - Regenerates session ID on login to prevent session fixation attacks.
  - Protected with rate limiter (10 attempts per minute).
  - Unauthenticated requests to `/admin/*` are intercepted by `AdminMiddleware` and redirected to login.
* **Dashboard (`/admin/dashboard`)**:
  - Displays real-time counts for projects, unread inquiries, experiences, and skills.
  - Shows quick-access tables for recent messages and featured projects.
* **Projects Manager (`/admin/projects`)**:
  - Full CRUD (Create, Read, Update, Delete).
  - Configure titles, slugs, visual art badge presets, tags (comma-separated), live links, sort order, and publish/hide toggle.
* **Experience & Timeline Manager (`/admin/experiences`)**:
  - Manage company name, role title, period (e.g. `03/2025 - 12/2025`), location, and description.
* **Toolkit & Skills Manager (`/admin/skills`)**:
  - Manage skill numbering (`01`, `02`), area title, category, and list of technologies.
* **Inquiries Inbox (`/admin/messages`)**:
  - View all visitor messages with timestamps and sender IP.
  - Opening a message automatically marks it as **Read**.
  - Toggle read/unread status.
  - "Reply via Email" button opens default mail client with sender email and subject pre-filled.
  - Delete inquiries.
* **Site Settings & Profile Editor (`/admin/settings`)**:
  - Edit hero headline, eyebrow, bio description, marquee text, about quote, contact email, phone, and copyright tagline in real-time without editing Blade code.
  - Update fact numbers and labels.
  - Update page title (`<title>`) and meta descriptions for SEO.
  - Change your Admin Name, Admin Email, and Admin Password with current password verification.

### D. RESTful API Endpoints (`/api/v1/*`)
All endpoints return structured JSON with status codes:
- `GET /api/v1/profile` → Public profile, settings, and facts.
- `GET /api/v1/projects` → Array of all featured projects.
- `GET /api/v1/projects/{id_or_slug}` → Single project details.
- `GET /api/v1/experiences` → Career & education timeline entries.
- `GET /api/v1/skills` → Toolkit entries.
- `POST /api/v1/contact` → Submit contact inquiries from external apps with rate limiting.

### E. Automated Test Suite (`php artisan test`)
- 9 feature and unit tests located in `tests/Feature/PortfolioTest.php` and `tests/Feature/AdminTest.php`.
- Automatically migrates, seeds, and tests every endpoint and auth flow.

---

## 4. What Does NOT Work / Limitations & How to Handle Them

| Feature / Area | Current Status | Why / How It Behaves | How to Enable / Upgrade |
|---|---|---|---|
| **Outbound Email Delivery (SMTP)** | **Active & Configured** | Whenever any visitor submits the contact form or API, an email is automatically sent to `divyanshchawla029@gmail.com` with the sender's name, email, subject, message, and direct reply-to address. | Configured using Gmail SMTP in `.env`. |
| **Direct File/Image Upload for Projects** | Projects use custom CSS/SVG geometric art badge classes (`tax`, `bhoomi`, `core`, `custom`). | Designed to match the exact visual style and geometric screens from your original design. | To upload custom PNG/JPG screenshots instead, you can add an image file upload input in `ProjectController` and run `php artisan storage:link`. |
| **Node / Vite Assets Compilation** | Raw Blade CSS and vanilla JS are used in `app.blade.php`. | Node/NPM was not installed in the local system environment, so standard native Blade + CSS was used (which is faster and has zero build dependencies). | If you want to use Vite or Tailwind CSS later, install Node.js/NPM and run `npm install && npm run dev`. |
| **Multi-User Role Management** | Single-admin model (`is_admin = true`). | The portfolio is designed for a single owner/admin. | If you ever want multiple contributors/editors with granular permissions, you can integrate packages like `spatie/laravel-permission`. |

---

## 5. File and Directory Architecture

```text
/home/divyansh/Documents/portfolio/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PortfolioController.php        # Public landing page controller
│   │   │   ├── ContactController.php          # Contact submission handler
│   │   │   ├── Auth/
│   │   │   │   └── AuthController.php         # Admin login / logout
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php    # Admin metrics & overview
│   │   │   │   ├── ProjectController.php      # Project CRUD
│   │   │   │   ├── ExperienceController.php   # Timeline CRUD
│   │   │   │   ├── SkillController.php        # Toolkit CRUD
│   │   │   │   ├── MessageController.php      # Messages inbox
│   │   │   │   └── SettingController.php      # Live CMS & bio settings
│   │   │   └── Api/
│   │   │       └── ApiController.php          # RESTful JSON APIs
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php            # Route protection for /admin/*
│   │   └── Requests/
│   │       ├── ContactRequest.php             # Contact validation rules
│   │       └── ProjectRequest.php             # Project validation rules
│   └── Models/
│       ├── User.php                           # User & Admin model
│       ├── Project.php                        # Project model
│       ├── Experience.php                     # Experience model
│       ├── Skill.php                          # Skill model
│       ├── Fact.php                           # Fact model
│       ├── ContactMessage.php                 # Inquiries model
│       └── SiteSetting.php                    # Key-value site settings model
├── bootstrap/
│   └── app.php                                # Route & middleware bindings
├── config/                                    # Laravel configuration files
├── database/
│   ├── database.sqlite                        # SQLite database file
│   ├── migrations/                            # 7 database table migrations
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── PortfolioSeeder.php                # Pre-seeded with original portfolio data
├── public/
│   ├── favicon.png
│   ├── preview.png
│   ├── robots.txt
│   ├── sitemap.xml
│   └── index.php                              # Web server entrypoint
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php                  # Public layout with styles & loader
│       │   └── admin.blade.php                # Admin dashboard layout
│       ├── portfolio/
│       │   └── index.blade.php                # Dynamic landing page
│       └── admin/
│           ├── auth/login.blade.php           # Admin login view
│           ├── dashboard.blade.php            # Admin metrics view
│           ├── projects/                      # Index, Create, Edit views
│           ├── experiences/                   # Index, Create, Edit views
│           ├── skills/                        # Index, Create, Edit views
│           ├── messages/                      # Inbox & Show views
│           └── settings/                      # Site settings & account view
├── routes/
│   ├── web.php                                # Web routes
│   ├── api.php                                # API v1 routes
│   └── console.php                            # Artisan commands
├── tests/
│   └── Feature/
│       ├── PortfolioTest.php                  # Public & API test suite
│       └── AdminTest.php                      # Admin auth & CRUD test suite
├── .env                                       # Environment configuration
├── composer.json                              # PHP dependencies
└── PORTFOLIO_SYSTEM_DOCUMENTATION.md          # This documentation file
```

---

## 6. How to Run, Test, and Maintain

### Starting the Server
```bash
php artisan serve
```
Site will be available at: `http://127.0.0.1:8000`

### Resetting & Re-seeding Data (If needed)
```bash
php artisan migrate:fresh --seed
```

### Running Tests
```bash
php artisan test
```

### Switching to MySQL (Optional)
If you wish to use MySQL instead of SQLite in production, edit `.env`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
Then run `php artisan migrate --seed`.

---

## 7. Verification Confirmation

- All 9 automated tests passing (70 assertions).
- Routes, controllers, and middleware verified.
- Database migrated and seeded with original data.
- Admin dashboard fully functional.

