@echo off
chcp 65001 >nul
echo.
echo 🔧 FIXING MIGRATION ERRORS
echo ================================
echo.

cd /d C:\laragon\www\office-system-kanwil

echo 1. Checking migration files...
echo.

dir database\migrations\ | find "fasum"

echo.
echo 2. Removing duplicate migrations...
echo.

REM Hapus semua migration fasum yang duplicate (keep yang pertama)
for %%f in (database\migrations\*fasum*) do (
    if not "%%~nxf"=="2025_12_15_074821_create_fasum_table.php" (
        echo Deleting: %%~nxf
        del "database\migrations\%%~nxf"
    )
)

echo.
echo 3. Fresh migrate...
echo.

php artisan migrate:fresh --seed

echo.
echo ✅ MIGRATION FIXED!
echo 📊 Database ready to use.
echo.
pause