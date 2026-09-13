# MoodCrumb

## Deskripsi Project

MoodCrumb adalah aplikasi web Laravel untuk katalog cookies yang dikelompokkan berdasarkan mood pengguna. Source code saat ini mencakup landing page publik, authentication, role admin/customer, admin dashboard, dan CRUD Mood. Fondasi Product tersedia pada model, service, repository, dan database, tetapi belum memiliki controller, route, atau UI.

Dokumentasi ini menggambarkan kondisi source code saat ini. Fitur yang baru berupa fondasi atau placeholder tidak dianggap selesai.

## Tujuan Project

- Menyediakan landing page cookies berbasis mood.
- Menyediakan authentication user dan Google OAuth.
- Memisahkan akses admin dan customer berdasarkan role.
- Menyediakan pengelolaan Mood untuk admin.
- Menjadi fondasi katalog Product dan alur order yang masih dalam pengembangan.

## Konsep Utama Sistem

Project menggunakan Laravel MVC dengan Service Layer dan Repository Pattern parsial.

Flow lengkap yang benar-benar digunakan pada Mood:

```text
Route -> Middleware -> Controller -> Form Request -> Service
      -> Repository Interface -> Eloquent Repository -> Model
      -> Database -> Blade View
```

Tidak semua domain menggunakan seluruh layer tersebut. DTO, domain entity terpisah, use-case layer, dan domain exception layer tidak tersedia.

## Fitur

### Fitur tersedia secara struktural

- Landing page publik pada `/`.
- Login, registration, dan logout custom.
- Session authentication Laravel.
- Role `admin` dan `customer`.
- Admin dashboard dengan statistik placeholder.
- CRUD Mood: list, create, update, delete.
- Customer dashboard sederhana.
- Password reset, password update, dan email verification scaffold.
- Google OAuth controller dan UI link.
- Migration users, moods, products, cache, queue, dan sessions.

### Fitur sedang dikembangkan atau belum lengkap

- Authentication custom dan Breeze masih berjalan berdampingan.
- Role redirect belum konsisten.
- Profile controller dan view tersedia, tetapi route profile belum lengkap.
- Product model, service, dan repository tersedia tanpa HTTP/UI layer.
- Admin dashboard masih menggunakan statistik order dummy.
- Mood detail route tersedia tetapi view detail belum ada.
- Customer profile controller memanggil view yang belum tersedia.

### Fitur belum diimplementasikan

- Product CRUD melalui browser.
- Product catalog/database display.
- Image upload dan image processing.
- Stock transaction dan stock history.
- Order management.
- Payment flow.
- Customer management oleh admin.
- Reporting, PDF/Excel export, dan promo.

## Tech Stack

### Backend

- PHP `^8.2`.
- Laravel `^12.0`.
- Eloquent ORM.
- Laravel Blade.
- Laravel session authentication.

### Frontend

- Blade templates.
- Vite `^7.0.7`.
- Tailwind CSS `^3.1.0`.
- Alpine.js `^3.4.2`.
- Axios `^1.11.0`.
- PostCSS dan Autoprefixer.

### Database

`config/database.php` menyediakan koneksi SQLite, MySQL, MariaDB, PostgreSQL, SQL Server, dan Redis. Default connection adalah SQLite, dengan fallback ke `database/database.sqlite`. Testing dikonfigurasi menggunakan SQLite in-memory melalui `phpunit.xml`.

## Dependencies / Packages Penting

### Digunakan oleh source atau workflow project

