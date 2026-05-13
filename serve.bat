@echo off
REM Quick launcher for Laravel development server with PHP 8.3
REM Place this in your project root or anywhere in PATH

setlocal enabledelayedexpansion

set PHP_PATH=C:\laragon\bin\php\php-8.3.31-Win32-vs16-x64
set LARAVEL_PATH=D:\project laravel\NILAI_RAPOR_SISWA

REM Add PHP 8.3 to PATH first
set PATH=%PHP_PATH%;%PATH%

REM Change to Laravel directory
cd /d "%LARAVEL_PATH%"

REM Clear screen and show info
cls
echo.
echo ============================================
echo  Laravel Development Server (PHP 8.3.31)
echo ============================================
echo.
echo PHP Version:
php -v
echo.
echo Starting server on http://127.0.0.1:8000
echo Press Ctrl+C to stop
echo.
echo ============================================
echo.

REM Start Laravel development server
php artisan serve --host=127.0.0.1 --port=8000

pause
