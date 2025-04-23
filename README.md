Berikut adalah contoh lengkap file `README.md` yang bisa kamu gunakan atau sesuaikan untuk technical test aplikasi pemesanan kendaraan perusahaan tambang nikel:

---

# 🚗 Aplikasi Pemesanan Kendaraan - Perusahaan Tambang Nikel

Aplikasi web ini dibuat untuk memonitor kendaraan perusahaan, termasuk pemesanan kendaraan oleh pegawai, persetujuan berjenjang, monitoring penggunaan kendaraan, konsumsi BBM, jadwal service, dan export laporan berkala.

---

## 📌 Deskripsi Singkat

Perusahaan tambang nikel ini memiliki kantor pusat, cabang, serta enam lokasi tambang. Armada kendaraan terdiri dari angkutan orang dan barang, baik milik perusahaan maupun hasil sewa. Aplikasi ini dirancang untuk:

- **Mengelola pemesanan kendaraan oleh admin**
- **Persetujuan kendaraan secara berjenjang (2 level)**
- **Melihat dashboard pemakaian kendaraan dalam grafik**
- **Meng-export laporan pemesanan kendaraan secara periodik dalam format Excel**

---

## 🔐 Akun Login

| Role     | Username       | Password   |
|----------|----------------|------------|
| Admin    | admin@gmail.com    | password123 |
| Approver 1 | approver1@gmail.com | password123 |
| Approver 2 | approver2@gmail.com | password123 |

> *Catatan: Anda dapat menyesuaikan akun ini di seeder atau database langsung.*

---

## 🧱 Teknologi yang Digunakan

| Komponen        | Versi          |
|-----------------|----------------|
| PHP             | 8.3.x          |
| Laravel         | 12.x           |
| Database        | MySQL 8.x      |
| Frontend        | Laravel Blade + SB Admin 2 |
| Export          | Laravel Excel (maatwebsite/excel) |
| UI Framework    | Bootstrap 4 (SB Admin 2) |
| Diagram Tools   | draw.io, dbdiagram.io |

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

- Grafik jumlah pemesanan kendaraan per bulan
- Statistik kendaraan paling sering dipakai

---

## 📁 Export Laporan

Fitur export laporan pemesanan kendaraan berdasarkan range tanggal, dalam format Excel:

- Tanggal Booking
- Kendaraan
- Driver
- Status
- Catatan

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

- Pemesanan kendaraan baru
- Persetujuan / penolakan oleh Approver
- Update profil user
- Export laporan

---

## 🖥️ UI/UX

- Tampilan responsif (Bootstrap 4)
- Menggunakan template **SB Admin 2**
- Navigasi berdasarkan role (Admin & Approver)
- Validasi form dan feedback alert

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

- Sistem approval minimal 2 level (Approver 1 dan 2)
- Jika satu level menolak, pemesanan dianggap ditolak
- Admin dapat mengatur driver dan approver saat membuat pemesanan

---

Jika kamu butuh versi dalam bentuk PDF atau ingin saya bantu buatkan diagram-nya juga (Activity Diagram dan ERD), tinggal bilang aja!
