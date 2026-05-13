# Sistem Informasi Pengarsipan dan Perhitungan Nilai Raport Siswa SMA

Aplikasi web berbasis Laravel 11 untuk mengelola pengarsipan nilai siswa dari kelas 10, 11, sampai 12 (6 semester) dengan perhitungan nilai akhir otomatis.

## Fitur Utama

- **Manajemen Data Siswa**: CRUD siswa dengan NIS, nama, gender, tanggal lahir, dan alamat.
- **Manajemen Mata Pelajaran**: CRUD mata pelajaran.
- **Manajemen Guru**: CRUD guru dengan assignment mata pelajaran.
- **Input Nilai**: Input nilai tugas, UTS, dan UAS siswa per semester.
- **Perhitungan Otomatis**: Nilai akhir dihitung otomatis = (tugas × 0.3) + (UTS × 0.3) + (UAS × 0.4).
- **Predikat Nilai**: Konversi nilai ke predikat (A, B, C, D, E).
- **Raport Lengkap**: Tampilkan raport siswa untuk semua 6 semester.
- **Ranking Siswa**: Ranking per kelas berdasarkan rata-rata nilai.
- **Ekspor PDF**: Export raport ke format PDF (dalam pengembangan).

## Teknologi

- **Framework**: Laravel 11
- **Database**: SQLite (development) / MySQL (production)
- **Frontend**: Blade templates, Bootstrap 5
- **ORM**: Eloquent

## Struktur Database

### Tabel Utama:
- `students` - Data siswa
- `subjects` - Mata pelajaran
- `teachers` - Data guru
- `classes` - Kelas siswa
- `school_years` - Tahun ajaran
- `semesters` - Semester (1-6)
- `grades` - Nilai siswa dengan relasi lengkap

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

4. Konfigurasi database di `.env` (SQLite untuk development):
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE="c:/path/to/database/database.sqlite"
   ```

5. Jalankan migrations dan seeders:
   ```bash
   php artisan migrate:fresh
   php artisan db:seed
   ```

6. Jalankan server:
   ```bash
   php artisan serve
   ```

Akses aplikasi di `http://127.0.0.1:8000`

## Routes

### Web Routes (dengan authentication):
- `GET /` - Dashboard
- `GET /home` - Dashboard
- `GET /students` - Daftar siswa
- `POST /students` - Buat siswa baru
- `PUT /students/{id}` - Update siswa
- `DELETE /students/{id}` - Hapus siswa
- `GET /subjects` - Daftar mata pelajaran
- `POST /subjects` - Buat mata pelajaran baru
- `GET /teachers` - Daftar guru
- `POST /teachers` - Buat guru baru

## Model & Relasi

```
Student
├── hasMany(Grade)

Subject
├── hasMany(Teacher)
├── hasMany(Grade)

Teacher
├── belongsTo(Subject)
├── hasMany(Grade)

Grade
├── belongsTo(Student)
├── belongsTo(Subject)
├── belongsTo(Teacher)
├── belongsTo(SchoolClass)
├── belongsTo(SchoolYear)
├── belongsTo(Semester)
├── calculateNilaiAkhir() [otomatis saat save]
```

## Fitur Pengembangan Selanjutnya

- Input nilai siswa per mata pelajaran
- Tampilan raport lengkap 6 semester
- Ranking siswa per kelas
- Ekspor raport ke PDF
- Import data siswa dari Excel
- Dashboard admin dengan statistik

## Lisensi

MIT License

