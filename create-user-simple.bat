@echo off
echo Creating user...
cd C:\laragon\www\office-system-kanwil

php artisan tinker --execute="
// Disable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=0');
DB::table('users')->truncate();
DB::statement('SET FOREIGN_KEY_CHECKS=1');

// Create user
DB::table('users')->insert([
    'name' => 'Admin',
    'email' => 'admin@test.com',
    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'role' => 'admin',
    'nip' => '123',
    'bidang' => 'IT',
    'jabatan' => 'Admin',
    'created_at' => now(),
    'updated_at' => now(),
]);

echo 'User created successfully!';
echo 'Login with: admin@test.com / password';
"

pause