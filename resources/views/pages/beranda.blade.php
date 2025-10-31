@extends('layouts.sidebar')
@section('title', 'Beranda')
@section('header-title', 'Beranda')
@section('content')

<style>
    :root {
        --primary-blue: #0053C5;
        --primary-dark: #003d91;
        --primary-light: #e8f1fd;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --white: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Global Styles */
    body {
        background: var(--gray-50);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .container-fluid {
        padding: 24px;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
        border-radius: 16px;
        padding: 24px 32px;
        margin-bottom: 32px;
        box-shadow: var(--shadow-lg);
        display: flex;
        align-items: center;
        gap: 16px;
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-header i {
        font-size: 32px;
        color: rgba(255, 255, 255, 0.9);
    }

    .page-header-content h1 {
        color: var(--white);
        font-size: 30px;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .page-header-content p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 14px;
        margin: 4px 0 0;
    }

    /* Stats Cards */
    .stats-card {
        background: var(--white);
        border-radius: 10px;
        padding: 12px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--primary-blue), var(--primary-dark));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
    }

    .stats-card:hover::before {
        opacity: 1;
    }

    .stats-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .stats-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        background: var(--primary-light);
        color: var(--primary-blue);
    }

    .stats-card-icon.success {
        background: #d1fae5;
        color: var(--success);
    }

    .stats-card-icon.warning {
        background: #fef3c7;
        color: var(--warning);
    }

    .stats-card-icon.info {
        background: #dbeafe;
        color: var(--info);
    }

    .stats-card-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray-600);
        margin-bottom: 8px;
    }

    .stats-card-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--gray-900);
        line-height: 1.2;
        margin-bottom: 4px;
    }

    .stats-card-footer {
        font-size: 13px;
        color: var(--gray-600);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .stats-card-footer i {
        font-size: 11px;
    }

    /* Content Cards */
    .content-card {
        background: var(--white);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
        overflow: hidden;
        height: 100%;
    }

    .content-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-200);
        background: var(--white);
    }

    .content-card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .content-card-title i {
        color: var(--primary-blue);
        font-size: 18px;
    }

    .content-card-body {
        padding: 24px;
        max-height: 450px;
        overflow-y: auto;
    }

    /* Custom Scrollbar */
    .content-card-body::-webkit-scrollbar {
        width: 6px;
    }

    .content-card-body::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 10px;
    }

    .content-card-body::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 10px;
    }

    .content-card-body::-webkit-scrollbar-thumb:hover {
        background: var(--gray-600);
    }

    /* Modern Table */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 13px;
    }

    .modern-table thead {
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .modern-table thead th {
        background: var(--gray-50);
        color: var(--gray-700);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        text-align: left;
        border-bottom: 2px solid var(--gray-200);
    }

    .modern-table tbody td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--gray-100);
        color: var(--gray-800);
        vertical-align: middle;
    }

    .modern-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background-color: var(--gray-50);
    }

    .modern-table tfoot th {
        padding: 16px;
        background: var(--primary-light);
        color: var(--primary-blue);
        font-weight: 700;
        border-top: 2px solid var(--primary-blue);
    }

    /* Badge Styles */
    .badge-modern {
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-info {
        background: #dbeafe;
        color: #1e40af;
    }

    /* Progress Bars */
    .progress-item {
        margin-bottom: 24px;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .progress-label {
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-800);
    }

    .progress-value {
        font-size: 14px;
        font-weight: 700;
        color: var(--primary-blue);
    }

    .progress-bar-container {
        height: 10px;
        background: var(--gray-200);
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 10px;
        transition: width 1s ease-out;
        position: relative;
        overflow: hidden;
    }

    .progress-bar-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .progress-bar-fill.primary {
        background: linear-gradient(90deg, var(--primary-blue), var(--primary-dark));
    }

    .progress-bar-fill.success {
        background: linear-gradient(90deg, #10b981, #059669);
    }

    .progress-bar-fill.warning {
        background: linear-gradient(90deg, #f59e0b, #d97706);
    }

    .progress-bar-fill.danger {
        background: linear-gradient(90deg, #ef4444, #dc2626);
    }

    .progress-bar-fill.info {
        background: linear-gradient(90deg, #3b82f6, #2563eb);
    }

    /* History Card */
    .history-card {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
        border-radius: 16px;
        padding: 20px;
        color: var(--white);
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .history-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    .history-card:hover {
        transform: translateY(-4px);
    }

    .history-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .history-card-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .history-card-label {
        font-size: 13px;
        font-weight: 600;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .history-card-details {
        font-size: 12px;
        opacity: 0.85;
        margin-bottom: 8px;
        line-height: 1.5;
    }

    .history-card-value {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    /* Chart Container */
    .chart-container {
        position: relative;
        height: 300px;
        padding: 16px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 16px;
        }

        .page-header {
            padding: 20px;
        }

        .page-header-content h1 {
            font-size: 20px;
        }

        .stats-card-value {
            font-size: 24px;
        }

        .content-card-body {
            padding: 16px;
        }

        .modern-table {
            font-size: 12px;
        }

        .modern-table thead th,
        .modern-table tbody td {
            padding: 10px 12px;
        }
    }

    /* Animation Classes */
    .fade-in {
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .slide-up {
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Spacing Utilities */
    .mb-32 {
        margin-bottom: 32px;
    }

    .mb-24 {
        margin-bottom: 24px;
    }
</style>

<!-- Main Content -->
<div id="content-wrapper" class="d-flex flex-column">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="page-header fade-in">
            <i class="fas fa-home"></i>
            <div class="page-header-content">
                <h1>Dashboard Kas Kecil</h1>
                <p>Sistem Manajemen Kas Kecil Metode Imprest</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-32">
            <!-- Pembentukan Kas Kecil -->
            <div class="col-xl-3 col-md-6 mb-4 slide-up" style="animation-delay: 0.1s">
                <div class="stats-card">
                    <div class="stats-card-header">
                        <div>
                            <div class="stats-card-label">Pembentukan Kas</div>
                            <div class="stats-card-value">
                                {{ 'Rp ' . number_format($pembentukan->sum('jumlah'), 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="stats-card-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                    <div class="stats-card-footer">
                        <i class="fas fa-circle"></i>
                        Awal Proses
                    </div>
                </div>
            </div>

            <!-- Pengeluaran Kas -->
            <div class="col-xl-3 col-md-6 mb-4 slide-up" style="animation-delay: 0.2s">
                <div class="stats-card">
                    <div class="stats-card-header">
                        <div>
                            <div class="stats-card-label">Pengeluaran Kas</div>
                            <div class="stats-card-value">
                                {{ 'Rp ' . number_format($pengeluaranbulanini->sum('jumlah'), 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="stats-card-icon danger">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                    </div>
                    <div class="stats-card-footer">
                        <i class="fas fa-circle"></i>
                        Bulan ini
                    </div>
                </div>
            </div>

            <!-- Pengisian Kas -->
            <div class="col-xl-3 col-md-6 mb-4 slide-up" style="animation-delay: 0.3s">
                <div class="stats-card">
                    <div class="stats-card-header">
                        <div>
                            <div class="stats-card-label">Pengisian Kas</div>
                            <div class="stats-card-value">
                                {{ 'Rp ' . number_format($pengisianbulanini->sum('jumlah'), 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="stats-card-icon success">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                    <div class="stats-card-footer">
                        <i class="fas fa-circle"></i>
                        Bulan ini
                    </div>
                </div>
            </div>

            <!-- Saldo Berjalan -->
            <div class="col-xl-3 col-md-6 mb-4 slide-up" style="animation-delay: 0.4s">
                <div class="stats-card">
                    <div class="stats-card-header">
                        <div>
                            <div class="stats-card-label">Saldo Berjalan</div>
                            <div class="stats-card-value">
                                {{ 'Rp ' . number_format($saldoberjalan->total_result ?? 0, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="stats-card-icon info">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <div class="stats-card-footer">
                        <i class="fas fa-circle"></i>
                        Saldo Terkini
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mb-32">
            <!-- Informasi Mata Anggaran -->
            <div class="col-xl-6 col-lg-6 mb-4">
                <div class="content-card">
                    <div class="content-card-header">
                        <h6 class="content-card-title">
                            <i class="fas fa-list-alt"></i>
                            Informasi Mata Anggaran
                        </h6>
                    </div>
                    <div class="content-card-body">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">Kode</th>
                                    <th style="width: 70%;">Nama Anggaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matanggaran as $mata)
                                <tr>
                                    <td>
                                        <span class="badge-modern badge-info">
                                            {{ $mata->kode_matanggaran }}
                                        </span>
                                    </td>
                                    <td>{{ $mata->nama_aas }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Grafik Pengeluaran Anggaran -->
            <div class="col-xl-6 col-lg-6 mb-4">
                <div class="content-card">
                    <div class="content-card-header">
                        <h6 class="content-card-title">
                            <i class="fas fa-chart-bar"></i>
                            Grafik Pengeluaran Anggaran
                        </h6>
                    </div>
                    <div class="content-card-body">
                        <div class="chart-container">
                            <canvas id="myPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekap Bulanan Section -->
        <div class="row mb-32">
            <!-- Rekap Bulanan Progress -->
            <div class="col-lg-6 mb-4">
                <div class="content-card">
                    <div class="content-card-header">
                        <h6 class="content-card-title">
                            <i class="fas fa-chart-pie"></i>
                            Rekap Bulan {{ $namaBulan }} {{ $tahunini }}
                        </h6>
                    </div>
                    <div class="content-card-body">
                        @php
                        $colors = ['primary', 'success', 'info', 'warning', 'danger'];
                        $totals = $rekapperbulan->pluck('total_perbulan')->toArray();
                        $maxTotalPerbulan = !empty($totals) ? max($totals) : 0;
                        @endphp

                        @foreach ($rekapperbulan as $index => $data)
                        @php
                        $percentage = $maxTotalPerbulan !== 0 ? ($data->total_perbulan / $maxTotalPerbulan) * 100 : 0;
                        $colorClass = $percentage == 100 ? 'primary' : $colors[$index % count($colors)];
                        @endphp

                        <div class="progress-item">
                            <div class="progress-header">
                                <span class="progress-label">{{ $data->nama_aas }}</span>
                                <span class="progress-value">
                                    Rp {{ number_format($data->total_perbulan, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill {{ $colorClass }}"
                                    style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Datatables Perbulan -->
            <div class="col-lg-6 mb-4">
                <div class="content-card">
                    <div class="content-card-header">
                        <h6 class="content-card-title">
                            <i class="fas fa-table"></i>
                            Detail Transaksi Bulan {{ $namaBulan }} {{ $tahunini }}
                        </h6>
                    </div>
                    <div class="content-card-body">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 12%;">Tanggal</th>
                                    <th style="width: 10%;">Kode</th>
                                    <th style="width: 25%;">Nama Akun</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 18%;" class="text-right">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengeluaranbulanini as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($d->tanggal)->isoFormat('DD/MM/YY') }}</td>
                                    <td>
                                        <span class="badge-modern badge-info">
                                            {{ $d->kode_matanggaran }}
                                        </span>
                                    </td>
                                    <td>{{ $d->nama_aas }}</td>
                                    <td>
                                        @if ($d->status == 'k')
                                        <span class="badge-modern badge-success">Kredit</span>
                                        @elseif ($d->status == 'd')
                                        <span class="badge-modern badge-danger">Debet</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <strong>{{ number_format($d->jumlah, 0, ',', '.') }}</strong>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center" style="padding: 40px;">
                                        <i class="fas fa-inbox" style="font-size: 48px; color: var(--gray-300); margin-bottom: 16px;"></i>
                                        <p style="color: var(--gray-600); margin: 0;">Belum ada transaksi</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-center">Total Pengeluaran</th>
                                    <th class="text-right">
                                        {{ number_format($pengeluaranbulanini->sum('jumlah'), 0, ',', '.') }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Pengisian Kas -->
        <div class="row">
            <div class="col-lg-12">
                <div class="content-card">
                    <div class="content-card-header">
                        <h6 class="content-card-title">
                            <i class="fas fa-history"></i>
                            History Pengisian Kas
                        </h6>
                    </div>
                    <div class="content-card-body">
                        <div class="row">
                            @foreach ($combinedData as $data)
                            @if (is_object($data))
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="history-card">
                                    <div class="history-card-header">
                                        <div class="history-card-icon">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <div style="flex: 1;">
                                            <div class="history-card-label">Pengisian Kas</div>
                                            @if (isset($data->id_pengisian))
                                            @if (DB::table('transaksi')->where('id_pengisian', $data->id_pengisian)->exists())
                                            <span class="badge-modern badge-success">Sudah Cair</span>
                                            @elseif (DB::table('transaksi_shadow')->where('id_pengisian', $data->id_pengisian)->exists())
                                            <span class="badge-modern badge-danger">Belum Cair</span>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="history-card-details">
                                        @if (isset($data->tanggal))
                                        <div>
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('DD MMMM YYYY') }}
                                        </div>
                                        @endif
                                        @if (isset($data->perincian))
                                        <div>
                                            <i class="fas fa-file-alt"></i>
                                            {{ $data->perincian }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="history-card-value">
                                        {{ 'Rp ' . number_format($data->jumlah ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $combinedData->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('after-style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('after-script')
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

<script>
    // Bar Chart - Pengeluaran Anggaran
    var ctxPie = document.getElementById('myPieChart').getContext('2d');
    var pengeluaranData = <?php echo json_encode($pengeluaranbulanini); ?>;

    // Modern color palette
    var backgroundColors = [
        'rgba(0, 83, 197, 0.8)',
        'rgba(16, 185, 129, 0.8)',
        'rgba(59, 130, 246, 0.8)',
        'rgba(245, 158, 11, 0.8)',
        'rgba(239, 68, 68, 0.8)',
        'rgba(139, 92, 246, 0.8)',
        'rgba(236, 72, 153, 0.8)',
    ];

    var borderColors = [
        'rgb(0, 83, 197)',
        'rgb(16, 185, 129)',
        'rgb(59, 130, 246)',
        'rgb(245, 158, 11)',
        'rgb(239, 68, 68)',
        'rgb(139, 92, 246)',
        'rgb(236, 72, 153)',
    ];

    var myPieChart = new Chart(ctxPie, {
        type: 'bar',
        data: {
            labels: pengeluaranData.map(data => data.kode_matanggaran),
            datasets: [{
                label: 'Pengeluaran',
                data: pengeluaranData.map(data => data.jumlah),
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11,
                            weight: '600'
                        },
                        color: '#374151'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        },
                        color: '#6b7280',
                        callback: function(value, index, values) {
                            if (value >= 1000000) {
                                return (value / 1000000).toFixed(1) + 'Jt';
                            } else if (value >= 1000) {
                                return (value / 1000).toFixed(0) + 'Rb';
                            } else {
                                return value;
                            }
                        }
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            }
        }
    });

    // Animate progress bars on load
    document.addEventListener('DOMContentLoaded', function() {
        const progressBars = document.querySelectorAll('.progress-bar-fill');
        progressBars.forEach((bar, index) => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 100 + (index * 100));
        });
    });

    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';

    // Animate stats cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.slide-up').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease-out';
        observer.observe(el);
    });
</script>
@endpush