<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dashboard Kas Kecil - Masjid Agung Al Azhar">
    <meta name="author" content="Masjid Agung Al Azhar">
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon" />

    <title>@yield('title', 'Kas Kecil APP')</title>

    <!-- Fonts & Icons -->
    <link href="{{ asset('assets/sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Base CSS -->
    <link href="{{ asset('assets/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary: #0053C5;
            --primary-dark: #003d91;
            --primary-light: #e8f1ff;
            --white: #ffffff;
            --gray-50: #fafbfc;
            --gray-100: #f5f6f8;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-600: #6c757d;
            --gray-800: #343a40;
            --gray-900: #1a1d20;
            --shadow-sm: 0 2px 4px rgba(0, 83, 197, 0.06);
            --shadow-md: 0 4px 12px rgba(0, 83, 197, 0.08);
            --shadow-lg: 0 8px 24px rgba(0, 83, 197, 0.12);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            line-height: 1.6;
        }

        /* ===== NAVBAR ===== */
        .navbar-modern {
            background: var(--white) !important;
            border-bottom: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm);
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-brand-modern {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gray-900) !important;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand-modern:hover {
            color: var(--primary) !important;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            box-shadow: var(--shadow-sm);
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .brand-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .brand-subtitle {
            font-size: 0.688rem;
            font-weight: 500;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--gray-900);
        }

        .user-trigger:hover {
            background: var(--gray-100);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .user-trigger:hover .user-avatar {
            border-color: var(--primary);
            transform: scale(1.05);
        }

        .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .user-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-900);
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--gray-600);
        }

        .dropdown-menu-modern {
            border: none;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            padding: 0.5rem;
            min-width: 200px;
            margin-top: 0.5rem;
        }

        .dropdown-item-modern {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-sm);
            color: var(--gray-800);
            transition: all 0.2s ease;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .dropdown-item-modern:hover {
            background: var(--primary-light);
            color: var(--primary);
            transform: translateX(4px);
        }

        .dropdown-item-modern i {
            width: 20px;
            text-align: center;
            color: var(--gray-600);
        }

        .dropdown-item-modern:hover i {
            color: var(--primary);
        }

        /* ===== MAIN CONTENT ===== */
        #wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        #content {
            flex: 1;
        }

        /* ===== FOOTER ===== */
        .footer-modern {
            background: var(--white);
            border-top: 1px solid var(--gray-200);
            padding: 1.5rem 2rem;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            max-width: 1600px;
            margin: 0 auto;
        }

        .footer-text {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .footer-text strong {
            color: var(--primary);
            font-weight: 600;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-link {
            font-size: 0.875rem;
            color: var(--gray-600);
            text-decoration: none;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .footer-link:hover {
            color: var(--primary);
        }

        /* ===== MODAL ===== */
        .modal-modern .modal-content {
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .modal-modern .modal-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            padding: 1.5rem;
        }

        .modal-modern .modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .modal-modern .modal-body {
            padding: 2rem;
            font-size: 1rem;
            color: var(--gray-800);
        }

        .modal-modern .modal-footer {
            border: none;
            padding: 1rem 2rem 2rem;
            gap: 0.75rem;
        }

        .modal-modern .btn {
            padding: 0.625rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .modal-modern .btn-secondary {
            background: var(--gray-200);
            border: none;
            color: var(--gray-800);
        }

        .modal-modern .btn-secondary:hover {
            background: var(--gray-300);
        }

        .modal-modern .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            box-shadow: var(--shadow-sm);
        }

        .modal-modern .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .modal-modern .close {
            color: white;
            opacity: 0.9;
            text-shadow: none;
            font-size: 1.5rem;
        }

        .modal-modern .close:hover {
            opacity: 1;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-100);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .navbar-modern {
                padding: 0.75rem 1rem;
            }

            .brand-text {
                display: none;
            }

            .user-info {
                display: none;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-links {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand-modern {
                font-size: 1rem;
            }

            .brand-icon {
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }

            .user-avatar {
                width: 36px;
                height: 36px;
            }
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-menu-modern {
            animation: slideDown 0.3s ease;
        }

        /* ===== UTILITIES ===== */
        .text-primary-custom {
            color: var(--primary) !important;
        }

        .bg-primary-custom {
            background: var(--primary) !important;
        }

        .shadow-custom {
            box-shadow: var(--shadow-md) !important;
        }
    </style>

    @stack('after-style')
</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Modern Navbar -->
                <nav class="navbar navbar-expand navbar-light navbar-modern">
                    <a class="navbar-brand-modern" href="/">
                        <div class="brand-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="brand-text">
                            <span class="brand-title">Kas Kecil Metode Imprest</span>
                            <span class="brand-subtitle">Masjid Al Azhar</span>
                        </div>
                    </a>

                    <ul class="navbar-nav ml-auto align-items-center">
                        <li class="nav-item dropdown user-dropdown">
                            <a class="nav-link dropdown-toggle user-trigger" href="#" id="userDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="user-avatar" src="{{ asset('assets/sbadmin/img/login.png') }}" alt="User">
                                <div class="user-info">
                                    <span class="user-name">Guest</span>
                                    <span class="user-role">Visitor</span>
                                </div>
                                <i class="fas fa-chevron-down" style="font-size: 0.75rem; color: var(--gray-600);"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-modern" aria-labelledby="userDropdown">
                                <a class="dropdown-item-modern" href="/panel">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Login</span>
                                </a>
                                <a class="dropdown-item-modern" href="#" data-toggle="modal" data-target="#infoModal">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Informasi</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Navbar -->

                <!-- Main Content -->
                @yield('content')

            </div>

            <!-- Modern Footer -->
            <footer class="footer-modern">
                <div class="footer-content">
                    <div class="footer-text">
                        © {{ date('Y') }} Masjid Agung Al Azhar — Dibuat dengan <i class="fas fa-heart text-danger"></i> oleh <strong>Dal Army</strong>
                    </div>
                    <div class="footer-links">
                        <a href="#" class="footer-link">Tentang</a>
                        <a href="#" class="footer-link">Bantuan</a>
                        <a href="#" class="footer-link">Kontak</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade modal-modern" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-sign-out-alt"></i>
                        Konfirmasi Keluar
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Apakah Anda yakin ingin keluar dari aplikasi?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <a class="btn btn-primary" href="/proseslogout">
                        <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Modal -->
    <div class="modal fade modal-modern" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle"></i>
                        Informasi Aplikasi
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <div class="brand-icon mx-auto mb-3" style="width: 64px; height: 64px; font-size: 2rem;">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h5 class="font-weight-bold mb-2">Kas Kecil APP</h5>
                        <p class="text-muted mb-0">Sistem Manajemen Kas Kecil</p>
                        <p class="text-muted">Masjid Agung Al Azhar</p>
                    </div>
                    <hr>
                    <div class="small text-muted">
                        <p class="mb-2"><i class="fas fa-code mr-2 text-primary"></i>Version 2.0.0</p>
                        <p class="mb-0"><i class="fas fa-copyright mr-2 text-primary"></i>{{ date('Y') }} - Dal Army</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">
                        <i class="fas fa-check mr-2"></i>Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/lib/jquery.mask.min.js') }}"></script>

    <script>
        // Smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '#userDropdown') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Add active state to current page
        $(document).ready(function() {
            const currentPath = window.location.pathname;
            $('.footer-link').each(function() {
                if ($(this).attr('href') === currentPath) {
                    $(this).css('color', 'var(--primary)');
                }
            });
        });
    </script>

    @stack('after-script')
</body>

</html>