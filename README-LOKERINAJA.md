# LokerinAja — Daftar Lowongan (versi terpisah)

Salinan project Laravel **LokerinAja** yang sudah dipisah agar **fokus ke fitur Daftar Lowongan saja**.
Bagian login/register dan lamaran (apply) sudah dibuang supaya tidak kecampur.

## Menjalankan

```bash
cd lokerinaja-daftar-lowongan
php artisan migrate:fresh --seed   # isi data contoh lowongan
php artisan serve
```

Buka http://127.0.0.1:8000

Database: **SQLite** (`database/database.sqlite`) — langsung jalan tanpa setup.

## File yang dikerjakan (bagian Daftar Lowongan)

| Bagian      | File                                                     |
|-------------|----------------------------------------------------------|
| Route       | `routes/web.php` (hanya `GET /` → `lowongan.index`)      |
| Controller  | `app/Http/Controllers/LowonganController.php`           |
| Model       | `app/Models/Lowongan.php`                               |
| Tampilan    | `resources/views/lowongan/index.blade.php`             |
| Tabel       | `database/migrations/2026_06_26_000001_create_lowongan_table.php` |
| Data contoh | `database/seeders/DatabaseSeeder.php`                  |
| Aset        | `public/css/DaftarLowongan.css`, `public/js/DaftarLowongan.js` |

## Fitur

- Pencarian posisi/perusahaan, filter (lokasi, kategori, tipe, pengaturan kerja, level)
- Urutkan: terbaru / gaji tertinggi / gaji terendah
- Pagination (6 lowongan per halaman)

> Catatan: file bawaan Laravel (model `User`, migrasi `users`/`cache`/`jobs`) sengaja
> dibiarkan karena dibutuhkan kerangka Laravel, tapi tidak dipakai fitur ini.

## Setup di laptop teman (cara dapat database yang sama)

Database TIDAK ikut di folder secara otomatis (pakai MySQL). Pilih salah satu:

### Cara A — pakai seeder (struktur + data contoh)
```bash
cp .env.example .env          # lalu isi DB (lihat di bawah)
php artisan key:generate
php artisan migrate:fresh --seed
```

### Cara B — import file backup (data persis punya pengirim)
Tersedia file `database/lokerinaja_lowongan.sql`.
1. Buat database `lokerinaja_lowongan` di phpMyAdmin (atau biarkan, file sudah ada `CREATE DATABASE`).
2. Import lewat phpMyAdmin → tab **Import** → pilih file `.sql`.
   Atau lewat terminal:
   ```bash
   /Applications/XAMPP/xamppfiles/bin/mysql -u root -h 127.0.0.1 -P <PORT> < database/lokerinaja_lowongan.sql
   ```

### Isi `.env` (sesuaikan PORT MySQL masing-masing!)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306        # XAMPP default 3306; di laptop ini kebetulan 3307
DB_DATABASE=lokerinaja_lowongan
DB_USERNAME=root
DB_PASSWORD=
```
> Cek port MySQL XAMPP di Control Panel atau `etc/my.cnf`.
