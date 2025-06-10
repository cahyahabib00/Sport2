

````markdown
# ⚽ Soccer App

**Soccer App** adalah aplikasi web berbasis **Laravel** yang dirancang untuk penggemar sepak bola. Aplikasi ini memungkinkan pengguna untuk menjelajahi informasi tentang liga, pertandingan, klasemen, tim, serta menyimpan tim favorit mereka.

Dengan antarmuka modern dan responsif yang dibangun menggunakan **Tailwind CSS**, aplikasi ini mengintegrasikan data real-time dari **API TheSportsDB** untuk memberikan pengalaman interaktif dan informatif bagi pengguna.

---

## ✨ Fitur Utama

### 📋 Daftar Liga
- Menampilkan daftar liga sepak bola dari seluruh dunia.
- Dilengkapi logo, nama liga, dan tautan ke pertandingan, klasemen, serta tim.

### 🏟️ Daftar Pertandingan
- Menampilkan pertandingan terakhir dalam liga tertentu.
- Informasi meliputi skor, tim, tanggal, dan venue.

### 📊 Klasemen Liga
- Tabel peringkat untuk liga tertentu.
- Informasi: nama tim, jumlah pertandingan, gol, poin, dan lainnya.

### 👥 Daftar Tim
- Grid tim dengan logo dan nama.
- Tautan ke halaman detail tiap tim.

### 📄 Detail Tim
- Menampilkan: nama, logo, tahun berdiri, negara, stadion, pelatih, deskripsi, dan website resmi.

### ⭐ Tim Favorit
- Pengguna dapat menambahkan dan menghapus tim dari daftar favorit.
- Halaman khusus untuk menampilkan tim favorit yang disimpan secara lokal di database SQLite.

### 🎨 Desain Modern & Responsif
- Tema gelap dengan teks putih dan aksen merah.
- Dioptimalkan untuk perangkat mobile, tablet, dan desktop.

### 🚀 Caching Logo
- Logo liga dan tim disimpan lokal untuk menghindari masalah CORS dan meningkatkan performa.

---

## 🛠️ Teknologi yang Digunakan

| Layer       | Teknologi                 |
|-------------|---------------------------|
| Backend     | Laravel 11.x, Livewire 3.x|
| Frontend    | Tailwind CSS, Blade       |
| Database    | SQLite                    |
| API         | [TheSportsDB](https://www.thesportsdb.com) |
| Bahasa      | PHP 8.1+, JavaScript      |
| Tools       | Composer, NPM, Vite       |

---

## ⚙️ Prasyarat

Pastikan sistem Anda telah menginstal:

- PHP >= 8.1
- Composer
- Node.js >= 16.x + NPM
- SQLite
- Git
- Koneksi internet (untuk API)

---

## 🚀 Cara Instalasi

```bash
# 1. Clone repository
git clone https://github.com/cahyahabib00/Sport2.git
cd Sport2

# 2. Install dependensi PHP
composer install

# 3. Install dependensi frontend
npm install

# 4. Salin file environment
cp .env.example .env

# 5. Buat database SQLite
touch database/database.sqlite
````

Edit file `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/Sport2/database/database.sqlite
```

```bash
# 6. Generate application key
php artisan key:generate

# 7. Jalankan migrasi database
php artisan migrate

# 8. Buat symbolic link storage
php artisan storage:link

# (Opsional) Bersihkan cache jika perlu
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan optimize:clear
```

---

## ▶️ Menjalankan Aplikasi

```bash
# Jalankan Laravel server
php artisan serve
```

```bash
# Jalankan Vite untuk frontend
npm run dev
```

Akses aplikasi di browser: [http://localhost:8000](http://localhost:8000)

---

## 🧭 Navigasi Fitur

* **Liga**: Klik “Liga” untuk menampilkan daftar liga sepak bola.
* **Pertandingan**: Klik “Pertandingan” pada liga untuk melihat jadwal terbaru.
* **Klasemen**: Klik “Klasemen” untuk melihat peringkat tim dalam liga.
* **Tim**: Klik “Tim” untuk melihat daftar tim di liga.
* **Detail Tim**: Klik nama tim untuk info lengkap.
* **Favorit**: Tambahkan/hapus tim ke favorit di halaman detail, lalu cek daftar favorit di navbar.

---

## 📁 Struktur Proyek (Highlight)

```
Sport2/
├── app/
│   ├── Http/Livewire/
│   │   ├── LeaguesList.php
│   │   ├── MatchesList.php
│   │   ├── MatchDetail.php
│   │   ├── StandingsList.php
│   │   ├── TeamsList.php
│   │   ├── TeamDetail.php
│   │   └── FavoriteTeamsList.php
│   ├── Models/FavoriteTeam.php
│   └── Services/SportsDbService.php
├── database/database.sqlite
├── resources/views/livewire/
│   ├── leagues-list.blade.php
│   ├── matches-list.blade.php
│   ├── match-detail.blade.php
│   ├── standings-list.blade.php
│   ├── teams-list.blade.php
│   ├── team-detail.blade.php
│   └── favorite-teams-list.blade.php
├── routes/web.php
└── ...
```

---

## 🧩 Troubleshooting

### ⚠️ Class App\Services\SportsDbService does not exist

* Pastikan file `app/Services/SportsDbService.php` ada dan namespace sesuai.
* Jalankan:

  ```bash
  composer dump-autoload
  ```

### ⚠️ Logo Tidak Muncul

* Periksa `storage/logs/laravel.log`.
* Pastikan direktori `storage/app/public/badges` dapat ditulis (`writable`).

### ⚠️ API Kosong / 429 Error

* Coba buka API langsung di browser:

  * `https://www.thesportsdb.com/api/v1/json/123/all_leagues.php`
* Jika error 429 (Too Many Requests), tunggu 1-2 menit atau gunakan API key alternatif (contoh: `1`, `3`).

### ⚠️ Error Database

* Pastikan `database.sqlite` ada dan path-nya benar.
* Jalankan ulang migrasi jika perlu:

  ```bash
  php artisan migrate:fresh
  ```

### ⚠️ Frontend Tidak Tampil

* Pastikan `npm run dev` berjalan tanpa error.
* Cek konsol browser (`F12`) untuk pesan error.

---

## 🤝 Kontribusi

Kami terbuka untuk kontribusi dari siapa pun:

1. Fork repository ini.
2. Buat branch fitur baru:

   ```bash
   git checkout -b feature/nama-fitur
   ```
3. Commit perubahan:

   ```bash
   git commit -m "Menambahkan fitur X"
   ```
4. Push dan buat Pull Request.

Juga silakan buka issue untuk bug atau saran fitur baru.

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License**. Lihat file [LICENSE](./LICENSE) untuk detail.

---

## 📬 Kontak

Dikembangkan oleh **\[Cahya Habib / Universitas Aisyah Pringsewu]**
📧 Email: \[[email@example.com](mailto:cahyahabib56@example.com)]
💻 GitHub: [https://github.com/cahyahabib00](https://github.com/cahyahabib00)

---

> Terima kasih telah menggunakan Soccer App!
> Semoga aplikasi ini bisa menjadi teman setia Anda dalam menjelajahi dunia sepak bola. ⚽

```

```
