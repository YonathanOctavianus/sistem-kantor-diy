@echo off
chcp 65001 >nul
echo.
echo 🚀 CREATING KANWIL USERS
echo ==========================
echo.

cd /d C:\laragon\www\office-system-kanwil

echo Step 1: Clearing existing users...
php artisan tinker --execute="DB::table('users')->truncate(); echo 'Old users cleared';"

echo.
echo Step 2: Creating new users...
php artisan tinker --execute="
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

\$result = DB::table('users')->insert([
    [
        'name' => 'Super Admin',
        'email' => 'superadmin@kemenikan.go.id',
        'password' => Hash::make('admin123'),
        'role' => 'superadmin',
        'nip' => '198012312345',
        'bidang' => 'Administrasi',
        'jabatan' => 'Super Administrator',
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Admin Fasilitas',
        'email' => 'fasilitas@kemenikan.go.id',
        'password' => Hash::make('fasilitas123'),
        'role' => 'admin',
        'nip' => '198512312346',
        'bidang' => 'Fasilitas Umum',
        'jabatan' => 'Admin Fasilitas',
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Budi Santoso',
        'email' => 'budi@kemenikan.go.id',
        'password' => Hash::make('user123'),
        'role' => 'user',
        'nip' => '199012312347',
        'bidang' => 'Kepegawaian',
        'jabatan' => 'Staf',
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);

if (\$result) {
    echo 'SUCCESS: 3 users created!';
} else {
    echo 'ERROR: Failed to create users';
}
"

echo.
echo Step 3: Verifying users...
php artisan tinker --execute="
\$users = DB::table('users')->get();
echo 'Total users: ' . \$users->count() . PHP_EOL;
foreach (\$users as \$user) {
    echo '- ' . \$user->email . ' (' . \$user->role . ')' . PHP_EOL;
}
"

echo.
echo ✅ DONE!
echo 👤 Login with: superadmin@kemenikan.go.id / admin123
echo.
pause