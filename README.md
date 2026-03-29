# CVactive - Professional CV Builder Platform

> A modern, full-featured CV (Curriculum Vitae) builder web application built with Laravel 12. Create stunning resumes, export to PDF/PNG, post jobs, and manage applications — all in one platform.

[![Laravel](https://img.shields.io/badge/Laravel-12.0-red?style=flat-square&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-purple?style=flat-square&logo=php)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=flat-square&logo=tailwind-css)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-77D6F5?style=flat-square)](https://alpinejs.dev)
[![MIT](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

---

## 🎯 Overview

**CVactive** is a comprehensive online CV builder platform designed for the Vietnamese job market. It empowers job seekers to create professional resumes with live preview, multiple templates, and easy sharing — while also providing employers with a job posting and applicant tracking system.

The platform supports subscription-based premium plans with payment integration via VNPay and MoMo.

---

## ✨ Key Features

### For Job Seekers (Candidates)

| Feature | Description |
|---------|-------------|
| **Live CV Editor** | Real-time preview while editing — see changes instantly |
| **50+ CV Templates** | Professional templates categorized by industry and style |
| **PDF Export** | High-quality PDF generation using DOMPDF |
| **PNG Export** | Image export for quick sharing |
| **Online Sharing** | Generate secure shareable links for your CV |
| **Multi-CV Management** | Create and manage multiple CV versions |
| **Auto-Save** | Data is automatically saved as you type |
| **Drag & Drop Sections** | Rearrange CV sections with drag and drop |
| **Customizable Themes** | Change colors, fonts, and layouts |
| **Skill Matching** | Keyword highlighting in CV for job applications |
| **Job Applications** | Track application history and status |

### For Employers (HR)

| Feature | Description |
|---------|-------------|
| **Job Posting** | Post unlimited job listings with detailed descriptions |
| **Application Management** | View, review, and manage all applicants |
| **CV Search** | Search CVs by skills, experience, and keywords |
| **PDF CV Download** | Secure, authorization-protected CV downloads |
| **Application Status** | Track applications through pending → approved/rejected |
| **Company Branding** | Custom company logo and branding per job post |
| **Role-Based Access** | Strict ownership model — HR only sees their own posts |

### Platform Features

| Feature | Description |
|---------|-------------|
| **Subscription Plans** | Free and Pro tiers with VNPay/MoMo payment integration |
| **User Roles** | User, HR, and Admin roles with middleware protection |
| **Blog System** | Admin-managed blog for career tips and news |
| **FAQ Management** | Admin-managed FAQ for user support |
| **Contact Form** | Public contact form with email notifications |
| **Email Verification** | Laravel Breeze authentication with verified emails |
| **Google OAuth** | Socialite-based Google login integration |
| **Security** | Private file storage, policy-based authorization, CV access logging |

---

## 🛠️ Tech Stack

### Backend

| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 12.x | PHP Framework |
| **PHP** | 8.2+ | Server-side language |
| **MySQL/SQLite** | - | Primary database |
| **DOMPDF** | 3.x | Server-side PDF generation |
| **mPDF** | 8.x | Alternative PDF library |
| **PdfParser** | 2.x | PDF text extraction |
| **Intervention Image** | 3.x | Image manipulation |
| **Laravel Socialite** | 5.x | Google OAuth |
| **Laravel Breeze** | 2.x | Authentication scaffolding |

### Frontend

| Technology | Version | Purpose |
|------------|---------|---------|
| **Tailwind CSS** | 3.x | Utility-first CSS framework |
| **Alpine.js** | 3.x | Reactive JavaScript framework |
| **Vite** | 7.x | Build tool and dev server |
| **Axios** | 1.x | HTTP client |
| **Figtree** | - | Google Font (primary typeface) |

### Development Tools

| Tool | Purpose |
|------|---------|
| **Composer** | PHP dependency management |
| **npm** | Node.js package management |
| **Pint** | Laravel code style fixer |
| **PHPUnit** | Unit testing framework |
| **Artisan** | Laravel CLI |

---

## 📁 Project Structure

```
CVactive_ST5/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Application controllers
│   │   │   ├── Admin/           # Admin panel (Dashboard, Blog, Payments, Templates, Users)
│   │   │   ├── Auth/            # Authentication (Login, Register, Google OAuth, Password Reset)
│   │   │   ├── BlogController.php
│   │   │   ├── ContactController.php
│   │   │   ├── CvController.php  # CV CRUD, editor, export
│   │   │   ├── JobApplicationController.php
│   │   │   ├── JobPostController.php
│   │   │   ├── PaymentController.php
│   │   │   └── TemplateController.php
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php
│   │   │   └── HRMiddleware.php
│   │   └── Requests/             # Form request validators
│   ├── Models/                   # 15+ Eloquent models
│   │   ├── User.php
│   │   ├── Cv.php, CvSection.php, CvSectionItem.php
│   │   ├── Template.php, TemplateCategory.php
│   │   ├── JobPost.php, JobApplication.php
│   │   ├── Payment.php, Plan.php
│   │   ├── BlogPost.php, BlogCategory.php
│   │   ├── Faq.php, Contact.php
│   │   └── CvShare.php
│   ├── Policies/                 # Authorization policies
│   │   ├── ApplicationPolicy.php
│   │   ├── CvPolicy.php
│   │   ├── JobPostPolicy.php
│   │   └── PaymentPolicy.php
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   └── Services/                 # Business logic services
│       ├── MoMoService.php       # MoMo payment gateway
│       ├── PdfTextExtractor.php  # PDF text extraction
│       └── VNPayService.php      # VNPay payment gateway
├── config/                       # Laravel configuration files
│   ├── app.php, auth.php, database.php
│   ├── filesystems.php, logging.php, session.php
│   ├── vnpay.php                # VNPay configuration
│   └── momo.php                 # MoMo configuration
├── database/
│   ├── factories/               # Model factories for testing
│   ├── migrations/              # 18 migration files
│   └── seeders/                 # Database seeders
├── resources/
│   ├── css/app.css             # Tailwind CSS entry point
│   ├── js/
│   │   ├── app.js              # Alpine.js initialization
│   │   └── bootstrap.js         # Axios setup
│   └── views/
│       ├── admin/               # Admin panel views
│       ├── auth/                # Login, register, password reset
│       ├── blog/                # Public blog views
│       ├── components/          # Reusable Blade components
│       ├── cv/                  # CV editor views
│       ├── cv-templates/        # CV template designs (Blade)
│       ├── hr/                  # HR panel views
│       ├── layouts/             # Layout templates
│       ├── payment/             # Payment views
│       └── cv-templates/        # 3 built-in CV templates
├── routes/
│   ├── web.php                  # Web routes (all application routes)
│   └── auth.php                 # Auth routes (Breeze)
├── tests/                        # PHPUnit tests
│   ├── Feature/Auth/
│   └── Unit/
├── config/                      # Configuration files
├── storage/app/private/         # Private file storage (CV uploads)
└── public/                      # Public assets
```

---

## 🔐 Security Features

- **Private File Storage**: CV files stored in `storage/app/private/` — not publicly accessible
- **Authorization Policies**: Laravel Gates and Policies for role-based access control
- **Ownership Verification**: HR can only access CVs from their own job postings
- **Secure Downloads**: All CV downloads go through authorization-gated controllers
- **CV Access Logging**: Every CV download attempt is logged to `storage/logs/cv-access.log`
- **Mass Assignment Protection**: All models use `$fillable` for input validation
- **File Upload Validation**: MIME type and size validation for all uploads
- **Filename Sanitization**: Path traversal prevention with unique random filenames
- **CSRF Protection**: Laravel's built-in CSRF token protection on all forms
- **Email Verification**: Required email verification before accessing sensitive features
- **Middleware Protection**: Authenticated, verified, admin, and HR middleware on all sensitive routes

---

## 🚀 Getting Started

### Prerequisites

- **PHP** 8.2 or higher
- **Composer** 2.x
- **Node.js** 18+ and **npm**
- **MySQL** 8.0+ or **SQLite** (for local development)

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/yourusername/cvactive.git
cd cvactive

# 2. Install PHP dependencies
composer install

# 3. Create environment file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Run database migrations
php artisan migrate

# 6. Install frontend dependencies
npm install

# 7. Build frontend assets
npm run build

# 8. (Optional) Seed the database
php artisan db:seed

# 9. Start the development server
php artisan serve
```

### Quick Setup Script

```bash
# Run the automated setup script
composer setup
```

### Development

```bash
# Start all development servers concurrently
composer dev

# Run tests
composer test

# Format code with Pint
./vendor/bin/pint
```

---

## 📊 Database Schema

### Core Entities

```
users ─────────────┬── plans (subscription)
  │               │
  ├── cvs ────────┤── cv_sections ── cv_section_items
  │               │
  ├── job_posts ──┤── job_applications
  │               │
  └── blog_posts ─┴── blog_categories

payments ─────────┬── users (payment history)
                   │
                   └── plans

contacts (public submissions)
faqs (admin managed)
```

### Key Tables

| Table | Description |
|-------|-------------|
| `users` | User accounts with roles (user/hr/admin), subscription info |
| `cvs` | CV documents with template, theme, and visibility settings |
| `cv_sections` | Modular CV sections (experience, education, skills, etc.) |
| `cv_section_items` | Individual items within sections |
| `templates` | CV template designs with categories |
| `job_posts` | Job listings owned by HR users |
| `job_applications` | Applications with secure CV file storage |
| `payments` | Payment transactions (VNPay/MoMo) |
| `plans` | Subscription plans with features and limits |
| `blog_posts` | Blog articles with categories |
| `cv_shares` | Secure shareable CV links |

---

## 🎨 CV Templates

The platform includes 3 professionally designed CV templates:

| Template | Style | Best For |
|----------|-------|----------|
| **Classic Blue** | Traditional, professional | Corporate, banking, finance |
| **Modern Dark** | Contemporary, bold | Tech, design, creative |
| **Minimal White** | Clean, minimal | All industries, fresh graduates |

Templates are built with Blade views in `resources/views/cv-templates/` for full customization.

---

## 💳 Payment Integration

| Gateway | Status | Features |
|---------|--------|----------|
| **VNPay** | ✅ Integrated | QR code, ATM card, Internet Banking |
| **MoMo** | ✅ Integrated | QR code payment |
| **Bank Transfer** | ✅ Supported | Manual bank transfer with confirmation |

---

## 👥 User Roles

| Role | Permissions |
|------|------------|
| **User** | Create CVs, apply to jobs, manage own applications |
| **HR** | All User permissions + post jobs, view applications, download CVs |
| **Admin** | Full access: manage users, templates, blog, payments, settings |

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test suite
php artisan test --testsuite=Feature
```

---

## 📝 Environment Variables

Copy `.env.example` to `.env` and configure:

```env
APP_NAME=CVactive
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cvactive
DB_USERNAME=root
DB_PASSWORD=

# Payment Gateways
VNPAY_URL=https://sandbox.vnpayment.vn
VNPAY_TMNCODE=YOUR_TMNCODE
VNPAY_HASH_SECRET=YOUR_HASH_SECRET

MOMO_ENDPOINT=https://test-payment.momo.vn
MOMO_PARTNER_CODE=YOUR_PARTNER_CODE
MOMO_ACCESS_KEY=YOUR_ACCESS_KEY
MOMO_SECRET_KEY=YOUR_SECRET_KEY

# Google OAuth
GOOGLE_CLIENT_ID=your-client-id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-client-secret

# File Storage
FILESYSTEM_DISK=local
```

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) — The PHP framework
- [Tailwind CSS](https://tailwindcss.com) — Utility-first CSS
- [Alpine.js](https://alpinejs.dev) — Lightweight JavaScript framework
- [Heroicons](https://heroicons.com) — Beautiful SVG icons
- [Unsplash](https://unsplash.com) — Stock photography

---

<p align="center">
  <strong>Built with ❤️ using Laravel</strong>
</p>
