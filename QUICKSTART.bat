@echo off
REM Quick Start Guide for Mannalon App on Windows
REM Run this batch file in Command Prompt or PowerShell

echo.
echo ============================================
echo 🌾 Mannalon App - Quick Start Setup (Windows)
echo ============================================
echo.

REM Step 1: Install Dependencies
echo Step 1: Installing Composer dependencies...
echo This may take a few minutes...
call composer install
if %errorlevel% neq 0 (
    echo Error during composer install. Make sure Composer is installed and in PATH.
    pause
    exit /b 1
)

REM Step 2: Setup Environment
echo.
echo Step 2: Setting up environment...
copy .env.example .env
echo Environment file created.

REM Step 3: Generate App Key
echo.
echo Step 3: Generating application key...
call php artisan key:generate
if %errorlevel% neq 0 (
    echo Error generating app key. Make sure PHP is installed and in PATH.
    pause
    exit /b 1
)

REM Step 4: Clear Cache
echo.
echo Step 4: Clearing cache...
call php artisan cache:clear
call php artisan config:clear

REM Step 5: Instructions
echo.
echo ==========================================
echo ✅ Setup Complete!
echo ==========================================
echo.
echo NEXT STEPS:
echo ===========
echo.
echo 1. Create database in MySQL:
echo    CREATE DATABASE mannalon_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
echo.
echo 2. Update .env file with database credentials:
echo    DB_DATABASE=mannalon_app
echo    DB_USERNAME=root
echo    DB_PASSWORD=
echo.
echo 3. Run migrations:
echo    php artisan migrate
echo.
echo 4. Start the development server:
echo    php artisan serve
echo.
echo 5. Open browser and visit:
echo    http://localhost:8000
echo.
echo TEST CREDENTIALS:
echo =================
echo Admin Account:
echo   Email: admin@mannalon.com
echo   Password: password
echo.
echo Farmer Account:
echo   Email: farmer@mannalon.com
echo   Password: password
echo.
echo Happy Farming! 🌾
echo.
pause
