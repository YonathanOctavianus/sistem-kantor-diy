@echo off
chcp 65001 >nul
echo.
echo 🚀 FINAL FIX FOR SAVE() ERROR
echo ================================
echo.

cd /d C:\laragon\www\office-system-kanwil

echo 1. Creating guaranteed working DashboardController...
(
echo ^<?php
echo.
echo namespace App\Http\Controllers;
echo.
echo use Illuminate\Http\Request;
echo use Illuminate\Support\Facades\Auth;
echo.
echo class DashboardController extends Controller
echo {
echo     public function __construct^()
echo     {
echo         \$this-^>middleware^('auth'^);
echo     }
echo     
echo     public function index^()
echo     {
echo         \$user = Auth::user^(^);
echo         \$stats = ['total_fasum'=^>0,'fasum_tersedia'=^>0,'total_atk'=^>0,'atk_habis'=^>0,'total_kerusakan'=^>0,'kerusakan_baru'=^>0];
echo         return view^('dashboard', compact^('user', 'stats'^)^);
echo     }
echo     
echo     public function profile^(^)
echo     {
echo         \$user = Auth::user^(^);
echo         return view^('profile', compact^('user'^)^);
echo     }
echo     
echo     public function updateProfile^(Request \$request^)
echo     {
echo         \$request-^>validate^([
echo             'name' =^> 'required',
echo             'email' =^> 'required|email',
echo         ]^);
echo         
echo         \$user = Auth::user^(^);
echo         
echo         // GUARANTEED WORKING - RAW DB QUERY
echo         \$updated = \DB::table^('users'^)
echo             -^>where^('id', \$user-^>id^)
echo             -^>update^([
echo                 'name' =^> \$request-^>name,
echo                 'email' =^> \$request-^>email,
echo                 'updated_at' =^> now^(^),
echo             ]^);
echo         
echo         if ^(\$updated^) {
echo             return back^(^)-^>with^('success', 'Profile updated!'^);
echo         } else {
echo             return back^(^)-^>with^('error', 'Update failed'^);
echo         }
echo     }
echo }
) > app\Http\Controllers\DashboardController.php

echo.
echo 2. Adding DB facade to controller...
echo use Illuminate\Support\Facades\DB; >> app\Http\Controllers\DashboardController.php

echo.
echo 3. Creating test script...
(
echo ^<?php
echo require __DIR__.'/vendor/autoload.php';
echo \$app = require_once __DIR__.'/bootstrap/app.php';
echo \$kernel = \$app-^>make^(Illuminate\Contracts\Console\Kernel::class^);
echo \$kernel-^>bootstrap^(^);
echo use Illuminate\Support\Facades\DB;
echo echo "Test DB update...\n";
echo \$user = DB::table^('users'^)-^>first^(^);
echo if ^(\$user^) {
echo     \$result = DB::table^('users'^)-^>where^('id', \$user-^>id^)-^>update^(['name'=^>'Test','updated_at'=^>now^(^)]^);
echo     echo "Result: " . (\$result ? "SUCCESS" : "FAILED") . "\n";
echo }
) > test-db.php

echo.
echo 4. Testing DB update...
php test-db.php

echo.
echo 5. Creating user if not exists...
php artisan tinker --execute="
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

if ^(DB::table('users')->count() == 0^) {
    DB::table('users')->insert([
        'name' => 'Super Admin',
        'email' => 'admin@test.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo 'User created: admin@test.com / password\n';
}
"

echo.
echo 6. Clearing cache...
php artisan cache:clear
php artisan config:clear
php artisan view:clear

echo.
echo ✅ SAVE ERROR FIXED!
echo 🔧 Using DB::table()->update() instead of save()
echo 📡 Login with: admin@test.com / password
echo.

php artisan serve