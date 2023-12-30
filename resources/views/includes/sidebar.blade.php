<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-book"></i> --}}
            <i class="fas fa-balance-scale"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pettycash</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><b>Dashboard</b></span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">
    {{-- @endcan --}}

    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="/transaksi/pemasukan">
            <i class="fas fa-arrow-right"></i>
            <span><b>Pemasukan</b></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/transaksi/pengeluaran">
            <i class="fas fa-arrow-left"></i>
            <span><b>Pengeluaran</b></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/transaksi">
            <i class="fas fa-exchange-alt"></i>
            <span><b>Transaksi</b></span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fa fa-file"></i>
            <span><b>Laporan</b></span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        Pengaturan
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span><b>User</b></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/instansi">
            <i class="fas fa-building"></i>
            <span><b>Instansi</b></span></a>
    </li>
    {{-- @endcan --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
