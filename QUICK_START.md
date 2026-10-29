# 🚀 Quick Start Guide - SITANI

## Prerequisites

- PHP 8.2+
- MySQL 5.7+ atau MariaDB
- Composer
- Node.js 16+ (opsional, hanya jika rebuild assets)

---

## Installation

### 1. Clone & Install Dependencies
```bash
cd D:\xampp\htdocs\PAD\sitani
composer install
```

### 2. Environment Setup
```bash
# Copy .env jika belum ada
cp .env.example .env

# Generate APP_KEY (jika belum)
php artisan key:generate
```

**File `.env` sudah dikonfigurasi dengan:**
```env
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sitani
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Database Setup
```bash
# Run migrations
php artisan migrate

# Seed initial data (Super Admin user)
php artisan db:seed

# Setup storage symlink untuk file upload
php artisan storage:link
```

### 4. Start Development Server
```bash
php artisan serve
```

**Server akan berjalan di:** `http://localhost:8000`

---

## 📍 Akses Aplikasi

### Admin Panel
- **URL**: `http://localhost:8000/admin`
- **Default Credential**: Lihat output `php artisan db:seed`
- **Features**: CRUD 6 modul, export laporan, user management

### Public Area (Tanpa Login)
| Halaman | URL |
|---------|-----|
| Home | `/` |
| Tentang | `/about` |
| Program | `/program` |
| Galeri | `/gallery` |
| Kontak | `/contact` |
| Transparansi Dana | `/transparansi` |

---

## 🧪 Menjalankan Tests

```bash
# Semua tests
php artisan test

# Hanya feature tests
php artisan test tests/Feature/PublicPagesTest.php

# Tests dengan verbose output
php artisan test --verbose
```

**Current Status**: ✅ 7/7 public page tests passing

---

## 📂 Struktur Folder Penting

```
sitani/
├── app/
│   ├── Exports/                  ← Excel export classes
│   ├── Filament/Resources/       ← Admin modules (CRUD)
│   ├── Http/Controllers/         ← TransparansiController
│   └── Models/                   ← Database models
├── resources/views/
│   ├── layouts/public.blade.php  ← Layout publik
│   └── pages/                    ← 5 halaman publik
├── routes/
│   └── web.php                   ← Public + admin routes
├── storage/
│   └── app/public/evidence/      ← Uploaded photo evidence
├── tests/Feature/                ← Feature tests
└── .env                          ← Environment config
```

---

## 🔑 Key Commands

```bash
# Clear cache
php artisan cache:clear
php artisan view:clear

# Generate new APP_KEY
php artisan key:generate

# Optimize for production
php artisan optimize

# Database commands
php artisan migrate:refresh --seed    # Reset DB + seed
php artisan migrate:rollback          # Undo migrations
php artisan tinker                    # Interactive shell

# Create new model + migration
php artisan make:model ModelName -m

# Clear & rebuild storage symlink
php artisan storage:link --force
```

---

## 📊 Default Super Admin

Setelah menjalankan `php artisan db:seed`, check database untuk:

```sql
SELECT * FROM users WHERE is_super_admin = 1;
```

**Credentials akan di-display di console saat seeding**, atau lihat `database/seeders/DatabaseSeeder.php`

---

## 📁 File Upload

Semua bukti foto disimpan di:
```
storage/app/public/evidence/
├── penjualan-panen/
├── perawatan-lahan/
├── kepentingan-umum/
├── pupuk-masuk/
└── pupuk-terpakai/
```

Akses publik via: `http://localhost:8000/storage/evidence/...`

---

## ⚙️ Configuration Files

### Database
- `config/database.php` - Database connections
- `.env` - Credentials

### Filament
- `config/filament.php` - Admin panel config
- `app/Providers/Filament/AdminPanelProvider.php` - Panel setup

### Excel Export
- `config/excel.php` - Excel export settings
- `app/Exports/` - Export classes

### Routes
- `routes/web.php` - Public + admin routes
- `routes/api.php` - API routes (jika ada)

---

## 🐛 Troubleshooting

### "Vite manifest not found"
✅ **Fixed** - `@vite` directive sudah dihapus dari public layout

### "SQLSTATE[42S02]: Table not found"
```bash
php artisan migrate
```

### "Class not found" errors
```bash
composer dump-autoload
```

### "Permission denied" untuk storage
```bash
# Windows - tidak perlu
# Linux/Mac:
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Port 8000 already in use
```bash
php artisan serve --port=8001
```

---

## 📝 File Structure untuk Development

```bash
# Tambah model baru
php artisan make:model ModelName -m

# Tambah resource Filament
php artisan make:filament-resource ResourceName

# Tambah controller
php artisan make:controller ControllerName

# Tambah test
php artisan make:test TestNameTest
```

---

## 🔐 Security Tips (Development)

- ✅ `.env` sudah ter-setup dengan APP_DEBUG=true (development only)
- ✅ APP_KEY sudah di-generate
- ⚠️ **Production**: Set `APP_DEBUG=false`, gunakan strong passwords
- ⚠️ **Production**: Update DB credentials di `.env`
- ⚠️ **Production**: Setup HTTPS/SSL

---

## 📞 Support & Documentation

- **Laravel Docs**: https://laravel.com/docs
- **Filament Docs**: https://filamentphp.com/docs
- **MySQL Docs**: https://dev.mysql.com/doc/

---

## ✅ Checklist Awal

- [ ] Run `composer install`
- [ ] Setup `.env` (sudah done)
- [ ] Run `php artisan migrate`
- [ ] Run `php artisan db:seed`
- [ ] Run `php artisan storage:link`
- [ ] Run `php artisan serve`
- [ ] Akses `http://localhost:8000` - halaman publik
- [ ] Akses `http://localhost:8000/admin` - login dengan kredensial dari seeding
- [ ] Run `php artisan test` - verifikasi tests

---

**Siap untuk development!** 🎉
