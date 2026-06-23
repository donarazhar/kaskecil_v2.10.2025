<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Kas Kecil APP</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0053C5;
            --primary-dark: #003d91;
            --sidebar-bg: linear-gradient(180deg, var(--primary-blue), var(--primary-dark));
            --sidebar-hover: rgba(255, 255, 255, 0.15);
            --sidebar-active: rgba(255, 255, 255, 0.25);
            --text-white: #ffffff;
        }

        /* ===== SIDEBAR UTAMA ===== */
        #accordionSidebar {
            background: var(--sidebar-bg);
            width: 260px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            border-right: none;
            color: var(--text-white);
            transition: width 0.3s ease, margin-left 0.3s ease;
        }

        /* Sidebar Collapsed State */
        #accordionSidebar.toggled {
            width: 80px;
            overflow-x: hidden;
        }

        #accordionSidebar.toggled .sidebar-brand-text {
            display: none;
        }

        #accordionSidebar.toggled .nav-link span {
            display: none;
        }

        #accordionSidebar.toggled .sidebar-heading {
            display: none;
        }

        #accordionSidebar.toggled .nav-link {
            justify-content: center;
            padding: 12px;
        }

        #accordionSidebar.toggled .nav-link i {
            margin-right: 0;
            font-size: 20px;
        }

        #accordionSidebar.toggled .sidebar-brand {
            padding: 20px 10px;
        }

        #accordionSidebar.toggled .sidebar-brand-icon {
            margin: 0;
        }

        /* Brand Section */
        .sidebar-brand {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            transition: all 0.3s ease;
        }

        .sidebar-brand-text {
            color: var(--text-white);
            transition: opacity 0.3s ease;
        }

        .sidebar-brand-icon i {
            color: var(--text-white);
        }

        /* Divider */
        .sidebar-divider {
            border-color: rgba(255, 255, 255, 0.2);
            margin: 12px 20px;
        }

        #accordionSidebar.toggled .sidebar-divider {
            margin: 12px 10px;
        }

        /* Sidebar Heading */
        .sidebar-heading {
            color: rgba(255, 255, 255, 0.6);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.8px;
            padding: 8px 20px;
            transition: opacity 0.3s ease;
        }

        /* Nav Item */
        .nav-item {
            margin: 4px 10px;
            position: relative;
        }

        .nav-link {
            color: var(--text-white);
            border-radius: 8px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link i {
            color: rgba(255, 255, 255, 0.8);
            width: 20px;
            margin-right: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .nav-link span {
            transition: opacity 0.3s ease;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--text-white);
            transform: translateX(2px);
        }

        .nav-link:hover i {
            color: var(--text-white);
        }

        .nav-item .nav-link.active {
            background: var(--sidebar-active);
            font-weight: 600;
            color: white;
        }

        .nav-item .nav-link.active i {
            color: white;
        }

        /* Tooltip untuk sidebar collapsed */
        #accordionSidebar.toggled .nav-link {
            position: relative;
        }

        #accordionSidebar.toggled .nav-link::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.9);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            margin-left: 10px;
            font-size: 13px;
            z-index: 1000;
        }

        #accordionSidebar.toggled .nav-link:hover::after {
            opacity: 1;
        }

        /* Collapse Menu */
        .collapse-inner {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            padding: 8px 0;
            margin: 6px 12px;
        }

        .collapse-header {
            color: rgba(255, 255, 255, 0.6);
            font-size: 11px;
            padding: 6px 16px;
        }

        .collapse-item {
            color: rgba(255, 255, 255, 0.9);
            padding: 8px 20px;
            display: block;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .collapse-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .collapse-item.active {
            background: var(--sidebar-active);
            color: white;
            font-weight: 600;
        }

        /* Hide collapse content when sidebar is toggled */
        #accordionSidebar.toggled .collapse {
            display: none !important;
        }

        /* Sidebar Toggle Button Styling */
        #sidebarToggle {
            background: rgba(255, 255, 255, 0.2) !important;
            width: 40px !important;
            height: 40px !important;
            border: 2px solid rgba(255, 255, 255, 0.3) !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            outline: none !important;
            z-index: 10 !important;
            pointer-events: auto !important;
            margin: 0 auto !important;
        }

        #sidebarToggle:hover {
            background: rgba(255, 255, 255, 0.3) !important;
            border-color: rgba(255, 255, 255, 0.5) !important;
            transform: scale(1.1) !important;
        }

        #sidebarToggle:active {
            background: rgba(255, 255, 255, 0.4) !important;
            transform: scale(0.95) !important;
        }

        #sidebarToggle:focus {
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2) !important;
        }

        #sidebarToggle::before {
            content: '\f104';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: white !important;
            font-size: 18px;
            transition: transform 0.3s ease;
            pointer-events: none;
        }

        #accordionSidebar.toggled #sidebarToggle::before {
            transform: rotate(180deg);
        }

        /* Pastikan container toggle terlihat dan di tengah */
        .text-center.d-none.d-md-inline {
            padding: 15px 0;
            z-index: 10;
            position: relative;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }

        /* Untuk mobile - sidebar muncul dari kiri */
        @media (max-width: 768px) {
            #accordionSidebar {
                position: fixed !important;
                left: -260px !important;
                top: 0 !important;
                height: 100vh !important;
                z-index: 9999 !important;
                transition: left 0.3s ease !important;
            }

            body.sidebar-toggled #accordionSidebar {
                left: 0 !important;
            }

            /* Overlay untuk mobile */
            body.sidebar-toggled::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 9998;
            }
        }

        /* Desktop Toggle Button in Topbar */
        .sidebar-toggle-desktop {
            background: transparent;
            border: none;
            font-size: 20px;
            color: #858796;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 4px;
            transition: all 0.3s ease;
            margin-right: 15px;
        }

        .sidebar-toggle-desktop:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #4e73df;
        }

        .sidebar-toggle-desktop:focus {
            outline: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #accordionSidebar {
                margin-left: 0;
                position: fixed;
                left: -260px;
                width: 260px !important;
                top: 0;
                height: 100vh;
                z-index: 9999;
                transition: left 0.3s ease;
            }

            /* Ketika toggle di mobile, sidebar muncul dari kiri */
            body.sidebar-toggled #accordionSidebar {
                left: 0;
            }

            /* Jangan collapse sidebar di mobile, hanya hide */
            #accordionSidebar.toggled {
                width: 260px !important;
            }

            #accordionSidebar.toggled .sidebar-brand-text,
            #accordionSidebar.toggled .nav-link span,
            #accordionSidebar.toggled .sidebar-heading {
                display: block !important;
            }

            #accordionSidebar.toggled .nav-link {
                justify-content: flex-start !important;
                padding: 10px 16px !important;
            }

            #accordionSidebar.toggled .nav-link i {
                margin-right: 12px !important;
                font-size: 16px !important;
            }
        }

        /* Content wrapper adjustment */
        #content-wrapper {
            transition: margin-left 0.3s ease;
        }

        /* Topbar styling */
        .topbar {
            transition: all 0.3s ease;
        }

        /* Alert & Button Styling */
        .btn-gradient-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
            color: white;
            border: none;
        }

        .btn-gradient-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-blue));
            color: white;
        }

        .btn-gradient-warning {
            background: linear-gradient(135deg, #f6c23e, #f4b619);
            color: white;
            border: none;
        }

        .btn-gradient-warning:hover {
            background: linear-gradient(135deg, #f4b619, #f6c23e);
            color: white;
        }

        /* Page Wrapper */
        #wrapper {
            display: flex;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-left justify-content-left" href="/">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="sidebar-brand-text mx-2">Kas Kecil APP</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/" data-tooltip="Dashboard">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <!-- Master Data -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is(['master/aas', 'master/matanggaran']) ? '' : 'collapsed' }}"
                    href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="{{ request()->is(['master/aas', 'master/matanggaran']) ? 'true' : 'false' }}"
                    aria-controls="collapseTwo" data-tooltip="Master Data">
                    <i class="fas fa-database"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseTwo"
                    class="collapse {{ request()->is(['master/aas', 'master/matanggaran']) ? 'show' : '' }}"
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Inputan</h6>
                        <a class="collapse-item {{ request()->is('master/aas') ? 'active' : '' }}"
                            href="/master/aas">Akun Data AAS</a>
                        <a class="collapse-item {{ request()->is('master/matanggaran') ? 'active' : '' }}"
                            href="/master/matanggaran">Akun Mata Anggaran</a>
                    </div>
                </div>
            </li>

            <!-- Transaksi -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is(['transaksi/pembentukan', 'transaksi/pengeluaran', 'transaksi/pengisian', 'transaksi']) ? '' : 'collapsed' }}"
                    href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="{{ request()->is(['transaksi/pembentukan', 'transaksi/pengeluaran', 'transaksi/pengisian', 'transaksi']) ? 'true' : 'false' }}"
                    aria-controls="collapseUtilities" data-tooltip="Transaksi">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseUtilities"
                    class="collapse {{ request()->is(['transaksi/pembentukan', 'transaksi/pengeluaran', 'transaksi/pengisian', 'transaksi']) ? 'show' : '' }}"
                    aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Transaksi</h6>
                        <a class="collapse-item {{ request()->is('transaksi/pembentukan') ? 'active' : '' }}"
                            href="/transaksi/pembentukan">Pembentukan Kas</a>
                        <a class="collapse-item {{ request()->is('transaksi/pengeluaran') ? 'active' : '' }}"
                            href="/transaksi/pengeluaran">Pengeluaran Kas</a>
                        <a class="collapse-item {{ request()->is('transaksi/pengisian') ? 'active' : '' }}"
                            href="/transaksi/pengisian">Pengisian Kas</a>
                    </div>
                </div>
            </li>

            <!-- Laporan -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('laporan') ? 'active' : '' }}" href="/laporan"
                    data-tooltip="Laporan">
                    <i class="fas fa-file-alt"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengaturan
            </div>

            <!-- Pengguna -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="/users"
                    data-tooltip="Pengguna">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span>
                </a>
            </li>

            <!-- Instansi -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('instansi') ? 'active' : '' }}" href="/instansi"
                    data-tooltip="Instansi">
                    <i class="fas fa-building"></i>
                    <span>Instansi</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggle Button -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) - Mobile & Desktop -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Desktop Sidebar Toggle (Visible on all screens) -->
                    <button class="sidebar-toggle-desktop d-none d-md-inline" id="sidebarToggleDesktop">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                @if(Auth::user()->foto)
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('uploads/users/' . Auth::user()->foto) }}" style="object-fit: cover;">
                                @else
                                    <img class="img-profile rounded-circle"
                                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff&size=60">
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Masjid Agung Al Azhar by DalArmy 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari aplikasi?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-gradient-warning" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="/proseslogout">Ya, Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages - DISABLED to prevent conflict -->
    <!-- <script src="{{ asset('assets/sbadmin/js/sb-admin-2.min.js') }}"></script> -->

    <!-- Additional Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/lib/jquery.mask.min.js') }}"></script>

    <script>
        // Enhanced Sidebar Toggle - Fixed Version for Mobile & Desktop
        (function($) {
            "use strict";

            // Check if mobile
            function isMobile() {
                return $(window).width() < 768;
            }

            // Function to toggle sidebar
            function toggleSidebar() {
                console.log('=== Toggle Sidebar Function Called ===');
                console.log('Is Mobile:', isMobile());

                if (isMobile()) {
                    // Mobile: hanya toggle visibility, tidak collapse
                    $("body").toggleClass("sidebar-toggled");
                    // Jangan tambahkan class 'toggled' ke sidebar di mobile
                    const isShown = $("body").hasClass("sidebar-toggled");
                    console.log('Mobile sidebar is now:', isShown ? 'SHOWN' : 'HIDDEN');

                    // Di mobile, pastikan collapse menu tetap bisa dibuka
                    if (isShown) {
                        // Sidebar ditampilkan, jangan hide collapse
                    } else {
                        // Sidebar disembunyikan, tutup semua collapse
                        $(".collapse").collapse('hide');
                    }
                } else {
                    // Desktop: toggle collapse sidebar
                    $("body").toggleClass("sidebar-toggled");
                    $("#accordionSidebar").toggleClass("toggled");

                    // Close all collapse menus when toggling to collapsed state
                    if ($("#accordionSidebar").hasClass("toggled")) {
                        $(".collapse").collapse('hide');
                    }

                    const isToggled = $("#accordionSidebar").hasClass("toggled");
                    console.log('Desktop sidebar is now:', isToggled ? 'COLLAPSED' : 'EXPANDED');
                }

                // Save state to localStorage (only for desktop)
                if (!isMobile()) {
                    const isToggled = $("#accordionSidebar").hasClass("toggled");
                    localStorage.setItem('sidebarToggled', isToggled);
                }
            }

            $(document).ready(function() {
                console.log('=== Sidebar Script Initialized ===');
                console.log('Window width:', $(window).width());
                console.log('Is Mobile:', isMobile());

                // Load saved sidebar state from localStorage (only for desktop)
                if (!isMobile() && localStorage.getItem('sidebarToggled') === 'true') {
                    $("body").addClass("sidebar-toggled");
                    $("#accordionSidebar").addClass("toggled");
                    $(".collapse").collapse('hide');
                    console.log('Loaded saved state: COLLAPSED');
                }

                // Di mobile, pastikan sidebar tersembunyi by default
                if (isMobile()) {
                    // Sidebar sudah tersembunyi dengan CSS (left: -260px)
                    // Tidak perlu addClass toggled
                    console.log('Mobile: Sidebar hidden by default');
                }

                // Debug: Check if buttons exist
                setTimeout(function() {
                    console.log('=== Button Check ===');
                    console.log('Bottom toggle button (#sidebarToggle):', $('#sidebarToggle').length);
                    console.log('Top mobile toggle (#sidebarToggleTop):', $('#sidebarToggleTop')
                    .length);
                    console.log('Desktop toggle (#sidebarToggleDesktop):', $('#sidebarToggleDesktop')
                        .length);
                }, 100);

                // Remove any existing click handlers first to prevent conflicts
                $('#sidebarToggle, #sidebarToggleTop, #sidebarToggleDesktop').off('click');

                // Method 1: Direct binding on specific button
                $('#sidebarToggle').on('click', function(e) {
                    console.log('>>> BOTTOM BUTTON CLICKED <<<');
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    toggleSidebar();
                    return false;
                });

                // Method 2: Event delegation for bottom button
                $(document).on('click', '#sidebarToggle', function(e) {
                    console.log('>>> BOTTOM BUTTON CLICKED (delegation) <<<');
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    toggleSidebar();
                    return false;
                });

                // Top mobile toggle
                $('#sidebarToggleTop').on('click', function(e) {
                    console.log('>>> TOP MOBILE BUTTON CLICKED <<<');
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    toggleSidebar();
                    return false;
                });

                // Desktop toggle (hamburger in topbar)
                $('#sidebarToggleDesktop').on('click', function(e) {
                    console.log('>>> DESKTOP BUTTON CLICKED <<<');
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    toggleSidebar();
                    return false;
                });

                // Prevent collapse menu opening when sidebar is toggled (ONLY on desktop)
                $(document).on('click', '#accordionSidebar.toggled .nav-link[data-toggle="collapse"]', function(
                    e) {
                    if (!isMobile() && $("#accordionSidebar").hasClass("toggled")) {
                        console.log('Desktop: Prevented collapse menu in toggled state');
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }
                });

                // Auto-close sidebar on mobile after clicking a NON-COLLAPSE link
                $(document).on('click', '.nav-link:not([data-toggle="collapse"])', function() {
                    if (isMobile() && $("body").hasClass("sidebar-toggled")) {
                        // Tutup sidebar setelah delay singkat
                        setTimeout(function() {
                            $("body").removeClass("sidebar-toggled");
                            console.log('Mobile: Auto-closed sidebar after link click');
                        }, 300);
                    }
                });

                // Click outside sidebar to close (mobile only)
                $(document).on('click', function(e) {
                    if (isMobile() && $("body").hasClass("sidebar-toggled")) {
                        // Jika klik di luar sidebar
                        if (!$(e.target).closest('#accordionSidebar, #sidebarToggleTop').length) {
                            $("body").removeClass("sidebar-toggled");
                            console.log('Mobile: Closed sidebar (clicked outside)');
                        }
                    }
                });

                // Handle window resize
                $(window).resize(function() {
                    console.log('Window resized to:', $(window).width());
                    if (isMobile()) {
                        // Reset ke mobile mode
                        $("body").removeClass("sidebar-toggled");
                        $("#accordionSidebar").removeClass("toggled");
                    } else {
                        // Load desktop saved state
                        if (localStorage.getItem('sidebarToggled') === 'true') {
                            $("body").addClass("sidebar-toggled");
                            $("#accordionSidebar").addClass("toggled");
                        } else {
                            $("body").removeClass("sidebar-toggled");
                            $("#accordionSidebar").removeClass("toggled");
                        }
                    }
                });

                // REMOVED: Auto-test toggle (uncomment if needed for debugging)
                /*
                setTimeout(function() {
                    $('#sidebarToggle').trigger('click');
                    console.log('=== Test Toggle Triggered ===');
                    setTimeout(function() {
                        $('#sidebarToggle').trigger('click');
                        console.log('=== Restored Original State ===');
                    }, 500);
                }, 1000);
                */
            });

        })(jQuery);
    </script>

    @stack('after-script')

</body>

</html>
