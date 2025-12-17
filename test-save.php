<?php
// test-save.php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Testing database connection and save...\n\n";

// Test 1: Cek koneksi database
try {
    $pdo = DB::connection()->getPdo();
    echo "✅ Database connected: " . $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
    exit;
}

// Test 2: Cek tabel users
try {
    $count = DB::table('users')->count();
    echo "✅ Users table has: " . $count . " records\n";
    
    if ($count > 0) {
        $user = DB::table('users')->first();
        echo "✅ First user: " . $user->name . " (" . $user->email . ")\n";
        
        // Test 3: Update dengan DB facade
        $updated = DB::table('users')
            ->where('id', $user->id)
            ->update([
                'name' => 'Test Update ' . date('H:i:s'),
                'updated_at' => now(),
            ]);
        
        if ($updated) {
            echo "✅ DB::table()->update() WORKING!\n";
            
            // Revert
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'name' => $user->name,
                    'updated_at' => now(),
                ]);
            echo "✅ Name reverted\n";
        } else {
            echo "❌ DB::table()->update() FAILED\n";
        }
    }
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\nDone!\n";