Berikut adalah contoh lengkap file `README.md` yang bisa kamu gunakan atau sesuaikan untuk technical test aplikasi pemesanan kendaraan perusahaan tambang nikel:

---

# 🚗 Aplikasi Pemesanan Kendaraan - Perusahaan Tambang Nikel

Aplikasi web ini dibuat untuk memonitor kendaraan perusahaan, termasuk pemesanan kendaraan oleh pegawai, persetujuan berjenjang, monitoring penggunaan kendaraan, konsumsi BBM, jadwal service, dan export laporan berkala.

---

## 📌 Deskripsi Singkat

Perusahaan tambang nikel ini memiliki kantor pusat, cabang, serta enam lokasi tambang. Armada kendaraan terdiri dari angkutan orang dan barang, baik milik perusahaan maupun hasil sewa. Aplikasi ini dirancang untuk:

-   **Mengelola pemesanan kendaraan oleh admin**
-   **Persetujuan kendaraan secara berjenjang (2 level)**
-   **Melihat dashboard pemakaian kendaraan dalam grafik**
-   **Meng-export laporan pemesanan kendaraan secara periodik dalam format Excel**

---

## 🔐 Akun Login

| Role       | Username            | Password    |
| ---------- | ------------------- | ----------- |
| Admin      | admin@gmail.com     | password123 |
| Approver 1 | approver1@gmail.com | password123 |
| Approver 2 | approver2@gmail.com | password123 |

> _Catatan: Anda dapat menyesuaikan akun ini di seeder atau database langsung._

---

## 🧱 Teknologi yang Digunakan

| Komponen      | Versi                             |
| ------------- | --------------------------------- |
| PHP           | 8.3.x                             |
| Laravel       | 12.x                              |
| Database      | MySQL 8.x                         |
| Frontend      | Laravel Blade + SB Admin 2        |
| Export        | Laravel Excel (maatwebsite/excel) |
| UI Framework  | Bootstrap 4 (SB Admin 2)          |
| Diagram Tools | draw.io, dbdiagram.io             |

---

## 🧭 Panduan Penggunaan

### 1. Setup Aplikasi

```bash
git clone https://github.com/username/pemesanan-kendaraan.git
cd pemesanan-kendaraan
composer install
cp .env.example .env
php artisan key:generate
```

### 2. Konfigurasi Database

Edit file `.env`:

```
DB_DATABASE=pemesanan_kendaraan
DB_USERNAME=root
DB_PASSWORD=
```

Kemudian jalankan:

```bash
php artisan migrate --seed
```

### 3. Menjalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi di [http://localhost:8000](http://localhost:8000)

---

## 📊 Dashboard

Menampilkan:

-   Grafik jumlah pemesanan kendaraan per bulan
-   Statistik kendaraan paling sering dipakai

---

## 📁 Export Laporan

Fitur export laporan pemesanan kendaraan berdasarkan range tanggal, dalam format Excel:

-   Tanggal Booking
-   Kendaraan
-   Driver
-   Status
-   Catatan

---

## 🔁 Alur Aktivitas (Activity Diagram)

![Activity Diagram](https://i.imgur.com/YOUR_IMAGE_LINK.png)

> Diagram menggambarkan proses dari input pemesanan oleh admin → validasi → persetujuan berjenjang → laporan

---

## 🗃️ Physical Data Model (ERD)

![Physical Data Model](https://i.imgur.com/YOUR_IMAGE_LINK_2.png)

> ERD mencakup relasi antar entitas: User, Vehicle, Driver, VehicleBooking

---

## 📝 Log Aplikasi

Setiap proses penting disimpan ke dalam log Laravel (`storage/logs/laravel.log`):

-   Pemesanan kendaraan baru
-   Persetujuan / penolakan oleh Approver
-   Update profil user
-   Export laporan

---

## 🖥️ UI/UX

-   Tampilan responsif (Bootstrap 4)
-   Menggunakan template **SB Admin 2**
-   Navigasi berdasarkan role (Admin & Approver)
-   Validasi form dan feedback alert

---

## 🔧 Struktur Direktori

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Web/
│   └── Middleware/
├── Models/
├── Exports/
resources/
├── views/
│   ├── admin/
│   └── approver/
routes/
├── web.php
```

---

## 📌 Catatan Tambahan

-   Sistem approval minimal 2 level (Approver 1 dan 2)
-   Jika satu level menolak, pemesanan dianggap ditolak
-   Admin dapat mengatur driver dan approver saat membuat pemesanan

---

Jika kamu butuh versi dalam bentuk PDF atau ingin saya bantu buatkan diagram-nya juga (Activity Diagram dan ERD), tinggal bilang aja!

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development/)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
