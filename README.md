# IndustriSync Web - Platform Integrasi & Monitoring UMKM

IndustriSync Web adalah aplikasi manajemen bisnis modern berbasis Laravel yang dirancang khusus untuk membantu UMKM dalam memantau stok, mencatat transaksi, dan menganalisis keuntungan secara real-time.

## Fitur Utama
- **Dashboard SaaS Modern:** Grafik penjualan 7 hari terakhir, total omzet, profit, dan statistik produk.
- **Manajemen Produk & Stok:** CRUD produk dengan kategori, upload gambar, dan alert stok menipis.
- **Sistem Transaksi (POS):** Pencatatan transaksi cepat dengan pengurangan stok otomatis dan generate invoice PDF.
- **Laporan Bisnis:** Laporan penjualan dan stok yang dapat difilter berdasarkan tanggal dan diekspor ke PDF.
- **Manajemen Pengguna:** Pengaturan role (Admin, Owner, Staff) dengan middleware akses.
- **UI/UX Profesional:** Responsive design, SweetAlert2 notifications, dan loading spinners.

## Teknologi yang Digunakan
- Laravel 12.x
- Bootstrap 5 & CSS Modern
- Chart.js (Grafik Analitik)
- SweetAlert2 & FontAwesome
- DomPDF (Ekspor Laporan)

## Langkah Instalasi

1. **Clone project dan masuk ke direktori:**
   ```bash
   cd industrisync
   ```

2. **Instal dependensi PHP & JS:**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Konfigurasi Environment:**
   Salin file `.env.example` menjadi `.env` dan generate key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup Database:**
   Pastikan menggunakan SQLite (default) atau sesuaikan di `.env`. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```

5. **Link Storage untuk Gambar:**
   ```bash
   php artisan storage:link
   ```

6. **Jalankan Aplikasi:**
   ```bash
   php artisan serve
   ```

## Akun Demo (Default)
- **Admin:** admin@industrisync.com / password
- **Owner:** owner@industrisync.com / password

---
Dibuat dengan dedikasi untuk kemajuan UMKM Indonesia.
