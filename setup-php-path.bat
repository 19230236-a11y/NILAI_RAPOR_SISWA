@echo off
REM Setup script to permanently set PHP 8.3.31 in user PATH
REM Run this once to make php artisan work globally
REM Does NOT require admin rights (modifies user-level PATH, not system-level)

setlocal enabledelayedexpansion

set "PHP_8_3=C:\laragon\bin\php\php-8.3.31-Win32-vs16-x64"
set "PHP_8_1=C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64"

echo.
echo ============================================
echo  PHP 8.3 Setup for User PATH
echo ============================================
echo.

REM Check if PHP 8.3 exists
if not exist "%PHP_8_3%\php.exe" (
    echo ERROR: PHP 8.3.31 not found at %PHP_8_3%
    echo Please verify the path exists
    pause
    exit /b 1
)

echo Checking current PATH...
setx PATH "%PHP_8_3%;%PATH%"

if %errorlevel% equ 0 (
    echo.
    echo SUCCESS! User-level PATH updated
    echo.
    echo Changes will take effect:
    echo 1. Close this window
    echo 2. Close ALL open terminals (including VSCode terminals)
    echo 3. Open new terminal - PHP 8.3 will be active
    echo.
    echo You can now use:
    echo   php artisan serve
    echo   php artisan migrate
    echo   Any artisan command
    echo.
) else (
    echo ERROR: Could not update PATH
    echo This usually means permission issues
    pause
    exit /b 1
)

echo.
pause