| Package               | Fungsi                                                 | Penggunaan                                  |
| --------------------- | ------------------------------------------------------ | ------------------------------------------- |
| `laravel/framework`   | Framework utama, routing, ORM, auth, validation, Blade | Seluruh aplikasi                            |
| `laravel/socialite`   | Google OAuth                                           | `GoogleController`, `AuthService`           |
| `laravel/breeze`      | Authentication dan profile scaffold                    | Controller, view, request, component Breeze |
| `fakerphp/faker`      | Data factory                                           | `UserFactory`, tests                        |
| `phpunit/phpunit`     | Automated testing                                      | `tests/`, `phpunit.xml`                     |
| `laravel-vite-plugin` | Integrasi Laravel dengan Vite                          | `vite.config.js`                            |
| `vite`                | Build dan dev server frontend                          | npm scripts                                 |
| `tailwindcss`         | Utility CSS                                            | `tailwind.config.js`, Blade, `app.css`      |
| `@tailwindcss/forms`  | Styling form                                           | `tailwind.config.js`                        |
| `alpinejs`            | Interaksi UI                                           | `resources/js/app.js`, Blade                |
| `axios`               | HTTP client                                            | `resources/js/bootstrap.js`                 |
| `postcss`             | CSS processing                                         | `postcss.config.js`                         |
| `autoprefixer`        | Vendor prefix CSS                                      | `postcss.config.js`                         |

### Terpasang tetapi belum terlihat digunakan

- `barryvdh/laravel-dompdf`: tidak ada flow PDF.
- `intervention/image-laravel`: tidak ada flow image processing.
- `maatwebsite/excel`: tidak ada flow import/export.
- `spatie/laravel-sluggable`: slug dibuat manual dengan `Str::slug()`.
- `@tailwindcss/vite`: tidak di-import oleh `vite.config.js`.
- `barryvdh/laravel-ide-helper`: metadata IDE, bukan business flow.

## Arsitektur Project

Project bukan Clean Architecture penuh. Implementasi aktualnya adalah Laravel MVC dengan Service Layer dan Repository Pattern parsial.

Flow Mood:

```text
Browser
  -> routes/web.php -> routes/admin.php
  -> auth middleware -> admin middleware
  -> MoodController
  -> StoreMoodRequest / UpdateMoodRequest
  -> MoodService
  -> MoodRepositoryInterface -> MoodRepository
  -> Mood model -> moods table
  -> admin Blade view
```

Kondisi tiap layer:

- Route tersedia untuk public, auth, admin, dan customer.
- Middleware tersedia untuk auth, guest, admin, customer, signed, dan throttle.
- Controller tersedia untuk fitur utama, tetapi authentication memiliki dua set controller.
- Form Request tersedia untuk auth, profile, dan Mood; belum tersedia untuk Product.
- DTO tidak ada.
- Service tersedia untuk auth, dashboard, Mood, dan Product.
- Repository Interface tersedia untuk Mood, Product, dan Order.
- Repository Implementation tersedia, tetapi Order masih dummy.
- Model tersedia untuk User, Mood, dan Product; tidak ada Order model.

Constructor injection digunakan pada controller dan service. Binding dilakukan oleh [RepositoryServiceProvider](app/Providers/RepositoryServiceProvider.php):

```text
MoodRepositoryInterface -> MoodRepository
ProductRepositoryInterface -> ProductRepository
OrderRepositoryInterface -> OrderRepository
```

## Project Structure

Detail internal `vendor/`, `node_modules/`, dan generated runtime tidak ditampilkan.

