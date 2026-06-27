<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dashboard Al Azhar Petty Cash System (APCS) - Masjid Agung Al Azhar">
    <meta name="author" content="Masjid Agung Al Azhar">
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon" />

    <title>@yield('title', 'Beranda') - Al Azhar Petty Cash System</title>

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
            --radius-xl: 20px;
        }

        /* ── Global Pagination Style ── */
        .pagi, .pagi-wrap { padding: 24px 20px; border-top: 1px solid var(--gray-100); display: flex; justify-content: center; background: var(--white); border-radius: 0 0 14px 14px; }
        .pagi .pagination, .pagi-wrap .pagination { margin: 0; display: flex; gap: 6px; flex-wrap: wrap; justify-content: center; }
        .pagi .page-item:not(:first-child) .page-link, .pagi-wrap .page-item:not(:first-child) .page-link { margin-left: 0; }
        .pagi .page-item .page-link, .pagi-wrap .page-item .page-link { font-size: 13px; font-weight: 600; color: var(--gray-600); background: #fff; border: 1.5px solid var(--gray-200); border-radius: 8px !important; min-width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; padding: 0 10px; transition: all 0.2s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.02); text-decoration: none; }
        .pagi .page-item .page-link:hover, .pagi-wrap .page-item .page-link:hover { background: var(--gray-50); color: var(--primary); border-color: var(--gray-300); transform: translateY(-2px); box-shadow: 0 4px 6px rgba(0,0,0,0.04); }
        .pagi .page-item.active .page-link, .pagi-wrap .page-item.active .page-link { background: var(--primary); border-color: var(--primary); color: #fff; box-shadow: 0 4px 10px rgba(0,83,197,0.3); transform: translateY(-2px); }
        .pagi .page-item.disabled .page-link, .pagi-wrap .page-item.disabled .page-link { color: var(--gray-400); background: var(--gray-50); border-color: var(--gray-200); cursor: not-allowed; transform: none; box-shadow: none; pointer-events: none; }

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
            text-decoration: none !important;
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
                flex-direction: row;
                justify-content: center;
                flex-wrap: wrap;
                gap: 1rem;
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
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Masjid Al Azhar" style="width: 42px; height: 42px; object-fit: contain;">
                        <div class="brand-text" style="display: flex; flex-direction: column; align-items: flex-start; text-align: left; overflow: hidden;">
                            <span class="brand-title" style="font-size: 18px; font-weight: 800; line-height: 1; margin-bottom: 2px;">APCS</span>
                            <span class="brand-subtitle" style="text-transform: none; font-size: 10px; color: var(--gray-500); line-height: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Al Azhar Petty Cash System</span>
                            <span class="brand-subtitle" style="text-transform: none; font-size: 9px; color: var(--gray-400); line-height: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Metode Imprest</span>
                        </div>
                    </a>

                    <ul class="navbar-nav ml-auto align-items-center">
                        <li class="nav-item d-flex align-items-center">
                            <a class="btn btn-primary btn-sm" href="/panel" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border: none; border-radius: var(--radius-sm); font-weight: 600; padding: 0.4rem 1rem; box-shadow: var(--shadow-sm);">
                                <i class="fas fa-sign-in-alt mr-1"></i> Login
                            </a>
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
                        © 2023 Masjid Agung Al Azhar — Dibuat dengan <i class="fas fa-heart text-danger"></i> oleh <strong>Dal Army</strong>
                    </div>
                    <div class="footer-links">
                        <a href="#" class="footer-link" data-toggle="modal" data-target="#infoModal">Tentang</a>
                        <a href="#" class="footer-link" data-toggle="modal" data-target="#helpModal">Bantuan</a>
                        <a href="#" class="footer-link" data-toggle="modal" data-target="#contactModal">Kontak</a>
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
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle"></i>
                        Tentang Aplikasi
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="mx-auto mb-3" style="width: 64px; height: 64px; object-fit: contain; display: block;">
                        <h5 class="font-weight-bold mb-1">Al Azhar Petty Cash System (APCS)</h5>
                        <p class="text-muted font-italic mb-0">Sistem Pengelolaan Kas Kecil (Metode Imprest)</p>
                    </div>
                    
                    <h6 class="font-weight-bold text-primary mb-2">Pengertian Metode Imprest</h6>
                    <p class="text-justify mb-3" style="font-size: 0.95rem; line-height: 1.6; color: var(--gray-700);">
                        Metode Imprest (Dana Tetap) adalah sistem pengelolaan kas kecil di mana instansi/perusahaan menetapkan sejumlah dana kas kecil dengan nilai yang tetap dan tidak berubah. Pada awal periode, dana kas kecil dibentuk dengan mendebit akun Kas Kecil dan mengkredit Kas/Bank. Sepanjang periode, setiap pengeluaran kas kecil tidak langsung dicatat dalam jurnal. Sebaliknya, kasir kas kecil hanya mengumpulkan bukti-bukti transaksi, dan jumlah uang tunai yang tersisa ditambah dengan total bukti pengeluaran harus selalu sama dengan jumlah dana tetap awal.
                    </p>
                    <p class="text-justify mb-0" style="font-size: 0.95rem; line-height: 1.6; color: var(--gray-700);">
                        Pencatatan resmi ke jurnal baru dilakukan saat kas kecil akan diisi kembali. Jumlah pengisian kembali adalah sama persis dengan total pengeluaran yang telah dilakukan. Jurnal pengisian kembali dilakukan dengan mendebit akun-akun Beban yang relevan dan mengkredit akun Kas/Bank (Kas Besar). Tujuan metode ini adalah untuk menjaga saldo akun Kas Kecil di buku besar agar selalu berada pada jumlah tetap yang ditetapkan, sekaligus memberikan kontrol yang ketat karena semua pengeluaran harus dipertanggungjawabkan sebelum dana diisi ulang.
                    </p>
                    <hr class="mt-4 mb-3">
                    <div class="text-center small" style="color: var(--gray-500);">
                        <i class="fas fa-copyright mr-1 text-primary"></i> Dibuat tahun 2023 oleh <strong>DAL Army</strong>
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

    <!-- Help Modal -->
    <div class="modal fade modal-modern" id="helpModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-question-circle"></i>
                        Bantuan & Alur Penggunaan
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 75vh; overflow-y: auto; padding: 2rem 2.5rem;">
                    <div class="text-center mb-4">
                        <h5 class="font-weight-bold mb-1 text-primary">Panduan Penggunaan APCS</h5>
                        <p class="text-muted font-italic mb-0">Langkah-langkah alur sistem kas kecil (Metode Imprest)</p>
                    </div>
                    
                    <div class="workflow-steps" style="position: relative; padding-left: 24px; border-left: 2px solid var(--gray-200); margin-left: 10px;">
                        
                        <!-- Step 1 -->
                        <div style="position: relative; margin-bottom: 1.75rem;">
                            <div style="position: absolute; left: -33px; top: 2px; width: 16px; height: 16px; border-radius: 50%; background: var(--primary); border: 3px solid #fff; box-shadow: 0 0 0 1px var(--primary);"></div>
                            <h6 class="font-weight-bold mb-1 text-gray-900" style="font-size: 0.95rem;">1. Registrasi Akun Pengguna</h6>
                            <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.5;">Untuk menjaga keamanan sistem, pembuatan akun administrator atau petugas kasir tidak dapat dilakukan secara mandiri. Silakan menghubungi tim <strong>DAL Army</strong> untuk proses registrasi dan otorisasi akses Anda.</p>
                        </div>
                        
                        <!-- Step 2 -->
                        <div style="position: relative; margin-bottom: 1.75rem;">
                            <div style="position: absolute; left: -33px; top: 2px; width: 16px; height: 16px; border-radius: 50%; background: var(--primary); border: 3px solid #fff; box-shadow: 0 0 0 1px var(--primary);"></div>
                            <h6 class="font-weight-bold mb-1 text-gray-900" style="font-size: 0.95rem;">2. Konfigurasi Master Data</h6>
                            <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.5;">Sebelum mencatat transaksi, pastikan Anda telah melengkapi <strong>Master Data</strong>. Input seluruh <strong>Akun AAS</strong> dan <strong>Mata Anggaran</strong> yang berlaku di instansi Anda agar dapat dipilih saat penjurnalan pengeluaran.</p>
                        </div>
                        
                        <!-- Step 3 -->
                        <div style="position: relative; margin-bottom: 1.75rem;">
                            <div style="position: absolute; left: -33px; top: 2px; width: 16px; height: 16px; border-radius: 50%; background: var(--primary); border: 3px solid #fff; box-shadow: 0 0 0 1px var(--primary);"></div>
                            <h6 class="font-weight-bold mb-1 text-gray-900" style="font-size: 0.95rem;">3. Pembentukan Dana Awal</h6>
                            <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.5;">Masuk ke menu <strong>Pembentukan Kas Kecil</strong> untuk menentukan dan menginput jumlah uang awal yang menjadi batas saldo dana tetap <em>(Imprest Fund)</em> bagi keperluan operasional instansi Anda.</p>
                        </div>
                        
                        <!-- Step 4 -->
                        <div style="position: relative; margin-bottom: 1.75rem;">
                            <div style="position: absolute; left: -33px; top: 2px; width: 16px; height: 16px; border-radius: 50%; background: var(--primary); border: 3px solid #fff; box-shadow: 0 0 0 1px var(--primary);"></div>
                            <h6 class="font-weight-bold mb-1 text-gray-900" style="font-size: 0.95rem;">4. Pencatatan Transaksi Pengeluaran</h6>
                            <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.5;">Setiap kali terjadi pembayaran atau pengeluaran, catat rinciannya pada menu <strong>Pengeluaran Kas Kecil</strong>. Saldo tunai fisik Anda akan berkurang, namun saldo laporan tidak akan di-jurnal secara resmi sebelum dilakukan pengisian kembali.</p>
                        </div>
                        
                        <!-- Step 5 -->
                        <div style="position: relative; margin-bottom: 1.75rem;">
                            <div style="position: absolute; left: -33px; top: 2px; width: 16px; height: 16px; border-radius: 50%; background: var(--primary); border: 3px solid #fff; box-shadow: 0 0 0 1px var(--primary);"></div>
                            <h6 class="font-weight-bold mb-1 text-gray-900" style="font-size: 0.95rem;">5. Pengisian Kembali (Reimbursement)</h6>
                            <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.5;">Jika sisa dana fisik sudah menipis, ajukan pengisian ulang melalui menu <strong>Pengisian Kas Kecil</strong>. Sistem akan merekap pengeluaran Anda, dan jumlah yang diisi harus persis sama dengan total pengeluaran agar saldo kembali ke angka awal.</p>
                        </div>
                        
                        <!-- Step 6 -->
                        <div style="position: relative;">
                            <div style="position: absolute; left: -33px; top: 2px; width: 16px; height: 16px; border-radius: 50%; background: var(--primary); border: 3px solid #fff; box-shadow: 0 0 0 1px var(--primary);"></div>
                            <h6 class="font-weight-bold mb-1 text-gray-900" style="font-size: 0.95rem;">6. Cetak Laporan Bukti (Opsional)</h6>
                            <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.5;">Anda dapat mencetak riwayat pergerakan kas atau surat penggantian melalui menu <strong>Laporan</strong> sebagai bukti pertanggungjawaban fisik pada saat audit keuangan.</p>
                        </div>
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

    <!-- Contact Modal -->
    <div class="modal fade modal-modern" id="contactModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-address-book"></i>
                        Kontak & Dukungan
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 2rem 2.5rem;">
                    <div class="text-center mb-4">
                        <div style="width: 64px; height: 64px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 28px; margin: 0 auto 15px;">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h5 class="font-weight-bold mb-1 text-gray-900">Hubungi Tim Dukungan</h5>
                        <p class="text-muted font-italic mb-0" style="font-size: 0.9rem;">Punya pertanyaan atau kendala teknis? Kami siap membantu melalui saluran berikut:</p>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/6288214740182" target="_blank" style="display: flex; align-items: center; gap: 1rem; padding: 1rem 1.25rem; border-radius: 12px; background: #f0fdf4; border: 1px solid #bbf7d0; text-decoration: none; transition: transform 0.2s;">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: #22c55e; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div style="color: #166534;">
                                <h6 class="font-weight-bold mb-0">WhatsApp DAL Army</h6>
                                <p class="mb-0" style="font-size: 0.85rem; opacity: 0.9;">0882-1474-0182</p>
                            </div>
                        </a>
                        
                        <!-- Email -->
                        <a href="mailto:donarazhar@gmail.com" target="_blank" style="display: flex; align-items: center; gap: 1rem; padding: 1rem 1.25rem; border-radius: 12px; background: var(--primary-light); border: 1px solid #bfdbfe; text-decoration: none; transition: transform 0.2s;">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div style="color: var(--primary-dark);">
                                <h6 class="font-weight-bold mb-0">Email Dukungan</h6>
                                <p class="mb-0" style="font-size: 0.85rem; opacity: 0.9;">donarazhar@gmail.com</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Tutup
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