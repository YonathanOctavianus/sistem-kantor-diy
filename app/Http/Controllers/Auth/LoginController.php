<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';  // Redirect ke dashboard kita
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    // Override showLoginForm untuk pakai view kita
    public function showLoginForm()
    {
        return view('auth.login'); // Pakai view kita sendiri
    }
}