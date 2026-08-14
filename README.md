# 🏥 Sistem Manajemen Klinik USG 4D

Website interaktif dan sistem manajemen konten (CMS) yang dibangun khusus untuk Klinik USG 4D. Aplikasi ini dirancang dengan antarmuka yang modern (premium) di sisi pengunjung dan dashboard admin yang sangat intuitif untuk pengelola klinik.

## 🚀 Fitur Utama
- **Frontend Premium & Responsif:** Desain modern dengan animasi halus (Tailwind CSS).
- **Manajemen Layanan:** Pengelolaan paket USG (2D, 3D, 4D) langsung dari dashboard.
- **Profil & Tim Klinik Dinamis:** Visi, Misi, Nilai-nilai, dan daftar Tim/Dokter dapat diubah kapan saja.
- **Manajemen Testimoni & Artikel:** Fitur blog dan review pasien.
- **Pengaturan Global Dinamis:** Logo, Favicon, Hero Background, Jam Operasional, dan Link Sosial Media diatur murni dari dashboard.
- **Integrasi WhatsApp:** Tombol Booking/CTA yang otomatis mengarah ke WhatsApp admin.

## 🛠️ Teknologi yang Digunakan (Tech Stack)
- **Framework Utama:** [Laravel 11.x](https://laravel.com/)
- **Bahasa Pemrograman:** PHP ^8.2
- **Admin Panel:** [Filament v3](https://filamentphp.com/)
- **Styling Frontend:** [Tailwind CSS](https://tailwindcss.com/)
- **Asset Bundler:** [Vite](https://vitejs.dev/)
- **Database:** MySQL / MariaDB

---

## 💻 Panduan Instalasi (Installation Guide)

Ikuti langkah-langkah di bawah ini untuk menginstal dan menjalankan proyek ini di *local machine* atau VPS Anda.

### Persyaratan Sistem (Prerequisites)
Pastikan sistem Anda sudah terinstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / MariaDB (atau software server lokal seperti Laragon/XAMPP)

### Langkah-Langkah

1. **Clone Repository**
   ```bash
   git clone https://github.com/almuhayatsyah/usg4d.git
   cd usg4d
   ```

2. **Instal Dependensi PHP (Composer)**
   ```bash
   composer install
   ```

3. **Instal Dependensi Frontend (NPM)**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   Salin file konfigurasi bawaan dan ubah namanya menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Buka file `.env` dan sesuaikan koneksi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database**
   Jalankan perintah ini untuk membuat tabel-tabel yang diperlukan di database:
   ```bash
   php artisan migrate
   ```

7. **Tautkan Storage (Storage Link)**
   Sangat penting agar gambar yang diunggah (seperti logo, foto tim) bisa diakses di website:
   ```bash
   php artisan storage:link
   ```

8. **Buat Akun Admin**
   Buat akun pertama Anda untuk masuk ke Dashboard Admin Filament:
   ```bash
   php artisan make:filament-user
   ```
   *(Sistem akan meminta Anda memasukkan Nama, Email, dan Password).*

9. **Compile Assets Frontend (Tailwind/Vite)**
   - Jika sedang masa pengembangan (development):
     ```bash
     npm run dev
     ```
   - Jika untuk server produksi (production/hosting):
     ```bash
     npm run build
     ```

10. **Jalankan Server Lokal**
    ```bash
    php artisan serve
    ```
    Website Anda sekarang bisa diakses di: `http://localhost:8000`

---

## 🔒 Mengakses Dashboard Admin
Setelah server berjalan, Anda dapat mengakses halaman admin panel pada URL berikut:
**`http://localhost:8000/admin`**

Gunakan Email dan Password yang telah Anda buat pada Langkah 8.

---

## 📝 Catatan Tambahan Saat Hosting/Deployment
- Pastikan di file `.env` diubah menjadi `APP_ENV=production` dan `APP_DEBUG=false`.
- Sesuaikan `APP_URL` dengan domain Anda (misal: `APP_URL=https://domainklinik.com`).
- Jangan lupa jalankan `npm run build` sebelum file dipindahkan ke public_html/hosting agar website memuat aset dengan ukuran seminimal mungkin.

Dibuat dengan ❤️ untuk layanan kesehatan ibu dan anak yang lebih baik.
