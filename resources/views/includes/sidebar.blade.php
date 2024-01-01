<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/panel/beranda">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kas Kecil <sup>V.1.0</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/panel/beranda">
            <i class="fas fa-home"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master <i class="fas fa-fw fa-plus"></i>
            </span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#collapseTwo">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"><i class="fas fa-fw fa-cog"></i><span>Master Input Data</span></h6>
                <a class="collapse-item" href="/master/aas"><i class="fas fa-file"></i> <span>Akun AAS</span></a>
                <a class="collapse-item" href="/master/matanggaran"><i class="fas fa-file"></i> <span>Akun Mata
                        Anggaran</span></a>
                <a class="collapse-item" href="/master/akunkelompok"><i class="fas fa-file"></i> <span>Akun
                        Kelompok</span></a>
                <a class="collapse-item" href="/master/akunperkiraan"><i class="fas fa-file"></i> <span>Akun
                        Perkiraan</span></a>
                <a class="collapse-item" href="/master/unitkerja"><i class="fas fa-file"></i> <span>Akun Data
                        Unit</span></a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Transaksi <i class="fas fa-fw fa-plus"></i>
            </span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-bs0parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi Kas Kecil</h6>
                <a class="collapse-item" href="/transaksi/pembentukan"><i class="fas fa-wallet"></i> <span>Pembentukan
                        Kas
                        Kecil</span></a>
                <a class="collapse-item" href="/transaksi/pengeluaran"><i class="fas fa-wallet"></i> <span>Pengeluaran
                        Kas
                        Kecil</span></a>
                <a class="collapse-item" href="utilities-animation.html"><i class="fas fa-wallet"></i> <span>Pengisian
                        Kas
                        Kecil</span></a>
                <a class="collapse-item" href="/transaksi"><i class="fas fa-wallet"></i> <span>Laporan Kas
                        Kecil</span></a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tentang Aplikasi
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-user"></i>
            <span>Pengguna</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="/instansi">
            <i class="fas fa-building"></i>
            <span>Instansi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
