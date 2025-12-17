@echo off
chcp 65001 >nul
echo.
echo 🚀 FIXING DATABASE SEEDER ERROR
echo ================================
echo.

cd /d C:\laragon\www\office-system-kanwil

echo 1. Creating DatabaseSeeder.php...
(
echo ^<?php
echo.
echo namespace Database\Seeders;
echo.
echo use Illuminate\Database\Seeder;
echo.
echo class DatabaseSeeder extends Seeder
echo {
echo     public function run^()
echo     {
echo         // Run user seeder
echo         $this-^>call^([
echo             UserSeeder::class,
echo         ]^);
echo     }
echo }
) > database\seeders\DatabaseSeeder.php

echo.
echo 2. Removing duplicate migration files...
if exist "database\migrations\2025_12_15_075344_create_atks_table.php" (
    echo Deleting duplicate atks migration...
    del "database\migrations\2025_12_15_075344_create_atks_table.php"
)

echo.
echo 3. Fresh migrating database...
php artisan migrate:fresh

echo.
echo 4. Seeding users...
php artisan db:seed --class=UserSeeder

echo.
echo ✅ DATABASE READY!
echo 📊 Tables created: users, fasum, atk, kerusakan, peminjamen, permintaan_atks
echo 👤 Test user: superadmin@kemenikan.go.id / admin123
echo.

pause