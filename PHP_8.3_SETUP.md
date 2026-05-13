# PHP 8.3 Setup untuk Project Laravel

## Status ✓ Berhasil

- **PHP Version**: 8.3.31 (Laragon)
- **Location**: `C:\laragon\bin\php\php-8.3.31-Win32-vs16-x64`
- **Extensions**: curl, sodium, zip, mbstring, openssl, pdo_mysql, fileinfo (semua aktif)
- **Dependencies**: Composer install selesai dengan 152 packages
- **Vendor**: `vendor/autoload.php` tersedia

## Cara Menggunakan

### ✨ CARA TERCEPAT - PowerShell Function (Recommended)

Buka terminal PowerShell dan jalankan ini **SEKALI SAJA di awal**:
```powershell
. $PROFILE
```

Kemudian Anda bisa langsung gunakan:
```powershell
# Start development server
serve

# Run any artisan command
artisan migrate
artisan tinker
artisan list

# Alias
php-serve
```

**Keuntungan**: Paling mudah, tidak perlu set PATH lagi, bekerja di terminal apapun.

---

### Opsi 2: Batch Script (Standalone)

Double-click file ini untuk langsung jalankan Laravel server:
- **File**: `D:\project laravel\NILAI_RAPOR_SISWA\serve.bat`
- **Hasil**: Server otomatis start dengan PHP 8.3

---

### Opsi 3: Manual PATH di Terminal

Jika tidak ingin load profile setiap kali:
```powershell
$env:Path = "C:\laragon\bin\php\php-8.3.31-Win32-vs16-x64;" + $env:Path
php artisan serve
```

---

### Opsi 4: Laragon GUI

1. Buka **Laragon**
2. Menu → **PHP** → Pilih **php-8.3.31-Win32-vs16-x64**
3. Klik **Restart All**
4. Semua terminal/VS Code akan menggunakan PHP 8.3 setelah restart

## Commands Siap Pakai

Setelah load profile (`. $PROFILE`) atau set PATH:

```powershell
# Development server (shortcut)
serve

# Artisan commands (shortcut)
artisan migrate              # Run migrations
artisan tinker               # Interactive shell
artisan list                 # List all commands
artisan db:seed             # Seed database
artisan test                # Run tests
artisan make:controller MyController

# Direct php artisan (jika prefer)
php artisan serve --host=127.0.0.1 --port=8000
```

## Verifikasi Setup

```powershell
php -v                          # Harus menampilkan PHP 8.3.31
php -m | findstr sodium         # Harus menampilkan "sodium"
php -m | findstr zip            # Harus menampilkan "zip"
composer --version              # Harus menampilkan PHP 8.3.31
```

## Note untuk VS Code

VS Code Terminal menggunakan PowerShell profile Anda. Untuk automatic PHP 8.3:

**Pilihan 1 (Recommended)**: 
- Tambahkan ini ke VS Code terminal settings (`settings.json`):
```json
"terminal.integrated.shellArgs.windows": ["-NoExit", "-Command", ". $PROFILE"]
```

**Pilihan 2 (Simpler)**:
- Setiap kali buka terminal VS Code, ketik: `. $PROFILE`
- Kemudian `artisan serve` atau command lainnya

**Pilihan 3**:
- Buka Laragon → Set PHP 8.3 as default → Restart All

## PowerShell Profile Info

File profile Anda berisi function shortcuts:
- `serve` - Mulai development server
- `artisan` - Jalankan artisan command  
- `php-serve` - Alias untuk serve

**Location**: `C:\Users\HP\OneDrive\Documents\WindowsPowerShell\Microsoft.PowerShell_profile.ps1`

- `C:\laragon\bin\php\php-8.3.31-Win32-vs16-x64\php.ini` - Konfigurasi PHP
  - extensions=sodium (aktif)
  - extension=zip (aktif)
  - extension=curl (aktif)
- `D:\project laravel\NILAI_RAPOR_SISWA\composer.lock` - Dependencies locked
- `D:\project laravel\NILAI_RAPOR_SISWA\vendor/` - Dependencies installed

---
**Last Updated**: May 13, 2026
**Status**: Fully operational