```text
moodcrumb/
├── app/
│   ├── Enums/
│   │   ├── OrderStatus.php
│   │   ├── StockAction.php
│   │   └── UserRole.php
│   ├── Helpers/
│   │   └── helpers.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Controller.php
│   │   │   └── ProfileController.php
│   │   ├── Controllers/Admin/
│   │   │   ├── DashboardController.php
│   │   │   └── MoodController.php
│   │   ├── Controllers/Auth/
│   │   │   ├── AuthenticatedSessionController.php
│   │   │   ├── ConfirmablePasswordController.php
│   │   │   ├── EmailVerificationNotificationController.php
│   │   │   ├── EmailVerificationPromptController.php
│   │   │   ├── GoogleController.php
│   │   │   ├── LoginController.php
│   │   │   ├── NewPasswordController.php
│   │   │   ├── PasswordController.php
│   │   │   ├── PasswordResetLinkController.php
│   │   │   ├── RegisterController.php
│   │   │   ├── RegisteredUserController.php
│   │   │   └── VerifyEmailController.php
│   │   ├── Controllers/Customer/
│   │   │   ├── HomeController.php
│   │   │   └── ProfileController.php
│   │   ├── Middleware/
│   │   │   ├── EnsureIsAdmin.php
│   │   │   └── EnsureIsCustomer.php
│   │   └── Requests/
│   │       ├── Admin/
│   │       │   ├── StoreMoodRequest.php
│   │       │   └── UpdateMoodRequest.php
│   │       ├── Auth/
│   │       │   ├── LoginRequest.php
│   │       │   └── RegisterRequest.php
│   │       └── ProfileUpdateRequest.php
│   ├── Models/
│   │   ├── Mood.php
│   │   ├── Product.php
│   │   └── User.php
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   └── RepositoryServiceProvider.php
│   ├── Repositories/
│   │   ├── Eloquent/
│   │   │   ├── MoodRepository.php
│   │   │   ├── OrderRepository.php
│   │   │   └── ProductRepository.php
│   │   └── Interfaces/
│   │       ├── MoodRepositoryInterface.php
│   │       ├── OrderRepositoryInterface.php
│   │       └── ProductRepositoryInterface.php
│   ├── Services/
│   │   ├── Admin/
│   │   │   ├── DashboardService.php
│   │   │   ├── MoodService.php
│   │   │   └── ProductService.php
│   │   ├── Auth/
│   │   │   └── AuthService.php
│   │   └── Customer/ [empty]
│   └── View/
│       └── Components/
│           ├── AppLayout.php
│           └── GuestLayout.php
├── bootstrap/
│   ├── cache/
│   │   ├── packages.php
│   │   └── services.php
│   ├── app.php
│   └── providers.php
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   └── session.php
├── database/
│   ├── factories/
│   │   └── UserFactory.php
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2026_08_31_064239_add_role_to_users_table.php
│   │   ├── 2026_08_31_065742_create_moods_table.php
│   │   ├── 2026_08_31_065929_create_products_table.php
│   │   └── 2026_09_05_121222_add_auth_fields_to_users_table.php
│   ├── seeders/
│   │   ├── AdminUserSeeder.php
│   │   └── DatabaseSeeder.php
│   └── database.sqlite
├── public/
│   ├── build/ [generated assets]
│   ├── .htaccess
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/ [auth, admin, customer, components, layouts, profile]
├── routes/
│   ├── admin.php
│   ├── auth.php
│   ├── console.php
│   ├── customer.php
│   └── web.php
├── storage/
├── tests/{TestCase.php,Feature/,Unit/}
├── vendor/ [dependency directory]
├── node_modules/ [dependency directory]
└── artisan, composer.json, composer.lock, package.json, package-lock.json, phpunit.xml, postcss.config.js, tailwind.config.js, vite.config.js
```

## Penjelasan Folder

- `app/`: kode aplikasi utama.
- `app/Http/Controllers/`: entry point HTTP.
- `app/Http/Requests/`: validasi request.
- `app/Http/Middleware/`: authorization role admin/customer.
- `app/Models/`: Eloquent model User, Mood, dan Product.
- `app/Services/`: business logic authentication, dashboard, Mood, dan Product.
- `app/Repositories/Interfaces/`: kontrak repository.
- `app/Repositories/Eloquent/`: implementasi repository berbasis Eloquent.
- `app/Enums/`: UserRole, OrderStatus, dan StockAction.
- `app/Providers/`: service provider dan repository binding.
- `app/View/Components/`: wrapper layout Blade.
- `bootstrap/`: bootstrap aplikasi, provider, dan cache framework.
- `config/`: konfigurasi authentication, database, filesystem, mail, session, dan service eksternal.
- `database/migrations/`: schema users, authentication support, cache, jobs, moods, dan products.
- `database/seeders/`: admin seeder dan database seeder.
- `resources/views/`: UI Blade.
- `resources/js/` dan `resources/css/`: source asset frontend.
- `routes/`: route web, auth, admin, customer, dan console.
- `storage/`: session, cache, compiled view, log, dan file storage.
- `tests/`: feature dan unit test.

