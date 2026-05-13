@echo off
REM Laravel Artisan wrapper with automatic PHP 8.3.31 selection
REM Place in project root or add directory to PATH
REM Usage: artisan serve, artisan migrate, etc.

setlocal enabledelayedexpansion

set PHP_8_3_PATH=C:\laragon\bin\php\php-8.3.31-Win32-vs16-x64
set LARAVEL_PROJECT=D:\project laravel\NILAI_RAPOR_SISWA

REM Check if PHP 8.3 exists
if not exist "%PHP_8_3_PATH%\php.exe" (
    echo ERROR: PHP 8.3.31 not found at %PHP_8_3_PATH%
    exit /b 1
)

REM Check if we're in the Laravel project directory
if "%CD%"=="%LARAVEL_PROJECT%" (
    REM Already in project directory
) else (
    REM Change to project directory if not already there
    cd /d "%LARAVEL_PROJECT%" || (
        echo ERROR: Could not change to Laravel project directory
        exit /b 1
    )
)

REM Set PHP 8.3 in PATH (prepend to ensure it's used first)
set PATH=%PHP_8_3_PATH%;%PATH%

REM Execute artisan command with PHP 8.3
%PHP_8_3_PATH%\php.exe artisan %*

REM Exit with same code as php artisan
exit /b %errorlevel%
