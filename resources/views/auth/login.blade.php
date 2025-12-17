<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Aplikasi Perkantoran</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'midnight': '#07213D',
                        'gold': '#EEBF63',
                        'platinum': '#E0E2E3',
                    },
                    fontFamily: {
                        'titillium': ['Titillium Web', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Titillium Web', sans-serif;
        }
        
        body {
            background: #f8fafc;
            min-height: 100vh;
            margin: 0;
        }
        
        .login-input {
            background: white;
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .login-input:focus {
            border-color: #07213D;
            box-shadow: 0 0 0 3px rgba(7, 33, 61, 0.1);
        }
        
        .login-card {
            background: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 60px rgba(7, 33, 61, 0.1);
        }
        
        .gradient-border {
            position: relative;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(45deg, #07213D, #EEBF63) border-box;
            border: 2px solid transparent;
        }
        
        /* Glow effect untuk logo */
        .logo-glow {
            filter: drop-shadow(0 0 15px rgba(238, 191, 99, 0.3));
        }
        
        /* Floating animation untuk logo */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .floating-logo {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="font-titillium antialiased">
    
    <div class="min-h-screen flex">
        
        {{-- BAGIAN KIRI: VISUAL MEWAH (Desktop) --}}
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-midnight via-midnight/95 to-midnight/90 overflow-hidden">
            {{-- Background Ornaments --}}
            <div class="absolute inset-0">
                <div class="absolute top-0 right-0 w-96 h-96 bg-gold/5 rounded-full blur-3xl -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl -ml-20 -mb-20"></div>
                {{-- Elegant Pattern --}}
                <div class="absolute inset-0 opacity-[0.03] bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
            </div>

            <div class="relative z-10 w-full flex flex-col justify-center items-center text-center px-12">
                {{-- Logo Section - Tanpa Border --}}
                <div class="flex items-center justify-center gap-8 mb-12">
                    {{-- Logo Kemenimipas --}}
                    <div class="floating-logo logo-glow">
                        <div class="w-48 h-48 flex items-center justify-center">
                            <img src="{{ asset('images/logo_kemenipas.png') }}" 
                                 alt="Logo Kemenimipas" 
                                 class="w-full h-full object-contain"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="hidden w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-6xl font-bold text-gold mb-2">🛡️</div>
                                    <div class="text-white font-bold text-xl">KEMENIMIPAS</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Divider --}}
                    <div class="h-40 w-px bg-gradient-to-b from-transparent via-gold/50 to-transparent rounded-full"></div>
                    
                    {{-- Logo Ditjenpas --}}
                    <div class="floating-logo logo-glow" style="animation-delay: 1s;">
                        <div class="w-48 h-48 flex items-center justify-center">
                            <img src="{{ asset('images/logo_ditjenpas.png') }}" 
                                 alt="Logo Ditjenpas" 
                                 class="w-full h-full object-contain"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="hidden w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-6xl font-bold text-gold mb-2">⚖️</div>
                                    <div class="text-white font-bold text-xl">DITJENPAS</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Title dengan efek elegant --}}
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-white mb-2 tracking-wider">
                        SISTEM APLIKASI PERKANTORAN
                    </h1>
                    <div class="inline-flex items-center gap-3">
                        <div class="w-12 h-0.5 bg-gradient-to-r from-transparent to-gold"></div>
                        <p class="text-lg text-gold font-semibold tracking-[0.2em] uppercase">
                            Kanwil Kemenimipas DIY
                        </p>
                        <div class="w-12 h-0.5 bg-gradient-to-r from-gold to-transparent"></div>
                    </div>
                </div>
                
                {{-- Description --}}
                <p class="text-slate-300/80 text-base max-w-lg leading-relaxed font-light tracking-wide mb-10 px-4">
                    Platform terintegrasi untuk efisiensi manajemen fasilitas, inventaris ATK, 
                    dan pemeliharaan aset dalam lingkungan kerja pemerintahan yang profesional.
                </p>
                
                {{-- Features Grid Elegant --}}
                <div class="grid grid-cols-3 gap-8 max-w-2xl mb-12">
                    <div class="text-center group">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-gold/10 to-transparent border border-gold/20 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-building text-gold text-xl"></i>
                        </div>
                        <p class="text-white/90 text-sm font-semibold tracking-wide">FASILITAS</p>
                    </div>
                    
                    <div class="text-center group">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-gold/10 to-transparent border border-gold/20 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-pencil-alt text-gold text-xl"></i>
                        </div>
                        <p class="text-white/90 text-sm font-semibold tracking-wide">ATK</p>
                    </div>
                    
                    <div class="text-center group">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-gold/10 to-transparent border border-gold/20 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-tools text-gold text-xl"></i>
                        </div>
                        <p class="text-white/90 text-sm font-semibold tracking-wide">MAINTENANCE</p>
                    </div>
                </div>

                {{-- Security Badge Elegant --}}
                <div class="mt-8">
                    <div class="inline-flex items-center gap-3 bg-white/5 backdrop-blur-sm px-6 py-3 rounded-full border border-white/10 hover:border-gold/30 transition-all duration-300 group cursor-pointer">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gold/20 to-gold/10 flex items-center justify-center group-hover:rotate-12 transition-transform">
                            <i class="fas fa-shield-check text-gold"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-white text-sm font-semibold tracking-wide">SISTEM TERPROTEKSI</p>
                            <p class="text-white/60 text-xs">Enkripsi AES-256 • Two-Factor Auth</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Elegant Footer --}}
            <div class="absolute bottom-8 left-0 w-full">
                <div class="flex flex-col items-center">
                    <div class="w-24 h-px bg-gradient-to-r from-transparent via-gold/30 to-transparent mb-2"></div>
                    <p class="text-[10px] text-slate-500/80 font-mono tracking-widest">SECURE ACCESS • v2.5.1</p>
                </div>
            </div>
        </div>

        {{-- BAGIAN KANAN: AREA FORM LOGIN --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center relative p-6 bg-gradient-to-br from-slate-50 via-white to-slate-50/80">
            
            {{-- Background Ornaments Minimal --}}
            <div class="absolute top-0 right-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute top-[-10%] right-[-5%] w-96 h-96 bg-blue-50/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-[-10%] left-[-5%] w-96 h-96 bg-amber-50/20 rounded-full blur-3xl"></div>
            </div>

            {{-- Mobile Header - Juga tanpa border --}}
            <div class="lg:hidden w-full text-center mb-8 relative z-10">
                <div class="flex justify-center items-center gap-6 mb-4">
                    {{-- Logo Kemenimipas Mobile --}}
                    <div class="w-20 h-20 flex items-center justify-center">
                        <img src="{{ asset('images/logo_kemenipas.png') }}" 
                             alt="Logo Kemenimipas" 
                             class="w-full h-full object-contain logo-glow">
                    </div>
                    
                    {{-- Divider Mobile --}}
                    <div class="h-12 w-px bg-gradient-to-b from-transparent via-slate-300 to-transparent rounded-full"></div>
                    
                    {{-- Logo Ditjenpas Mobile --}}
                    <div class="w-20 h-20 flex items-center justify-center">
                        <img src="{{ asset('images/logo_ditjenpas.png') }}" 
                             alt="Logo Ditjenpas" 
                             class="w-full h-full object-contain logo-glow">
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-midnight tracking-wide mb-1">SISTEM PERKANTORAN</h2>
                <p class="text-xs font-semibold text-gold uppercase tracking-[0.2em]">Kanwil Kemenimipas DIY</p>
            </div>

            {{-- Login Card --}}
            <div class="w-full max-w-md relative z-20">
                <div class="login-card rounded-3xl p-8">
                    
                    {{-- Card Header --}}
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center gap-2 bg-midnight/5 text-midnight px-4 py-2 rounded-full mb-4 text-xs font-bold tracking-wider border border-midnight/10">
                            <i class="fas fa-user-shield"></i>
                            AKSES TERBATAS ADMINISTRATOR
                        </div>
                        
                        <h2 class="text-2xl font-bold text-midnight mb-2">
                            <i class="fas fa-sign-in-alt text-gold mr-2"></i>
                            MASUK SISTEM
                        </h2>
                        <p class="text-gray-600 text-sm">
                            Silakan masuk dengan kredensial resmi Anda
                        </p>
                    </div>
                    
                    {{-- Flash Messages --}}
                    @if(session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                            <span class="text-green-800 font-medium">{{ session('status') }}</span>
                        </div>
                    </div>
                    @endif
                    
                    @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div>
                                <p class="text-red-800 font-medium">Gagal Masuk</p>
                                <p class="text-red-600 text-sm mt-1">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    {{-- Login Form --}}
                    <form method="POST" action="{{ route('login.submit') }}" id="loginForm" class="space-y-6">
                        @csrf
                        
                        {{-- Email Field --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1">
                                <i class="fas fa-envelope mr-2"></i>EMAIL DINAS
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-tie text-gray-400"></i>
                                </div>
                                <input type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autofocus
                                       placeholder="user@kemenimipas.go.id"
                                       class="login-input pl-10 pr-4 py-3.5 w-full rounded-xl text-gray-800 focus:outline-none">
                            </div>
                        </div>
                        
                        {{-- Password Field --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">
                                    <i class="fas fa-key mr-2"></i>KATA SANDI
                                </label>
                                <button type="button" 
                                        id="togglePassword" 
                                        class="text-xs text-gray-500 hover:text-midnight transition-colors">
                                    <i class="fas fa-eye mr-1"></i>
                                    <span>Tampilkan</span>
                                </button>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       required
                                       placeholder="••••••••"
                                       class="login-input pl-10 pr-12 py-3.5 w-full rounded-xl text-gray-800 focus:outline-none">
                            </div>
                        </div>
                        
                        {{-- Remember Me --}}
                        <div class="flex items-center justify-between">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       name="remember" 
                                       class="w-4 h-4 text-midnight border-gray-300 rounded focus:ring-midnight">
                                <span class="ml-2 text-sm text-gray-700">
                                    Ingat perangkat ini
                                </span>
                            </label>
                            
                            <a href="#" class="text-sm text-gray-600 hover:text-midnight font-medium transition-colors">
                                <i class="fas fa-question-circle mr-1"></i>
                                Lupa sandi?
                            </a>
                        </div>
                        
                        {{-- Submit Button --}}
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-midnight to-midnight/90 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 group">
                            <div class="flex items-center justify-center gap-3">
                                <span class="text-sm tracking-wider">MASUK KE DASHBOARD</span>
                                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </button>
                        
                        {{-- Divider --}}
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white text-gray-500">ATAU AKSES MELALUI</span>
                            </div>
                        </div>
                        
                        {{-- Alternative Login --}}
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" 
                                    class="p-3 rounded-xl border border-gray-200 bg-white hover:border-gold hover:bg-gold/5 transition-all duration-300 flex items-center justify-center gap-2 group">
                                <i class="fab fa-microsoft text-blue-600 text-lg group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-midnight">Office 365</span>
                            </button>
                            <button type="button" 
                                    class="p-3 rounded-xl border border-gray-200 bg-white hover:border-gold hover:bg-gold/5 transition-all duration-300 flex items-center justify-center gap-2 group">
                                <i class="fas fa-fingerprint text-green-600 text-lg group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-midnight">SSO Pemerintah</span>
                            </button>
                        </div>
                    </form>
                    
                    {{-- Support Info --}}
                    <div class="mt-8 text-center">
                        <div class="inline-flex items-center gap-4 text-sm text-gray-600">
                            <a href="#" class="hover:text-midnight transition-colors flex items-center gap-1">
                                <i class="fas fa-headset"></i>
                                <span>Bantuan</span>
                            </a>
                            <span class="text-gray-300">•</span>
                            <a href="#" class="hover:text-midnight transition-colors flex items-center gap-1">
                                <i class="fas fa-file-alt"></i>
                                <span>Panduan</span>
                            </a>
                            <span class="text-gray-300">•</span>
                            <a href="tel:0274512345" class="hover:text-midnight transition-colors flex items-center gap-1">
                                <i class="fas fa-phone-alt"></i>
                                <span>(0274) 512345</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                {{-- Footer --}}
                <div class="mt-6 text-center">
                    <div class="w-16 h-px bg-gradient-to-r from-transparent via-slate-300 to-transparent mx-auto mb-2"></div>
                    <p class="text-xs text-gray-500">
                        <i class="fas fa-copyright mr-1"></i>
                        {{ date('Y') }} Kanwil Kemenimipas DIY
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        Status: <span class="text-green-600 font-medium">
                            <i class="fas fa-circle text-xs mr-1"></i>Sistem Aktif
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.type === 'password' ? 'text' : 'password';
                    passwordInput.type = type;
                    const icon = this.querySelector('i');
                    const text = this.querySelector('span');
                    
                    if (type === 'text') {
                        icon.className = 'fas fa-eye-slash mr-1';
                        text.textContent = 'Sembunyikan';
                    } else {
                        icon.className = 'fas fa-eye mr-1';
                        text.textContent = 'Tampilkan';
                    }
                });
            }
            
            // Form submission
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function() {
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.innerHTML = `
                            <div class="flex items-center justify-center gap-2">
                                <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                                <span>MEMPROSES...</span>
                            </div>
                        `;
                    }
                });
            }
            
            // Auto-focus email
            const emailInput = document.querySelector('input[name="email"]');
            if (emailInput) {
                emailInput.focus();
            }
        });
    </script>
</body>
</html>