Folder `app/DTOs/` dan `app/Exceptions/` tidak tersedia. `app/Services/Customer/` tersedia tetapi kosong.

## Penjelasan Komponen Penting

### Models

- `User`: authentication, role, password, email, phone, dan Google ID.
- `Mood`: kategori mood dan relasi `hasMany` ke Product.
- `Product`: product, harga, stock, active flag, image URL, dan relasi `belongsTo` Mood.

Tidak ada `Order` model.

### Controllers

- `Admin\DashboardController`: mengambil statistik admin.
- `Admin\MoodController`: CRUD Mood.
- `Customer\HomeController`: landing page dan customer dashboard.
- `Customer\ProfileController`: customer profile, tetapi target view belum tersedia.
- `ProfileController`: profile Breeze, tetapi route standard belum tersedia.
- `Auth\LoginController` dan `Auth\RegisterController`: authentication custom.
- Controller auth lainnya menangani password reset, password update, email verification, confirm password, dan Google OAuth.

### Middleware

- `EnsureIsAdmin`: membatasi route ke role admin.
- `EnsureIsCustomer`: membatasi route ke role customer.
- Alias didaftarkan di `bootstrap/app.php` sebagai `admin` dan `customer`.

### Requests

- `LoginRequest`: validasi login dan rate limiting.
- `RegisterRequest`: validasi dan normalisasi registration.
- `StoreMoodRequest`: validasi create Mood.
- `UpdateMoodRequest`: validasi update Mood.
- `ProfileUpdateRequest`: validasi nama dan email profile.

Tidak ada Product Request.

### Services dan Repositories

- `AuthService`: registration, login session, Google OAuth, logout, role redirect.
- `DashboardService`: mengambil statistik order.
- `MoodService`: CRUD Mood dan unique slug.
- `ProductService`: CRUD, pagination, active filter, dan unique slug Product; belum memiliki controller caller.
- `MoodRepository`: query CRUD Mood dan slug.
- `ProductRepository`: query CRUD, pagination, eager loading Mood, dan active filter.
- `OrderRepository`: kontrak tersedia, tetapi statistik selalu `0`.

### Interfaces, Enums, DTOs, Exceptions, Providers

Repository interfaces tersedia untuk Mood, Product, dan Order. `UserRole` berisi `admin` dan `customer`; `OrderStatus` dan `StockAction` belum terhubung ke tabel domain. DTO dan custom Exceptions tidak tersedia. `RepositoryServiceProvider` menghubungkan interface repository dengan implementasi Eloquent.

## Database Structure

### `users`

Kolom utama: `id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone`, `google_id`, `role`, timestamps.

Primary key: `id`. Unique: `email`, `google_id`. Default role: `customer`. Model: `App\Models\User`.

### `moods`

Kolom: `id`, `name`, `slug`, `description`, `icon`, timestamps. Primary key: `id`. Unique: `slug`. Model: `App\Models\Mood`.

### `products`

Kolom: `id`, `mood_id`, `name`, `slug`, `description`, `price`, `stock`, `image`, `is_active`, timestamps. Primary key: `id`. Foreign key: `mood_id -> moods.id`. Cascade delete: menghapus Mood menghapus Product terkait. Default: `stock = 0`, `is_active = true`. Model: `App\Models\Product`.

### Tabel framework

Migration juga membuat `password_reset_tokens`, `sessions`, `cache`, `cache_locks`, `jobs`, `job_batches`, dan `failed_jobs` untuk kebutuhan Laravel.

Relasi domain:

```text
Mood 1 ------ N Product
  moods.id <---- products.mood_id
  ON DELETE CASCADE
```

`sessions.user_id` dan `password_reset_tokens.email` berhubungan secara logis dengan user, tetapi migration tidak mendefinisikan foreign key constraint untuk keduanya. Belum ada tabel, model, atau migration untuk Order, Payment, Stock Movement, Promo, atau Report.

