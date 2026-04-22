# NILAI RAPOR SISWA - Sistem Absensi Siswa

Aplikasi web berbasis Laravel untuk mengelola absensi siswa, user management, dan laporan nilai rapor. Menggunakan autentikasi dengan Laravel Sanctum dan Fortify, serta integrasi Firebase untuk notifikasi.

## Fitur Utama

- **Manajemen User**: Registrasi, login, dan profil user dengan role-based access.
- **Absensi**: Check-in/check-out dengan lokasi (latlon), waktu, dan integrasi face recognition.
- **Perusahaan**: Manajemen data perusahaan.
- **Izin**: Sistem permintaan izin.
- **API**: RESTful API untuk mobile app.
- **Dashboard**: Halaman web untuk admin dan user.

## Teknologi

- **Framework**: Laravel 11
- **Database**: MySQL (dengan migrations)
- **Autentikasi**: Laravel Sanctum, Fortify
- **Notifikasi**: Firebase
- **Frontend**: Blade templates, Vite untuk asset bundling

## Instalasi

1. Clone repository:
   ```bash
   git clone <repository-url>
   cd NILAI_RAPOR_SISWA
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Konfigurasi database di `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nilai_rapor_siswa
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. Jalankan migrations dan seeders:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. Build assets:
   ```bash
   npm run build
   ```

7. Jalankan server:
   ```bash
   php artisan serve
   ```

## Penggunaan

- Akses web app di `http://localhost:8000`
- Login sebagai admin atau user
- Gunakan API endpoints untuk integrasi mobile

## API Endpoints

- `POST /api/login` - Login
- `POST /api/checkin` - Check-in absensi
- `POST /api/checkout` - Check-out absensi
- `GET /api/api-attendances` - Lihat absensi
- Lihat `routes/api.php` untuk lengkapnya

## Testing

Jalankan test dengan:
```bash
php artisan test
```

## Kontribusi

1. Fork repository
2. Buat branch fitur baru
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## Lisensi

MIT License
