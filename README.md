<div align="center">

# 🕌 HARAMAIN TOUR
### Umrah & Hajj Travel Management Platform — Built with Laravel

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Midtrans](https://img.shields.io/badge/Midtrans-Payment-003B57?style=for-the-badge)
![REST API](https://img.shields.io/badge/REST-API-009688?style=for-the-badge)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

A full-featured web platform for managing Umrah & Hajj travel packages, online registration, payments, and a companion mobile app backend.

</div>

---

## 📌 About

**Haramain Tour** is a comprehensive travel management system built for Umrah and Hajj travel agencies. It provides an end-to-end solution — from browsing packages and online registration, to payment processing and trip guidance — all in one platform.

The system also includes a **REST API** that serves as the backend for a companion mobile application, providing prayer guides, Arabic dictionary, and Ibadah step-by-step tutorials.

---

## ✨ Features

### 👤 User Features
| Feature | Description |
|---|---|
| 🔐 **Authentication** | Login, Register, and Google OAuth login |
| 📦 **Package Browsing** | View and search Umrah & Hajj travel packages |
| 📝 **Multi-step Registration** | 5-step online registration form with document upload |
| 💳 **Online Payment** | Full & installment payment via Midtrans |
| 🔔 **Notifications** | Real-time email & in-app notifications |
| ❤️ **Wishlist** | Save favorite travel packages |
| 👤 **Profile Management** | Manage personal profile and settings |
| 🤖 **Chatbot** | Rule-based virtual assistant for package inquiries |
| 📰 **News** | Read latest news and updates |

### 🛡️ Admin Features
| Feature | Description |
|---|---|
| 📊 **Admin Dashboard** | Overview of registrations, packages, and payments |
| 📦 **Package Management** | Create and manage travel packages |
| 📋 **Registration Management** | Review and manage customer registrations |
| 💰 **Payment Management** | Track and verify payments |
| 📰 **News Management** | Publish and manage news articles |
| 📱 **Mobile Content Management** | Manage content served to the mobile app |

### 📱 Mobile App Backend (REST API)
| Endpoint | Description |
|---|---|
| 🕌 **Ibadah Guide** | Step-by-step Umrah & Hajj rituals |
| 🤲 **Doa (Prayers)** | Collection of prayers with Arabic text & translation |
| 📖 **Arabic Dictionary** | Islamic terms and vocabulary |
| 📰 **News Feed** | Latest news for mobile users |
| 🔑 **Auth API** | Mobile user authentication via Sanctum |

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11, PHP 8.2+
- **Database:** MySQL
- **Frontend:** Blade Template Engine, Bootstrap
- **Payment Gateway:** Midtrans (full & installment)
- **Authentication:** Laravel Auth + Google OAuth (Socialite) + Laravel Sanctum (API)
- **PDF Generation:** DomPDF
- **Mobile API:** RESTful API with Laravel Sanctum
- **Other:** Chatbot (Rule-based), Email Notifications

---

## 🚀 Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL
- Midtrans account (for payment)
- Google OAuth credentials (for Google login)

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/username/haramain-tour.git
cd haramain-tour

# 2. Install PHP dependencies
composer install

# 3. Copy the environment file
cp .env.example .env

# 4. Configure your .env file
# - Database credentials
# - Midtrans keys (MIDTRANS_SERVER_KEY, MIDTRANS_CLIENT_KEY)
# - Google OAuth (GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET)
# - Mail configuration

# 5. Generate application key
php artisan key:generate

# 6. Run migrations
php artisan migrate

# 7. Create storage symlink
php artisan storage:link

# 8. Start the development server
php artisan serve
```

Open your browser and go to: **http://localhost:8000**

---

## 📂 Project Structure

```
haramain_tour/
├── app/
│   ├── Http/Controllers/
│   │   ├── Api/
│   │   │   ├── AuthApiController.php       # Mobile auth (Sanctum)
│   │   │   └── MobileContentController.php # Doa, Panduan, Kamus API
│   │   ├── Auth/
│   │   │   └── GoogleAuthController.php    # Google OAuth
│   │   ├── AdminController.php             # Admin dashboard
│   │   ├── AdminPaketController.php        # Package management
│   │   ├── AdminPendaftaranController.php  # Registration management
│   │   ├── ChatBotController.php           # Virtual assistant
│   │   ├── MidtransController.php          # Payment gateway
│   │   ├── NotificationController.php      # Notifications
│   │   ├── PendaftaranController.php       # Registration (5-step)
│   │   └── SearchController.php           # Package search
│   ├── Models/
│   │   ├── Paket.php           # Travel package
│   │   ├── Pendaftaran.php     # Registration
│   │   ├── Pembayaran.php      # Payment
│   │   ├── Notifikasi.php      # Notification
│   │   ├── Doa.php             # Prayer collection
│   │   ├── PanduanStep.php     # Ibadah guide steps
│   │   └── KamusEntry.php      # Arabic dictionary
├── database/migrations/        # Database schema
├── resources/views/            # Blade templates
└── routes/
    ├── web.php                 # Web routes
    └── api.php                 # API routes
```

---

## 🔄 Registration Workflow

```
User Login / Register
       ↓
Browse Travel Packages
       ↓
5-Step Online Registration Form
  Step 1: Terms & Conditions
  Step 2: Digital Signature
  Step 3: Personal Identity
  Step 4: Document Upload
  Step 5: Payment Scheme
       ↓
Midtrans Payment (Full / Installment)
       ↓
Admin Reviews Registration
       ↓
Email Notification Sent to User
       ↓
Registration Confirmed ✅
```

---

## 📱 API Endpoints

```
POST   /api/auth/login          # Mobile login
POST   /api/auth/register       # Mobile register
GET    /api/content/panduan     # Ibadah guide
GET    /api/content/doa         # Prayer collection
GET    /api/content/kamus       # Arabic dictionary
GET    /api/content/berita      # News feed
```

---

## 📸 Screenshots

> *Coming soon — add your app screenshots here*

---

## 🤝 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you'd like to change.

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).

---

<div align="center">
  Built with ❤️ using Laravel — للَّهُمَّ بَارِكْ لَنَا
</div>

---

## 📱 HaramainQu — Mobile Companion App

**HaramainQu** is a mobile microservice application that connects directly to the Haramain Tour backend via REST API. It serves as a digital companion for pilgrims throughout their Umrah & Hajj journey.

### What HaramainQu Provides
| Feature | Description |
|---|---|
| 🕌 **Ibadah Guide** | Step-by-step Umrah & Hajj ritual instructions |
| 🤲 **Doa Collection** | Prayers with Arabic text, transliteration & translation |
| 📖 **Arabic Dictionary** | Islamic terms and vocabulary for pilgrims |
| 📰 **News Feed** | Latest updates and announcements from Haramain Tour |
| 🔑 **Authentication** | Secure mobile login via Laravel Sanctum token-based auth |

### Architecture
```
HaramainQu (Mobile App)
        ↓  REST API calls
Haramain Tour (Laravel Backend)
        ↓  Query
    MySQL Database
```

> HaramainQu communicates with this Laravel backend through a dedicated set of API endpoints under `/api/*`, authenticated using **Laravel Sanctum**.