## Routing

### Public

```text
GET /  -> home -> Customer\HomeController@index
```

### Admin

Group:

```text
prefix: admin
name prefix: admin.
middleware: auth, admin
```

Route:

```text
GET       /admin/dashboard              admin.dashboard
GET       /admin/moods                  admin.moods.index
GET       /admin/moods/create           admin.moods.create
POST      /admin/moods                  admin.moods.store
GET       /admin/moods/{mood}           admin.moods.show
GET       /admin/moods/{mood}/edit      admin.moods.edit
PUT/PATCH /admin/moods/{mood}           admin.moods.update
DELETE    /admin/moods/{mood}           admin.moods.destroy
```

### Customer

Group:

```text
name prefix: customer.
middleware: auth, customer
```

Route:

```text
GET /dashboard  -> customer.dashboard
GET /profile    -> customer.profile
```

### Authentication

Route tersedia untuk login, register, logout, password reset, password update, password confirmation, email verification, dan Google OAuth. Authentication custom dan Breeze sama-sama mendefinisikan login, register, dan logout; route runtime menunjukkan controller custom aktif untuk tiga endpoint tersebut.

## Authentication dan Authorization

Guard default adalah `web` dengan driver `session`. Provider menggunakan Eloquent model `App\Models\User`.

Authentication custom menggunakan `LoginRequest`, `RegisterRequest`, dan `AuthService`. Google OAuth menggunakan Socialite. Authorization dilakukan melalui `auth + admin` dan `auth + customer`.

`EnsureIsAdmin` memeriksa `UserRole::Admin`. `EnsureIsCustomer` memeriksa `UserRole::Customer`. Known limitation: `EnsureIsAdmin` mengarahkan user tidak berwenang ke route `customer.home`, tetapi route tersebut tidak tersedia.

## User Role

Role yang tersedia:

```text
admin
customer
```

Role disimpan pada `users.role` dan di-cast oleh `User` ke `UserRole`. `AdminUserSeeder` membuat akun admin. Registration custom selalu membuat user baru sebagai customer.

## System Flow

### Public User Flow

```text
GET / -> HomeController@index -> customer.home.index
```

### Authentication Flow

```text
POST /register
  -> RegisterController@store -> RegisterRequest
  -> AuthService::register() -> User::create() -> users
  -> redirect login
```

```text
POST /login
  -> LoginController@store -> LoginRequest::authenticate()
  -> Auth::attempt() -> session regeneration -> role redirect
```

### Admin Flow

```text
Login -> session -> auth -> EnsureIsAdmin -> admin route
      -> Admin Controller -> Service -> Repository
      -> Model/Database -> Admin Blade View
```

### Customer Flow

```text
Login -> session -> auth -> EnsureIsCustomer
      -> customer route -> Customer Controller -> Customer Blade View
```

Customer dashboard saat ini tidak mengambil data database.

### Mood CRUD Flow

```text
Create: Form -> StoreMoodRequest -> MoodService -> MoodRepository -> Mood -> moods
Read: Route -> MoodController@index -> MoodService -> MoodRepository -> Mood -> Blade
Update: Form -> UpdateMoodRequest -> MoodService -> MoodRepository -> Mood -> moods
Delete: Form -> MoodController@destroy -> MoodService -> MoodRepository -> Mood -> moods
```

Mood detail route tersedia, tetapi view `admin.moods.show` belum ada.

## Installation

```bash
composer install
npm install
```

Siapkan `.env` lokal dan isi konfigurasi environment yang diperlukan. Secret tidak didokumentasikan di sini.

Workspace yang diaudit memiliki `.env`, tetapi tidak memiliki `.env.example`; pada checkout baru, buat `.env` secara manual berdasarkan contoh konfigurasi di bawah.

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
npm run build
```

## Environment Configuration

Contoh tanpa secret:

```env
APP_NAME=MoodCrumb
APP_ENV=local
APP_KEY=base64:GENERATED_KEY
APP_URL=http://localhost

