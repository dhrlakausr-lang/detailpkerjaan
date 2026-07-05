# LokerinAja Laravel

Versi Laravel dari halaman detail lowongan dan form lamaran.

## Fitur

- Halaman detail lowongan: `/detail/{id}`
- Form lamaran dengan validasi Laravel dan CSRF
- Penyimpanan pelamar ke tabel `pelamar`
- Model Eloquent untuk tabel lama `jobs` dan `pelamar`
- Seeder data lowongan contoh

## Menjalankan Project

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Sesuaikan database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lokerinaja
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration dan seeder:

```bash
php artisan migrate --seed
```

Jalankan server:

```bash
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000/detail/1
```

## Test

```bash
php artisan test
```
