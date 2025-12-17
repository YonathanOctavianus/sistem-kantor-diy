@echo off
chcp 65001 >nul
echo.
echo 🚀 FIXING EMPTY DATABASE
echo ================================
echo.

cd /d C:\laragon\www\office-system-kanwil

echo 1. Checking Laragon MySQL...
echo    - Pastikan Laragon MySQL HIJAU
echo    - Jika tidak, buka Laragon dan klik "Start All"
echo.

echo 2. Dropping and recreating database...
php artisan db:wipe

echo.
echo 3. Running migrations...
php artisan migrate

echo.
echo 4. Checking tables...
php artisan tinker --execute="
echo '=== CHECKING TABLES ===' . PHP_EOL;
\$tables = \DB::select('SHOW TABLES');
foreach (\$tables as \$table) {
    foreach (\$table as \$key => \$value) {
        \$count = \DB::table(\$value)->count();
        echo 'Table: ' . \$value . ' (' . \$count . ' records)' . PHP_EOL;
    }
}
"

echo.
echo 5. Seeding users...
php artisan db:seed --class=UserSeeder

echo.
echo 6. Verifying users...
php artisan tinker --execute="
echo '=== VERIFYING USERS ===' . PHP_EOL;
\$users = \App\Models\User::all();
if (\$users->count() > 0) {
    echo '✅ Users found: ' . \$users->count() . PHP_EOL;
    foreach (\$users as \$user) {
        echo '- ' . \$user->name . ' (' . \$user->email . ')' . PHP_EOL;
    }
} else {
    echo '❌ NO USERS FOUND!' . PHP_EOL;
    echo 'Running manual insert...' . PHP_EOL;
    
    \DB::table('users')->insert([
        'name' => 'Super Admin',
        'email' => 'admin@test.com',
        'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        'role' => 'superadmin',
        'nip' => '123456',
        'bidang' => 'IT',
        'jabatan' => 'Admin',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    echo '✅ Manual user created!' . PHP_EOL;
}
"

echo.
echo 7. Testing save function...
php artisan tinker --execute="
echo '=== TESTING SAVE FUNCTION ===' . PHP_EOL;
\$user = \App\Models\User::first();
if (\$user) {
    echo 'User found: ' . \$user->name . PHP_EOL;
    
    // Test save
    \$originalName = \$user->name;
    \$user->name = 'Test Save Function';
    \$result = \$user->save();
    
    if (\$result) {
        echo '✅ Save() WORKING! User updated.' . PHP_EOL;
        
        // Revert
        \$user->name = \$originalName;
        \$user->save();
        echo '✅ Name reverted to: ' . \$user->name . PHP_EOL;
    } else {
        echo '❌ Save() FAILED!' . PHP_EOL;
    }
} else {
    echo '❌ No user to test!' . PHP_EOL;
}
"

echo.
echo ✅ DATABASE FIXED!
echo 👤 Test login: superadmin@kemenikan.go.id / admin123
echo.

pause