DB_CONNECTION=sqlite
DB_DATABASE=C:/path/to/database.sqlite

GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI=http://localhost/auth/google/callback

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="MoodCrumb"
```

MySQL juga dikonfigurasi di `config/database.php` melalui `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.

## Database Migration

```bash
php artisan migrate
php artisan migrate:rollback
```

Migration membuat users, cache, jobs, sessions, moods, dan products. Tidak ada migration order, payment, stock movement, promo, atau report. `add_auth_fields_to_users_table.php` memiliki `down()` kosong, sehingga rollback migration tersebut tidak membalik seluruh perubahan.

## Seeder

Entry point adalah `database/seeders/DatabaseSeeder.php`, yang memanggil `AdminUserSeeder`.

```bash
php artisan db:seed
```

Seeder tidak membuat data Mood, Product, Customer, atau Order.

## Storage

`config/filesystems.php` menyediakan disk `local`, `public`, dan `s3`. Symbolic link yang dikonfigurasi adalah `public/storage -> storage/app/public`. Model Product memiliki accessor `image_url`, tetapi upload image belum diimplementasikan.

```bash
php artisan storage:link
```

## Development Commands

```bash
php artisan serve
npm run dev
npm run build
php artisan migrate
php artisan db:seed
php artisan route:list
php artisan test
```

Script Composer yang tersedia:

```bash
composer setup
composer dev
composer test
```

`composer dev` menjalankan server Laravel, queue listener, Laravel Pail, dan Vite secara bersamaan.

## Current Implementation Status

| Feature                | Status              | Notes                                                                      |
| ---------------------- | ------------------- | -------------------------------------------------------------------------- |
| Landing/public website | Complete            | `/` dan view landing tersedia                                              |
| Custom authentication  | Partial             | Login/register/logout tersedia, tetapi konflik dengan Breeze               |
| Register               | Partial             | Validasi dan persistence tersedia; redirect/stack belum konsisten          |
| Login                  | Partial             | Auth attempt dan rate limit tersedia; role redirect belum valid            |
| Logout                 | Partial             | Berfungsi secara struktural, tetapi didefinisikan dua kali                 |
| Role management        | Partial             | Enum dan middleware tersedia; redirect admin bermasalah                    |
| Admin dashboard        | Partial             | UI tersedia; statistik order masih `0`                                     |
| Customer dashboard     | Complete            | Halaman sederhana tersedia tanpa data domain                               |
| Mood management        | Partial             | CRUD utama tersedia; detail view belum ada                                 |
| Product management     | In Progress         | Model, service, repository, dan migration tersedia tanpa HTTP/UI layer     |
| Product display        | Not Implemented     | Belum ada query dan view katalog                                           |
| Stock management       | Planned             | Baru ada enum dan kolom stock                                              |
| Order management       | Planned             | Repository dan enum ada, tetapi model/table belum ada                      |
| Customer management    | Not Implemented     | Tidak ada admin customer module                                            |
| Profile                | Partial             | Controller/view tersedia, route standard belum tersedia                    |
| Image upload           | Not Implemented     | Baru ada kolom image dan storage config                                    |
| Google login           | Partial             | Controller, Socialite, service, dan UI link tersedia                       |
| Payment flow           | Not Implemented     | Tidak ada payment service atau gateway integration                         |
| Reporting              | Not Implemented     | Dompdf/Excel terpasang tetapi belum digunakan                              |
| Seeder                 | Partial             | Hanya admin seeder dan UserFactory                                         |
| Database integration   | Complete foundation | Migration, Eloquent, dan repository tersedia untuk domain saat ini         |
| UI implementation      | Partial             | Landing, auth, admin Mood, dan dashboard tersedia                          |
| Automated tests        | Partial/Blocked     | Test tersedia, tetapi environment audit tidak memiliki SQLite driver aktif |

## Known Limitations / Remaining Work

