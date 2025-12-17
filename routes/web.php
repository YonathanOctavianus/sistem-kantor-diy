<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController; // ✅ TAMBAHKAN INI

// ==================== PUBLIC ROUTES ====================
// Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// ==================== AUTH ROUTES (GUEST) ====================
Route::middleware('guest')->group(function () {
    // GET: Show login form
    Route::get('/login', function () {
        return view('auth.login'); // Pastikan file ada di resources/views/auth/login.blade.php
    })->name('login');
    
    // POST: Handle login submission
    Route::post('/login', function (\Illuminate\Http\Request $request) {
        try {
            // Validasi input
            $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required|min:6',
            ]);
            
            // Cek credentials
            if (Auth::attempt(
                [
                    'email' => $request->email,
                    'password' => $request->password
                ], 
                $request->boolean('remember')
            )) {
                $request->session()->regenerate();
                
                // Redirect ke dashboard setelah login sukses
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            }
            
            // Jika login gagal
            return back()->withErrors([
                'email' => 'Email atau password salah. Silakan coba lagi.',
            ])->withInput($request->only('email', 'remember'));
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
            ])->withInput();
        }
    })->name('login.submit');
});

// ==================== AUTH ROUTES (AUTHENTICATED) ====================
Route::middleware('auth')->group(function () {
    // POST: Logout
    Route::post('/logout', function (\Illuminate\Http\Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('status', 'Anda telah berhasil logout.');
    })->name('logout');
    
    // GET: Logout dengan GET (fallback untuk link)
    Route::get('/logout', function () {
        return redirect()->route('login');
    });
    
    // ✅ ========= FASILITAS ROUTES =========
    // Tampilan user untuk peminjaman fasilitas
    Route::prefix('fasilitas')->group(function () {
        Route::get('/', [FasilitasController::class, 'userIndex'])->name('fasilitas.user');
        Route::post('/pinjam', [FasilitasController::class, 'store'])->name('fasilitas.pinjam');
    });
    
    // Tampilan admin untuk persetujuan (jika diperlukan nanti)
    Route::middleware('checkrole:admin')->prefix('admin/fasilitas')->group(function () {
        Route::get('/', [FasilitasController::class, 'adminIndex'])->name('fasilitas.admin');
        Route::get('/admin/fasilitas/events', [FasilitasController::class, 'getEvents'])->name('fasilitas.events');
        Route::get('/admin/fasilitas/rekap', [FasilitasController::class, 'rekap'])->name('fasilitas.rekap');
        Route::post('/{id}/status', [FasilitasController::class, 'updateStatus'])->name('fasilitas.updateStatus');
    });
    
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
    
    // Home redirect untuk user yang sudah login
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });
});

// ==================== DEBUG ROUTES (Hapus setelah testing) ====================
Route::get('/debug/users', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    
    $users = \App\Models\User::all();
    return view('debug.users', compact('users'));
})->name('debug.users');

Route::get('/debug/login-test', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'Route /login berfungsi',
        'route_login' => route('login'),
        'route_login_submit' => route('login.submit'),
        'current_user' => Auth::check() ? Auth::user()->email : 'Not logged in',
        'session_id' => session()->getId()
    ]);
});

// ==================== FALLBACK ROUTE ====================
Route::fallback(function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});