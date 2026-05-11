# Sumedang Creative Center (SCC) - Room Booking System

Sumedang Creative Center (SCC) adalah sebuah platform *booking* ruangan kreatif premium berbasis web yang didesain untuk masyarakat Sumedang. Proyek ini memfasilitasi peminjaman berbagai fasilitas kreatif (seperti Studio Produksi, Ruang Kelas, Auditorium, dll.) secara gratis dengan sistem yang mudah, cepat, dan profesional.

---

## 🚀 Fitur Utama

- **Real-time Availability Check**: Pengguna dapat melihat ketersediaan ruangan berdasarkan tanggal secara *real-time* sebelum melakukan pemesanan.
- **Sistem Role (Admin & User)**: 
  - **User**: Dapat melihat ruangan, mengecek jadwal, dan melakukan booking ruangan.
  - **Admin**: Memiliki akses ke Dashboard khusus untuk mengelola (*approve/reject*) pengajuan booking, serta mengelola data ruangan.
- **Modern & Fresh UI**: Antarmuka pengguna (UI) dibangun menggunakan sistem desain premium (terinspirasi dari *Vodafone Design System* dan referensi desain editorial modern) yang *clean*, *flat*, dan memiliki tipografi yang kuat.
- **Manajemen Profil & Histori**: Pengguna dapat melihat status dan riwayat pemesanan yang telah mereka buat melalui halaman profil.

## 🛠️ Tech Stack

Proyek ini dibangun menggunakan teknologi modern untuk menjamin kecepatan dan stabilitas:
- **Framework Backend**: Laravel 11 (PHP 8.2+)
- **Frontend & Styling**: Blade Templates + Tailwind CSS (via Vite)
- **Database**: MySQL / SQLite (Sesuai konfigurasi `.env`)
- **Iconography**: FontAwesome 6

## 🎨 Design System

Proyek ini mematuhi `DESIGN.md` yang menetapkan standar UI yang profesional:
- **Warna Utama**: Brand Red (`#e60000`), Charcoal (`#25282b`), White (`#ffffff`), dan Light Neutral (`#f2f2f2`).
- **Tipografi**: Inter (Sangat besar & *uppercase* untuk judul/hero, dan reguler untuk teks tubuh).
- **Komponen**: 
  - *Flat Design* (Tanpa bayangan / *drop-shadows* atau gradien).
  - *Two-tier Button System* (2px border-radius untuk tombol utilitas, 60px pill untuk CTA).

---

## ⚙️ Panduan Instalasi (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di komputer lokal Anda:

### 1. Persyaratan Sistem
- PHP >= 8.2
- Composer
- Node.js & NPM
- Database (MySQL/MariaDB atau SQLite)

### 2. Clone Repository
```bash
git clone <url-repository>
cd sumedang-creative-center
```

### 3. Install Dependencies PHP & Node.js
```bash
composer install
npm install
```

### 4. Konfigurasi Environment
Salin file `.env.example` menjadi `.env` dan atur konfigurasi database Anda.
```bash
cp .env.example .env
```
Generate Application Key:
```bash
php artisan key:generate
```

### 5. Setup Database & Seeding
Jalankan migrasi database beserta seeder untuk memuat data awal (Akun Admin, Akun Dummy, dan Data Ruangan).
```bash
php artisan migrate:fresh --seed
```
*Catatan: Menjalankan seeder sangat penting karena data Ruangan (Rooms) dan SOP di-generate dari sana.*

### 6. Storage Link
Karena aplikasi menggunakan sistem upload/penyimpanan gambar untuk foto ruangan, pastikan folder storage terhubung ke folder public:
```bash
php artisan storage:link
```

### 7. Jalankan Server
Buka dua terminal terpisah.
Terminal 1 (Untuk build aset Tailwind CSS):
```bash
npm run dev
```

Terminal 2 (Untuk menjalankan server PHP bawaan Laravel):
```bash
php artisan serve
```

Aplikasi sekarang dapat diakses melalui browser pada `http://127.0.0.1:8000`.


---

## 📁 Struktur Direktori Penting

- `app/Http/Controllers/` - Logika bisnis dan kontrol arus data (BookingController, AdminController, dll).
- `resources/views/` - File tampilan (Blade templates) termasuk layout utama dan komponen UI modern.
- `resources/views/home.blade.php` - Halaman *Landing Page* utama dengan desain UI terbaru.
- `database/seeders/` - Berisi data dummy dan data ruangan (SCC) yang di-inject saat migrasi.
- `DESIGN.md` - Dokumen pedoman sistem desain (UI/UX) untuk proyek ini.

---

*Dikembangkan untuk mendukung produktivitas dan kreativitas masyarakat Sumedang. Hak Cipta © Muhammad Lazuardi Al-Farisi.*
