# Monty CMS (Laravel 11 + Filament 3)

Laravel CMS for the Monty kitchens website. The original static HTML site remains in the parent `D:\monty` directory for reference.

## Stack

- Laravel 11
- PHP 8.2+ (upgrade to 8.3 recommended)
- Filament 3 admin panel
- Spatie Permission, Media Library, Translatable, Settings, Sitemap
- SQLite (default) or MySQL

## Quick Start

```bash
cd cms
composer install
cp .env.example .env   # if needed
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

## URLs

| URL | Description |
|-----|-------------|
| http://127.0.0.1:8000/en | English homepage |
| http://127.0.0.1:8000/ar | Arabic homepage (RTL) |
| http://127.0.0.1:8000/admin | Filament admin |

## Admin Login (seeded)

- **Email:** admin@monty.test
- **Password:** password

## Roles

Super Admin, Admin, Editor, Author, Support — seeded with permissions.

## Project Layout

```
cms/
├── app/
│   ├── Filament/Pages/ManageGeneralSettings.php
│   ├── Http/Controllers/
│   ├── Http/Middleware/SetLocale.php
│   └── Settings/GeneralSettings.php
├── public/assets/          # Copied from ../content/assets
├── public/css/             # main-ltr.css, main-rtl.css
├── resources/views/
│   ├── layouts/app.blade.php
│   ├── components/         # upperbar, header, footer, etc.
│   └── pages/              # home, about, services, contact
└── lang/en|ar/site.php     # UI translations
```

## Phase Status

- [x] **Phase 1:** Laravel scaffold, packages, locale routing, base layout, Filament admin, roles, general settings
- [x] **Phase 2:** Database models, migrations, seeders from HTML content
- [x] **Phase 3:** Filament CMS resources (core site content)
- [x] **Phase 4:** Complete Blade frontend conversion
- [ ] **Phase 5:** SEO, performance, sitemap
- [ ] **Phase 6:** QA & final report

## MySQL Configuration

The project is configured for **MySQL** by default. Update `cms/.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=monty_cms
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

> **Note:** On this machine MySQL listens on port **3308** (not 3306). Adjust `DB_PORT` if yours differs.

Create the database, then migrate and seed:

```sql
CREATE DATABASE monty_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

```bash
php artisan migrate:fresh --seed
```

## Seeders

Each content type has its own seeder file in `database/seeders/`:

| Seeder | Content |
|--------|---------|
| `RolePermissionSeeder` | Roles & permissions |
| `AdminUserSeeder` | Super admin user |
| `GeneralSettingsSeeder` | Site settings (Spatie Settings) |
| `PageSeeder` | Home, About, Services, Contact pages |
| `MenuItemSeeder` | Navigation menu items |
| `HeroSlideSeeder` | 3 homepage hero slides |
| `FeatureSeeder` | 3 homepage feature cards |
| `ServiceSeeder` | 3 services + galleries + wood types |
| `WorkProcessStepSeeder` | 5 work process steps |
| `StatisticSeeder` | 4 statistics counters |
| `AboutSettingSeeder` | About page + homepage about section |
| `WhyUsSettingSeeder` | Why-us video section |
| `BranchSeeder` | Contact branches |
| `SocialLinkSeeder` | Social media links |
| `BlogCategorySeeder` | Blog categories |
| `BlogTagSeeder` | Blog tags |
| `BlogPostSeeder` | Sample blog post |
| `PortfolioCategorySeeder` | Portfolio categories |
| `PortfolioSeeder` | Sample portfolio project |
| `TestimonialSeeder` | Placeholder (no static content) |
| `TeamMemberSeeder` | Placeholder (no static content) |
| `FaqSeeder` | Placeholder (no static content) |
| `ClientSeeder` | Placeholder (no static content) |
| `NewsletterSubscriberSeeder` | Placeholder (no static content) |
| `ContactMessageSeeder` | Placeholder (no static content) |

Run all seeders: `php artisan db:seed`  
Fresh install: `php artisan migrate:fresh --seed`