- `AuthService::redirectAfterLogin()` memanggil method yang tidak ada pada `UserRole`.
- `/login`, `/register`, dan `/logout` didefinisikan oleh route custom dan Breeze.
- Banyak controller, view, dan test memanggil `route('dashboard')`, tetapi route tersebut tidak terdaftar.
- `EnsureIsAdmin` mengarah ke `customer.home`, yang tidak terdaftar.
- Profile routes `profile.edit`, `profile.update`, dan `profile.destroy` belum terdaftar.
- `customer.profile.index` dan `admin.moods.show` belum memiliki view.
- User model tidak terlihat mengimplementasikan `MustVerifyEmail`, meskipun controller verification tersedia.
- Migration role memiliki definisi string dan conditional enum yang tidak seragam.
- Migration auth fields memiliki `down()` kosong.
- Order repository selalu mengembalikan `0`.
- Tidak ada Order model atau Order table.
- Product belum dapat dikelola dari browser.
- Image upload belum tersedia.
- Payment, report, promo, dan customer management belum tersedia.
- Tidak ada seed data Mood atau Product.
- Test suite menggunakan SQLite in-memory, tetapi environment audit gagal menemukan SQLite driver.
- Status `.env`, credential Google, mail server, migration database aktif, symbolic link storage, dan kesesuaian asset `public/build` dengan source perlu diverifikasi pada environment runtime.

## Development Roadmap

### Phase 1 - Stabilization Route dan Authentication

Satukan authentication route/controller, perbaiki role redirect, dan selaraskan route dashboard. File yang kemungkinan terdampak: `routes/web.php`, `routes/auth.php`, `routes/customer.php`, authentication controllers, `AuthService.php`, `UserRole.php`, `EnsureIsAdmin.php`, dan navigation view. Risiko utama adalah dampak pada Google OAuth, view, dan test Breeze.

### Phase 2 - Authorization, Profile, dan Email Verification

Hubungkan profile route/view/controller dan pastikan kontrak email verification serta redirect middleware konsisten. Dependency: Phase 1.

### Phase 3 - Penyelesaian Mood Management

Lengkapi Mood detail view, seed data bila diperlukan, dan test CRUD. Dependency: authorization admin stabil.

### Phase 4 - Product Management dan Product Display

Tambahkan Product controller, request, route, view, dan katalog customer berdasarkan fondasi yang sudah tersedia. Dependency: Mood management selesai karena Product memiliki `mood_id` wajib.

### Phase 5 - Image Upload

Hubungkan `products.image` dengan upload, public storage, validation, dan rendering image. Dependency: Product CRUD.

### Phase 6 - Stock Management

Gunakan `StockAction` dan buat flow stock yang dapat dilacak. Dependency: Product CRUD.

### Phase 7 - Order Management

Buat schema, model, service, repository query, controller, dan UI order. Dependency: Product, customer authentication, dan stock.

### Phase 8 - Customer Purchase Flow

Hubungkan customer dengan product dan order agar customer dapat melihat product, membuat order, dan melihat order miliknya. Dependency: Order Management.

### Phase 9 - Payment Flow

Hubungkan order dengan proses pembayaran dan callback provider. Dependency: Order Management dan customer purchase flow.

### Phase 10 - Customer Management

Sediakan daftar, detail, dan histori customer untuk admin. Dependency: authentication dan order data.

### Phase 11 - Reporting dan Export

Sediakan laporan order, product, stock, dan customer. Dompdf dan Laravel Excel hanya digunakan jika fitur ini diperlukan. Dependency: domain order, payment, stock, dan customer.

### Phase 12 - Regression Validation

Jalankan validasi route dan test setelah setiap phase:

```bash
php artisan route:list
php artisan test
```

## Verification Notes

Audit source dan route dilakukan secara read-only sebelum README ini diperbarui. PHP syntax check berhasil pada file PHP yang diperiksa. PHPUnit belum dapat memvalidasi behavior karena environment audit tidak memiliki SQLite driver aktif. Status credential Google, konfigurasi mail, database aktif, symbolic link storage, dan kesesuaian asset `public/build` dengan source perlu diverifikasi pada environment runtime.
