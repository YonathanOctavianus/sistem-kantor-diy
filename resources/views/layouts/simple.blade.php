<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - KANWIL KEMENIMIPAS DIY</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --midnight-blue: #07213D;
            --gold-dignity: #EEBF63;
            --platinum-light: #F5F6F7;
            --sidebar-width: 260px;
            --transition-speed: 0.4s; /* Lebih smooth */
        }

        body {
            font-family: 'Titillium Web', sans-serif;
            background-color: var(--platinum-light);
            overflow-x: hidden;
        }

        /* === 1. SIDEBAR CONFIG === */
        #sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--midnight-blue) 0%, #0a2b4d 100%);
            color: white;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            left: 0;
            top: 0;
            border-right: 1px solid rgba(0,0,0,0.1);
            transition: all var(--transition-speed) cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 5px 0 15px rgba(0,0,0,0.05);
        }

        /* Saat Tertutup */
        #sidebar.active {
            margin-left: calc(var(--sidebar-width) * -1);
        }

        /* === 2. FLOATING TOGGLE BUTTON (BINTANG UTAMA) === */
        #floating-toggle {
            position: fixed;
            left: 245px; /* Sidebar (260) - Setengah Tombol (15) */
            top: 50%; /* Tepat di tengah vertikal */
            transform: translateY(-50%);
            width: 32px;
            height: 32px;
            background: white;
            border: 2px solid var(--gold-dignity);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1001; /* Di atas sidebar */
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            color: var(--midnight-blue);
            transition: all var(--transition-speed) cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        #floating-toggle:hover {
            box-shadow: 0 0 15px rgba(238, 191, 99, 0.6);
            transform: translateY(-50%) scale(1.1);
        }

        #floating-toggle i {
            font-size: 0.8rem;
            transition: transform var(--transition-speed);
        }

        /* Posisi Tombol saat Sidebar Tutup */
        body.sidebar-closed #floating-toggle {
            left: -10px; /* Sembunyi sedikit */
            padding-left: 10px; /* Biar ikon agak ke kanan */
        }
        
        body.sidebar-closed #floating-toggle:hover {
            left: 10px; /* Muncul saat di-hover */
        }

        /* Putar Panah saat Tutup */
        body.sidebar-closed #floating-toggle i {
            transform: rotate(180deg);
        }

        /* === 3. MENU ITEMS === */
        .sidebar-header {
            padding: 2rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .nav-menu { padding: 1.5rem 1rem; }
        .nav-link {
            padding: 12px 15px;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: all 0.3s;
            font-weight: 400;
            white-space: nowrap;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid var(--gold-dignity);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .nav-link i { width: 25px; text-align: center; color: var(--gold-dignity); }

        /* === 4. CONTENT WRAPPER === */
        #content {
            width: 100%;
            margin-left: var(--sidebar-width);
            transition: all var(--transition-speed) cubic-bezier(0.25, 0.8, 0.25, 1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Saat Sidebar Tutup, Konten Full Width */
        #content.active {
            margin-left: 0;
        }

        /* === 5. TOP NAVBAR === */
        .top-navbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        /* === MOBILE RESPONSIVE === */
        @media (max-width: 992px) {
            #floating-toggle { display: none; } /* Sembunyikan floating button di HP/Tablet */
            
            #sidebar { margin-left: calc(var(--sidebar-width) * -1); }
            #sidebar.active { margin-left: 0; }
            
            #content { margin-left: 0; }
            
            /* Munculkan Hamburger Menu di Navbar (Hanya Mobile) */
            .mobile-toggle { display: block !important; }
            
            .overlay {
                display: none;
                position: fixed; width: 100vw; height: 100vh;
                background: rgba(0,0,0,0.5); z-index: 998;
                top: 0; left: 0; opacity: 0; transition: 0.3s;
            }
            .overlay.active { display: block; opacity: 1; }
        }

        /* Default Hamburger sembunyi di Desktop */
        .mobile-toggle { display: none; font-size: 1.5rem; color: var(--midnight-blue); background: none; border: none; }

        /* Styles Tambahan */
        .user-avatar {
            width: 40px; height: 40px;
            background: var(--midnight-blue);
            color: white;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold;
            border: 2px solid var(--gold-dignity);
            box-shadow: 0 2px 10px rgba(7, 33, 61, 0.2);
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="overlay"></div>

    <div id="floating-toggle" title="Geser Sidebar">
        <i class="fas fa-chevron-left"></i>
    </div>

    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <i class="fas fa-landmark"></i> 
                <span>KANWIL DIY</span>
            </a>
            <small class="text-white-50 d-block mt-2">Sistem Perkantoran Terpadu</small>
        </div>

        <div class="nav-menu">
            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active @endif">
                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
            </a>
            
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('fasilitas.admin') }}" class="nav-link @if(request()->routeIs('fasilitas.admin')) active @endif">
                    <i class="fas fa-building-user"></i> <span>Kelola Fasilitas</span>
                </a>
            @else
                <a href="{{ route('fasilitas.user') }}" class="nav-link @if(request()->routeIs('fasilitas.user')) active @endif">
                    <i class="fas fa-building"></i> <span>Fasilitas Umum</span>
                </a>
            @endif

            <a href="#" class="nav-link"><i class="fas fa-pencil-alt"></i> <span>Inventaris ATK</span></a>
            <a href="#" class="nav-link"><i class="fas fa-tools"></i> <span>Lapor Kerusakan</span></a>
            <a href="{{ route('profile') }}" class="nav-link"><i class="fas fa-user-cog"></i> <span>Profil Saya</span></a>

            <div style="margin-top: 3rem; padding-top: 1rem; border-top: 1px dashed rgba(255,255,255,0.2);">
                <a href="{{ route('logout') }}" class="nav-link text-danger fw-bold" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> <span>Keluar Sistem</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>
    </nav>

    <div id="content">
        <nav class="top-navbar">
            <div class="d-flex align-items-center gap-3">
                <button type="button" class="mobile-toggle" id="mobileCollapse">
                    <i class="fas fa-bars"></i>
                </button>
                
                <h4 class="m-0 fw-bold" style="color: var(--midnight-blue); font-size: 1.25rem;">
                    @yield('title')
                </h4>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                    <span class="badge bg-warning text-dark" style="font-size: 0.7rem;">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </nav>

        <div class="p-4" style="flex: 1;">
            @yield('content')
        </div>

        <footer class="text-center py-4 text-muted small border-top bg-white">
            &copy; 2025 Kanwil Kementerian Imigrasi & Pemasyarakatan D.I. Yogyakarta.<br>
            Developed with <i class="fas fa-heart text-danger"></i> for Excellence.
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function () {
            // === 1. LOGIKA FLOATING BUTTON (DESKTOP) ===
            $('#floating-toggle').on('click', function () {
                $('body').toggleClass('sidebar-closed'); // Penanda untuk CSS Tombol
                $('#sidebar').toggleClass('active');     // Geser Sidebar
                $('#content').toggleClass('active');     // Lebarkan Konten
            });

            // === 2. LOGIKA HAMBURGER (MOBILE) ===
            $('#mobileCollapse, .overlay').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('.overlay').toggleClass('active');
            });

            // === 3. AUTO HIGHLIGHT MENU ===
            const currentPath = window.location.pathname;
            $('.nav-link').each(function() {
                const linkPath = $(this).attr('href');
                if (linkPath !== '#' && currentPath.includes(linkPath) && linkPath !== '{{ route('dashboard') }}') {
                    $(this).addClass('active');
                }
            });

            // Auto-dismiss alerts
            setTimeout(function() { $('.alert').alert('close'); }, 5000);
        });
    </script>
    @stack('scripts')
</body>
</html>