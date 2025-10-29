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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
        }

        /* Brand Section */
        .sidebar-brand {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
        }

        .sidebar-brand-text {
            color: var(--text-white);
        }

        .sidebar-brand-icon i {
            color: var(--text-white);
        }

        /* Divider */
        .sidebar-divider {
            border-color: rgba(255, 255, 255, 0.2);
            margin: 12px 20px;
        }

        /* Sidebar Heading */
        .sidebar-heading {
            color: rgba(255, 255, 255, 0.6);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.8px;
            padding: 8px 20px;
        }

        /* Nav Item */
        .nav-item {
            margin: 4px 10px;
        }

        .nav-link {
            color: var(--text-white);
            border-radius: 8px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .nav-link i {
            color: rgba(255, 255, 255, 0.8);
            width: 20px;
            margin-right: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
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

        /* Sidebar Toggle Button */
        #sidebarToggle {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        #sidebarToggle:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        #sidebarToggle::before {
            content: '\f104';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: white;
            font-size: 16px;
        }

        /* Scrollbar */
        #accordionSidebar::-webkit-scrollbar {
            width: 6px;
        }

        #accordionSidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/panel/beranda">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="sidebar-brand-text">Kas Kecil <sup>v2.0</sup></div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('panel/beranda') ? 'active' : '' }}" href="/panel/beranda">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Utama
            </div>

            <!-- Master Data -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is(['master/aas', 'master/matanggaran']) ? '' : 'collapsed' }}"
                    href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="{{ request()->is(['master/aas', 'master/matanggaran']) ? 'true' : 'false' }}"
                    aria-controls="collapseTwo">
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
                    aria-controls="collapseUtilities">
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
                <a class="nav-link {{ request()->is('laporan') ? 'active' : '' }}" href="/laporan">
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
                <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="/users">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span>
                </a>
            </li>

            <!-- Instansi -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('instansi') ? 'active' : '' }}" href="/instansi">
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

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets/sbadmin/img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/sbadmin/js/sb-admin-2.min.js') }}"></script>

    <!-- Additional Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/lib/jquery.mask.min.js') }}"></script>

    @stack('after-script')

</body>

</html>