<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Kas Kecil APP &mdash; @yield('title', 'Dashboard')</title>

    <link href="{{ asset('assets/sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @stack('after-style')

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        :root {
            --blue:      #0053C5;
            --blue-dark: #003d91;
            --blue-50:   #eff6ff;
            --blue-100:  #dbeafe;
            --white:     #ffffff;
            --gray-50:   #f9fafb;
            --gray-100:  #f3f4f6;
            --gray-200:  #e5e7eb;
            --gray-400:  #9ca3af;
            --gray-500:  #6b7280;
            --gray-600:  #4b5563;
            --gray-700:  #374151;
            --gray-900:  #111827;
            --sidebar-w: 260px;
            --topbar-h:  64px;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--gray-50);
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }

        /* ═══════════════════════════════
           SIDEBAR
        ═══════════════════════════════ */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-w);
            background: var(--white);
            border-right: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            z-index: 1040;
            transition: width 0.28s cubic-bezier(0.4,0,0.2,1), transform 0.28s cubic-bezier(0.4,0,0.2,1);
            overflow: hidden;
        }

        /* Collapsed desktop */
        body.sidebar-collapsed .sidebar { width: 72px; }
        body.sidebar-collapsed .sidebar .section-label,
        body.sidebar-collapsed .sidebar .sub-menu,
        body.sidebar-collapsed .sidebar .user-info,
        body.sidebar-collapsed .sidebar .user-logout-btn { display: none !important; }

        /* Mobile hidden */
        @media (max-width: 767px) {
            .sidebar { transform: translateX(-100%); width: var(--sidebar-w) !important; }
            body.sidebar-open .sidebar { transform: translateX(0); }
        }

        /* ── Brand ── */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 19px;
            height: var(--topbar-h);
            border-bottom: 1px solid var(--gray-100);
            flex-shrink: 0;
            text-decoration: none;
            overflow: hidden;
            white-space: nowrap;
        }

        .sidebar-brand .logo-img {
            width: 34px;
            height: 34px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .brand-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--blue);
            letter-spacing: -0.3px;
            white-space: nowrap;
        }

        /* ── Nav ── */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 12px 10px 20px;
            scrollbar-width: thin;
            scrollbar-color: var(--gray-200) transparent;
        }
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }

        .section-label {
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            color: var(--gray-400);
            padding: 16px 12px 6px;
            display: block;
        }

        .nav-item { margin-bottom: 2px; }

        .nav-item-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 8px;
            color: var(--gray-600);
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
            user-select: none;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            overflow: hidden;
            white-space: nowrap;
        }

        .nav-item-link:hover {
            background: var(--gray-50);
            color: var(--blue);
        }

        .nav-item-link.active {
            background: var(--blue-50);
            color: var(--blue);
            font-weight: 600;
        }

        .nav-item-link.active .nav-icon { color: var(--blue); }

        .nav-icon {
            width: 24px;
            text-align: center;
            font-size: 15px;
            color: var(--gray-400);
            flex-shrink: 0;
            transition: color 0.15s;
        }

        .nav-item-link:hover .nav-icon { color: var(--blue); }

        .nav-text { flex: 1; white-space: nowrap; }

        .nav-arrow {
            font-size: 11px;
            color: var(--gray-400);
            transition: transform 0.2s;
            flex-shrink: 0;
        }

        .nav-arrow.open { transform: rotate(90deg); }

        /* Sub menu */
        .sub-menu {
            list-style: none;
            margin: 2px 0 2px 28px;
            padding: 0;
            overflow: hidden;
        }

        .sub-menu .sub-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 7px;
            color: var(--gray-500);
            font-size: 13px;
            font-weight: 400;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            margin-bottom: 1px;
        }

        .sub-menu .sub-item::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--gray-300);
            flex-shrink: 0;
            transition: background 0.15s;
        }

        .sub-menu .sub-item:hover { background: var(--gray-50); color: var(--blue); }
        .sub-menu .sub-item:hover::before { background: var(--blue); }
        .sub-menu .sub-item.active { color: var(--blue); font-weight: 600; background: var(--blue-50); }
        .sub-menu .sub-item.active::before { background: var(--blue); }

        /* ── Sidebar Footer (user card) ── */
        .sidebar-footer {
            flex-shrink: 0;
            border-top: 1px solid var(--gray-100);
            padding: 12px 14px;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 4px;
            border-radius: 10px;
            text-decoration: none;
            transition: background 0.15s;
            cursor: pointer;
            overflow: hidden;
            white-space: nowrap;
        }
        .user-card:hover { background: var(--gray-50); }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            border: 2px solid var(--gray-100);
        }

        .user-info { flex: 1; min-width: 0; }
        .user-info .u-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-800);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-info .u-role {
            font-size: 11px;
            color: var(--gray-400);
        }

        .user-logout-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--gray-400);
            font-size: 14px;
            padding: 4px;
            border-radius: 6px;
            transition: color 0.15s, background 0.15s;
        }
        .user-logout-btn:hover { color: #ef4444; background: #fef2f2; }

        /* ═══════════════════════════════
           TOPBAR
        ═══════════════════════════════ */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: var(--white);
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            padding: 0 24px;
            z-index: 1030;
            gap: 12px;
            transition: left 0.28s cubic-bezier(0.4,0,0.2,1);
        }

        body.sidebar-collapsed .topbar { left: 72px; }

        @media (max-width: 767px) {
            .topbar { left: 0 !important; }
        }

        /* Hamburger */
        .hamburger {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            background: none;
            cursor: pointer;
            color: var(--gray-500);
            font-size: 18px;
            flex-shrink: 0;
            transition: background 0.15s, color 0.15s;
        }
        .hamburger:hover { background: var(--gray-100); color: var(--blue); }

        /* Page title */
        .page-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--gray-800);
            flex: 1;
        }

        /* Topbar right */
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .topbar-avatar-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 10px;
            transition: background 0.15s;
        }
        .topbar-avatar-btn:hover { background: var(--gray-50); }

        .topbar-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gray-100);
        }

        .topbar-uname {
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-700);
            white-space: nowrap;
        }

        /* ═══════════════════════════════
           MAIN CONTENT
        ═══════════════════════════════ */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            padding-top: var(--topbar-h);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.28s cubic-bezier(0.4,0,0.2,1);
        }

        body.sidebar-collapsed .main-wrapper { margin-left: 72px; }

        @media (max-width: 767px) {
            .main-wrapper { margin-left: 0 !important; }
        }

        .content-area {
            flex: 1;
            padding: 24px;
        }

        /* ── Footer ── */
        .main-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--gray-100);
            font-size: 12px;
            color: var(--gray-400);
            background: var(--white);
            text-align: center;
        }

        /* ═══════════════════════════════
           OVERLAY (mobile)
        ═══════════════════════════════ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.35);
            z-index: 1039;
            backdrop-filter: blur(2px);
        }
        body.sidebar-open .sidebar-overlay { display: block; }

        /* ═══════════════════════════════
           DROPDOWN topbar
        ═══════════════════════════════ */
        .topbar-dropdown {
            position: relative;
        }

        .topbar-dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 180px;
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            z-index: 2000;
        }

        .topbar-dropdown.open .topbar-dropdown-menu { display: block; }

        .topbar-dropdown-menu a,
        .topbar-dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            font-size: 13px;
            color: var(--gray-700);
            text-decoration: none;
            background: none;
            border: none;
            width: 100%;
            cursor: pointer;
            transition: background 0.15s;
        }

        .topbar-dropdown-menu a:hover,
        .topbar-dropdown-menu button:hover { background: var(--gray-50); }
        .topbar-dropdown-menu .danger { color: #ef4444; }
        .topbar-dropdown-menu .danger:hover { background: #fef2f2; }

        /* Global overrides */
        .btn-primary { background-color: var(--blue) !important; border-color: var(--blue) !important; }
        .btn-primary:hover { background-color: var(--blue-dark) !important; border-color: var(--blue-dark) !important; }
        a { text-decoration: none; }
    </style>
</head>

<body>

    <!-- ═══ SIDEBAR OVERLAY (mobile) ═══ -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ═══ SIDEBAR ═══ -->
    <aside class="sidebar" id="sidebar">

        <!-- Brand -->
        <a href="/panel/beranda" class="sidebar-brand">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logo-img">
            <span class="brand-name">Kas Kecil App</span>
        </a>

        <!-- Nav -->
        <nav class="sidebar-nav">

            <!-- Dashboard -->
            <div class="nav-item">
                <a href="/panel/beranda"
                   class="nav-item-link {{ request()->is('panel/beranda') ? 'active' : '' }}"
                   title="Dashboard">
                    <i class="fas fa-home nav-icon"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </div>

            <span class="section-label">Master Data</span>

            <!-- Master Data -->
            <div class="nav-item" id="nav-master">
                <button type="button"
                    class="nav-item-link {{ request()->is(['master/aas','master/matanggaran']) ? 'active' : '' }}"
                    onclick="toggleSubMenu('sub-master','arrow-master')"
                    title="Master Data">
                    <i class="fas fa-database nav-icon"></i>
                    <span class="nav-text">Master Data</span>
                    <i class="fas fa-chevron-right nav-arrow {{ request()->is(['master/aas','master/matanggaran']) ? 'open' : '' }}" id="arrow-master"></i>
                </button>
                <ul class="sub-menu" id="sub-master"
                    style="{{ request()->is(['master/aas','master/matanggaran']) ? '' : 'display:none' }}">
                    <li>
                        <a href="/master/aas"
                           class="sub-item {{ request()->is('master/aas') ? 'active' : '' }}">
                            Akun Data AAS
                        </a>
                    </li>
                    <li>
                        <a href="/master/matanggaran"
                           class="sub-item {{ request()->is('master/matanggaran') ? 'active' : '' }}">
                            Akun Mata Anggaran
                        </a>
                    </li>
                </ul>
            </div>

            <span class="section-label">Transaksi</span>

            <!-- Transaksi -->
            <div class="nav-item">
                <button type="button"
                    class="nav-item-link {{ request()->is(['transaksi*']) ? 'active' : '' }}"
                    onclick="toggleSubMenu('sub-transaksi','arrow-transaksi')"
                    title="Transaksi">
                    <i class="fas fa-exchange-alt nav-icon"></i>
                    <span class="nav-text">Transaksi</span>
                    <i class="fas fa-chevron-right nav-arrow {{ request()->is(['transaksi*']) ? 'open' : '' }}" id="arrow-transaksi"></i>
                </button>
                <ul class="sub-menu" id="sub-transaksi"
                    style="{{ request()->is(['transaksi*']) ? '' : 'display:none' }}">
                    <li>
                        <a href="/transaksi/pembentukan"
                           class="sub-item {{ request()->is('transaksi/pembentukan') ? 'active' : '' }}">
                            Pembentukan Kas
                        </a>
                    </li>
                    <li>
                        <a href="/transaksi/pengeluaran"
                           class="sub-item {{ request()->is('transaksi/pengeluaran') ? 'active' : '' }}">
                            Pengeluaran Kas
                        </a>
                    </li>
                    <li>
                        <a href="/transaksi/pengisian"
                           class="sub-item {{ request()->is('transaksi/pengisian') ? 'active' : '' }}">
                            Pengisian Kas
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Laporan -->
            <div class="nav-item">
                <a href="/laporan"
                   class="nav-item-link {{ request()->is('laporan') ? 'active' : '' }}"
                   title="Laporan">
                    <i class="fas fa-file-alt nav-icon"></i>
                    <span class="nav-text">Laporan</span>
                </a>
            </div>

            <span class="section-label">Pengaturan</span>

            <!-- Pengguna -->
            <div class="nav-item">
                <a href="/users"
                   class="nav-item-link {{ request()->is('users') ? 'active' : '' }}"
                   title="Pengguna">
                    <i class="fas fa-users nav-icon"></i>
                    <span class="nav-text">Pengguna</span>
                </a>
            </div>

            <!-- Instansi -->
            <div class="nav-item">
                <a href="/instansi"
                   class="nav-item-link {{ request()->is('instansi') ? 'active' : '' }}"
                   title="Instansi">
                    <i class="fas fa-building nav-icon"></i>
                    <span class="nav-text">Instansi</span>
                </a>
            </div>

        </nav>

        <!-- User Card Footer -->
        <div class="sidebar-footer">
            <div class="user-card">
                @if(Auth::user()->foto)
                    <img src="{{ asset('uploads/users/' . Auth::user()->foto) }}" alt="Avatar" class="user-avatar">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0053C5&color=fff&size=80" alt="Avatar" class="user-avatar">
                @endif
                <div class="user-info">
                    <div class="u-name">{{ Auth::user()->name }}</div>
                    <div class="u-role">Administrator</div>
                </div>
                <button class="user-logout-btn" data-toggle="modal" data-target="#logoutModal" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>

    </aside>

    <!-- ═══ TOPBAR ═══ -->
    <header class="topbar" id="topbar">

        <!-- Hamburger -->
        <button class="hamburger" id="hamburger" aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Page title -->
        <div class="page-title">@yield('header-title', 'Dashboard')</div>

        <!-- Right: User dropdown -->
        <div class="topbar-right">
            <div class="topbar-dropdown" id="topbarDropdown">
                <button class="topbar-avatar-btn" onclick="toggleTopbarDropdown()">
                    @if(Auth::user()->foto)
                        <img src="{{ asset('uploads/users/' . Auth::user()->foto) }}" alt="Avatar" class="topbar-avatar">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0053C5&color=fff&size=80" alt="Avatar" class="topbar-avatar">
                    @endif
                    <span class="topbar-uname d-none d-sm-inline">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down" style="font-size:11px; color:#9ca3af;"></i>
                </button>
                <div class="topbar-dropdown-menu">
                    <button class="danger" data-toggle="modal" data-target="#logoutModal" onclick="closeTopbarDropdown()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </div>
        </div>

    </header>

    <!-- ═══ MAIN CONTENT ═══ -->
    <div class="main-wrapper" id="mainWrapper">
        <div class="content-area">
            @yield('content')
        </div>
        <footer class="main-footer">
            Copyright &copy; Masjid Agung Al Azhar &mdash; Kas Kecil App V.2.0 &mdash; DalArmy 2024
        </footer>
    </div>

    <!-- ═══ LOGOUT MODAL ═══ -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius:16px; border:none; overflow:hidden;">
                <div class="modal-header" style="border-bottom:1px solid #f3f4f6; padding:20px 24px;">
                    <h5 class="modal-title" style="font-size:15px; font-weight:600; color:#111827;">Konfirmasi Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding:20px 24px; font-size:14px; color:#4b5563;">
                    Apakah Anda yakin ingin keluar dari aplikasi?
                </div>
                <div class="modal-footer" style="border-top:1px solid #f3f4f6; padding:16px 24px; gap:8px;">
                    <button type="button" data-dismiss="modal"
                        style="padding:8px 20px; border-radius:8px; border:1.5px solid #e5e7eb; background:white; font-size:13px; font-weight:500; color:#374151; cursor:pointer;">
                        Batal
                    </button>
                    <a href="/proseslogout"
                        style="padding:8px 20px; border-radius:8px; background:#0053C5; color:white; font-size:13px; font-weight:500; text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                        <i class="fas fa-sign-out-alt"></i> Ya, Keluar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/lib/jquery.mask.min.js') }}"></script>
    @stack('after-script')
    @include('sweetalert::alert')

    <script>
        var isMobile = function () { return window.innerWidth < 768; };

        // ── Hamburger toggle ──
        document.getElementById('hamburger').addEventListener('click', function () {
            if (isMobile()) {
                document.body.classList.toggle('sidebar-open');
            } else {
                document.body.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', document.body.classList.contains('sidebar-collapsed'));
            }
        });

        // ── Close on overlay click (mobile) ──
        document.getElementById('sidebarOverlay').addEventListener('click', function () {
            document.body.classList.remove('sidebar-open');
        });

        // ── Restore desktop state ──
        if (!isMobile() && localStorage.getItem('sidebarCollapsed') === 'true') {
            document.body.classList.add('sidebar-collapsed');
        }

        // ── Sub menu toggle ──
        function toggleSubMenu(menuId, arrowId) {
            // Jika sidebar sedang dalam mode collapsed, maka expand sidebar terlebih dahulu
            if (document.body.classList.contains('sidebar-collapsed')) {
                document.body.classList.remove('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', 'false');
                
                // Paksa menu yang diklik langsung terbuka
                var menu  = document.getElementById(menuId);
                var arrow = document.getElementById(arrowId);
                if (menu) menu.style.display = 'block';
                if (arrow) arrow.classList.add('open');
                return;
            }

            var menu  = document.getElementById(menuId);
            var arrow = document.getElementById(arrowId);
            if (!menu) return;
            var isOpen = menu.style.display !== 'none' && menu.style.display !== '';
            menu.style.display  = isOpen ? 'none' : 'block';
            if (arrow) arrow.classList.toggle('open', !isOpen);
        }

        // ── Topbar dropdown ──
        function toggleTopbarDropdown() {
            document.getElementById('topbarDropdown').classList.toggle('open');
        }
        function closeTopbarDropdown() {
            document.getElementById('topbarDropdown').classList.remove('open');
        }
        document.addEventListener('click', function (e) {
            var dd = document.getElementById('topbarDropdown');
            if (dd && !dd.contains(e.target)) dd.classList.remove('open');
        });
    </script>
</body>
</html>
