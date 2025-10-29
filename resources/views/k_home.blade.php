@extends('layouts.sidebarhome')
@section('title', 'Dashboard Kas Kecil')
@section('header-title', 'Dashboard Kas Kecil')
@section('content')

<style>
    :root {
        --primary: #0053C5;
        --primary-light: #e8f1ff;
        --primary-dark: #003d91;
        --white: #ffffff;
        --gray-50: #fafbfc;
        --gray-100: #f5f6f8;
        --gray-200: #e9ecef;
        --gray-300: #dee2e6;
        --gray-600: #6c757d;
        --gray-800: #343a40;
        --gray-900: #1a1d20;
        --success: #10b981;
        --success-light: #d1fae5;
        --danger: #ef4444;
        --danger-light: #fee2e2;
        --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.04);
        --shadow-sm: 0 2px 4px rgba(0, 83, 197, 0.06);
        --shadow-md: 0 4px 12px rgba(0, 83, 197, 0.08);
        --shadow-lg: 0 8px 24px rgba(0, 83, 197, 0.12);
        --shadow-xl: 0 16px 48px rgba(0, 83, 197, 0.16);
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
        background: var(--gray-50);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        color: var(--gray-900);
        line-height: 1.6;
    }

    #content-wrapper {
        min-height: 100vh;
    }

    .container-fluid {
        padding: 1.5rem;
        max-width: 1600px;
        margin: 0 auto;
    }

    /* Header Section */
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: var(--radius-xl);
        padding: 2.5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        pointer-events: none;
    }

    .header-content {
        position: relative;
        z-index: 1;
        color: white;
    }

    .header-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-title i {
        font-size: 2.25rem;
    }

    .header-subtitle {
        font-size: 1rem;
        opacity: 0.92;
        margin-bottom: 0;
    }

    .header-date {
        font-size: 0.875rem;
        opacity: 0.88;
        font-weight: 500;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        padding: 1.75rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }

    .stat-icon-wrapper {
        width: 56px;
        height: 56px;
        background: var(--primary-light);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon-wrapper {
        background: var(--primary);
        transform: rotate(-5deg) scale(1.05);
    }

    .stat-icon {
        font-size: 1.5rem;
        color: var(--primary);
        transition: color 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        color: white;
    }

    .stat-label {
        font-size: 0.813rem;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
    }

    .stat-value {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .stat-subtitle {
        font-size: 0.813rem;
        color: var(--gray-600);
        font-weight: 500;
    }

    /* Content Grid */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .grid-col-6 {
        grid-column: span 6;
    }

    .grid-col-12 {
        grid-column: span 12;
    }

    /* Modern Card */
    .modern-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-200);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.3s ease;
    }

    .modern-card:hover {
        box-shadow: var(--shadow-md);
    }

    .card-header-modern {
        padding: 1.5rem;
        border-bottom: 1px solid var(--gray-200);
        background: var(--white);
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-title i {
        color: var(--primary);
        font-size: 1.25rem;
    }

    .card-body-modern {
        padding: 1.5rem;
        flex: 1;
        overflow: auto;
    }

    /* Scrollable Content */
    .scroll-container {
        max-height: 480px;
        overflow-y: auto;
        padding-right: 0.5rem;
    }

    .scroll-container::-webkit-scrollbar {
        width: 6px;
    }

    .scroll-container::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 10px;
    }

    .scroll-container::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 10px;
        transition: background 0.3s ease;
    }

    .scroll-container::-webkit-scrollbar-thumb:hover {
        background: var(--primary);
    }

    /* Modern Table */
    .table-modern {
        width: 100%;
        font-size: 0.875rem;
        margin: 0;
    }

    .table-modern thead th {
        background: var(--gray-50);
        color: var(--gray-900);
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table-modern tbody td {
        padding: 1rem;
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
        color: var(--gray-800);
    }

    .table-modern tbody tr {
        transition: background 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background: var(--primary-light);
    }

    .table-modern tfoot th {
        padding: 1rem;
        background: var(--gray-50);
        font-weight: 700;
        border-top: 2px solid var(--gray-300);
        color: var(--gray-900);
    }

    /* Badge */
    .badge-custom {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .badge-primary {
        background: var(--primary-light);
        color: var(--primary);
    }

    .badge-success {
        background: var(--success-light);
        color: #065f46;
    }

    .badge-danger {
        background: var(--danger-light);
        color: #991b1b;
    }

    /* Progress Bar */
    .progress-item {
        margin-bottom: 1.5rem;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.625rem;
    }

    .progress-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--gray-900);
    }

    .progress-value {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--primary);
    }

    .progress-bar-wrapper {
        height: 10px;
        background: var(--gray-200);
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        border-radius: 10px;
        transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .progress-bar-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
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

    /* Chart Container */
    .chart-wrapper {
        position: relative;
        height: 380px;
        padding: 1rem;
    }

    /* History Cards */
    .history-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        padding: 1.5rem;
    }

    .history-card {
        background: var(--white);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        border: 1px solid var(--gray-200);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .history-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .history-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .history-card:hover::before {
        transform: scaleX(1);
    }

    .history-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .history-icon {
        width: 48px;
        height: 48px;
        background: var(--primary-light);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.25rem;
    }

    .history-date {
        font-size: 0.813rem;
        color: var(--gray-600);
        font-weight: 500;
        margin-bottom: 0.75rem;
    }

    .history-amount {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .history-description {
        font-size: 0.875rem;
        color: var(--gray-600);
        line-height: 1.5;
    }

    /* Pagination */
    .pagination {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        padding: 1.5rem;
        margin: 0;
    }

    .page-item {
        list-style: none;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0.5rem 1rem;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-sm);
        color: var(--gray-800);
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .page-link:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .page-item.active .page-link {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .page-item.disabled .page-link {
        opacity: 0.5;
        pointer-events: none;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .grid-col-6 {
            grid-column: span 12;
        }
    }

    @media (max-width: 768px) {
        .container-fluid {
            padding: 1rem;
        }

        .dashboard-header {
            padding: 1.5rem;
        }

        .header-title {
            font-size: 1.5rem;
        }

        .header-title i {
            font-size: 1.75rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .content-grid {
            gap: 1rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .history-grid {
            grid-template-columns: 1fr;
            padding: 1rem;
        }

        .chart-wrapper {
            height: 300px;
        }

        .scroll-container {
            max-height: 400px;
        }

        .table-modern {
            font-size: 0.813rem;
        }

        .table-modern thead th,
        .table-modern tbody td,
        .table-modern tfoot th {
            padding: 0.75rem 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .header-content {
            text-align: center;
        }

        .header-title {
            flex-direction: column;
            gap: 0.5rem;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card,
    .modern-card,
    .history-card {
        animation: fadeInUp 0.5s ease backwards;
    }

    .stat-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .stat-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .stat-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .stat-card:nth-child(4) {
        animation-delay: 0.4s;
    }
</style>

<div id="content-wrapper" class="d-flex flex-column">
    <div class="container-fluid">

        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="header-content">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                    <div>
                        <h1 class="header-title">
                            <i class="fas fa-chart-line"></i>
                            <span>Dashboard Kas Kecil</span>
                        </h1>
                        <p class="header-subtitle">Monitoring dan analisis kas kecil periode berjalan</p>
                    </div>
                    <div class="text-end">
                        <div class="header-date">
                            <i class="far fa-calendar-alt me-2"></i>{{ \Carbon\Carbon::now()->isoFormat('dddd, DD MMMM YYYY') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon-wrapper">
                        <i class="fas fa-wallet stat-icon"></i>
                    </div>
                </div>
                <div class="stat-label">Pembentukan Kas</div>
                <div class="stat-value">{{ 'Rp ' . number_format($pembentukan->sum('jumlah'), 0, ',', '.') }}</div>
                <div class="stat-subtitle">Awal Proses</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon-wrapper">
                        <i class="fas fa-arrow-down stat-icon"></i>
                    </div>
                </div>
                <div class="stat-label">Pengeluaran Kas</div>
                <div class="stat-value">{{ 'Rp ' . number_format($pengeluaranbulanini->sum('jumlah'), 0, ',', '.') }}</div>
                <div class="stat-subtitle">Bulan Ini</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon-wrapper">
                        <i class="fas fa-arrow-up stat-icon"></i>
                    </div>
                </div>
                <div class="stat-label">Pengisian Kas</div>
                <div class="stat-value">{{ 'Rp ' . number_format($pengisianbulanini->sum('jumlah'), 0, ',', '.') }}</div>
                <div class="stat-subtitle">Bulan Ini</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon-wrapper">
                        <i class="fas fa-balance-scale stat-icon"></i>
                    </div>
                </div>
                <div class="stat-label">Saldo Berjalan</div>
                <div class="stat-value">{{ 'Rp ' . number_format($saldoberjalan->total_result ?? 0, 0, ',', '.') }}</div>
                <div class="stat-subtitle">Real-time</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Informasi Mata Anggaran -->
            <div class="grid-col-6">
                <div class="modern-card">
                    <div class="card-header-modern">
                        <h6 class="card-title">
                            <i class="fas fa-list-alt"></i>
                            Informasi Mata Anggaran
                        </h6>
                    </div>
                    <div class="card-body-modern">
                        <div class="scroll-container">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Anggaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matanggaran as $mata)
                                    <tr>
                                        <td><span class="badge-custom badge-primary">{{ $mata->kode_matanggaran }}</span></td>
                                        <td>{{ $mata->nama_aas }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Pengeluaran -->
            <div class="grid-col-6">
                <div class="modern-card">
                    <div class="card-header-modern">
                        <h6 class="card-title">
                            <i class="fas fa-chart-bar"></i>
                            Grafik Pengeluaran Anggaran
                        </h6>
                    </div>
                    <div class="card-body-modern">
                        <div class="chart-wrapper">
                            <canvas id="myPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rekap Bulanan -->
            <div class="grid-col-6">
                <div class="modern-card">
                    <div class="card-header-modern">
                        <h6 class="card-title">
                            <i class="fas fa-calendar-alt"></i>
                            Rekap Bulan {{ $namaBulan }} {{ $tahunini }}
                        </h6>
                    </div>
                    <div class="card-body-modern">
                        @foreach ($rekapperbulan as $index => $data)
                        @php
                        $maxTotalPerbulan = max($rekapperbulan->pluck('total_perbulan')->toArray());
                        $percentage = $maxTotalPerbulan !== 0 ? ($data->total_perbulan / $maxTotalPerbulan) * 100 : 0;
                        @endphp
                        <div class="progress-item">
                            <div class="progress-header">
                                <span class="progress-label">{{ $data->nama_aas }}</span>
                                <span class="progress-value">Rp {{ number_format($data->total_perbulan, 0, ',', '.') }}</span>
                            </div>
                            <div class="progress-bar-wrapper">
                                <div class="progress-bar-fill" style="width: {{ $percentage }}%; opacity: {{ 1 - ($index * 0.1) }};"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Detail Transaksi -->
            <div class="grid-col-6">
                <div class="modern-card">
                    <div class="card-header-modern">
                        <h6 class="card-title">
                            <i class="fas fa-table"></i>
                            Detail Transaksi {{ $namaBulan }} {{ $tahunini }}
                        </h6>
                    </div>
                    <div class="card-body-modern">
                        <div class="scroll-container">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Akun</th>
                                        <th>MA</th>
                                        <th>Perincian</th>
                                        <th>Status</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengeluaranbulanini as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->tanggal)->isoFormat('DD/MM/YY') }}</td>
                                        <td><span class="badge-custom badge-primary">{{ $d->kode_aas }}</span></td>
                                        <td>{{ $d->kode_matanggaran }}</td>
                                        <td>{{ Str::limit($d->perincian, 25) }}</td>
                                        <td>
                                            @if ($d->status == 'k')
                                            <span class="badge-custom badge-success">Kredit</span>
                                            @else
                                            <span class="badge-custom badge-danger">Debet</span>
                                            @endif
                                        </td>
                                        <td class="text-end" style="font-weight: 600;">{{ number_format($d->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center" style="color: var(--gray-600); padding: 2rem;">Tidak ada data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6" class="text-end">Total Pengeluaran</th>
                                        <th class="text-end">{{ number_format($pengeluaranbulanini->sum('jumlah'), 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Pengisian Kas -->
        <div class="modern-card">
            <div class="card-header-modern">
                <h6 class="card-title">
                    <i class="fas fa-history"></i>
                    History Pengisian Kas
                </h6>
            </div>
            <div class="history-grid">
                @foreach ($combinedData as $data)
                @if (is_object($data))
                <div class="history-card">
                    <div class="history-header">
                        <div class="history-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        @if (isset($data->id_pengisian))
                        @if (DB::table('transaksi')->where('id_pengisian', $data->id_pengisian)->exists())
                        <span class="badge-custom badge-success">Sudah Cair</span>
                        @elseif (DB::table('transaksi_shadow')->where('id_pengisian', $data->id_pengisian)->exists())
                        <span class="badge-custom badge-danger">Belum Cair</span>
                        @endif
                        @endif
                    </div>
                    <div class="history-date">
                        @if (isset($data->tanggal))
                        <i class="far fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('DD MMMM YYYY') }}
                        @endif
                    </div>
                    <div class="history-amount">
                        {{ 'Rp ' . number_format($data->jumlah ?? 0, 0, ',', '.') }}
                    </div>
                    <div class="history-description">
                        @if (isset($data->perincian))
                        {{ Str::limit($data->perincian, 45) }}
                        @endif
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $combinedData->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>

    </div>
</div>

@endsection

@push('after-style')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('after-script')
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Modern Bar Chart Configuration
    (function() {
        const ctx = document.getElementById('myPieChart');
        if (!ctx) return;

        const pengeluaranData = <?php echo json_encode($pengeluaranbulanini); ?>;
        const dataLength = pengeluaranData.length;

        // Generate gradient colors
        const backgroundColors = [];
        const borderColors = [];

        for (let i = 0; i < dataLength; i++) {
            const opacity = Math.max(0.4, 1 - (i * 0.08));
            backgroundColors.push(`rgba(0, 83, 197, ${opacity})`);
            borderColors.push('rgba(0, 83, 197, 1)');
        }

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: pengeluaranData.map(data => data.kode_matanggaran),
                datasets: [{
                    label: 'Pengeluaran',
                    data: pengeluaranData.map(data => data.jumlah),
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 0,
                    borderRadius: 8,
                    barPercentage: 0.7,
                    categoryPercentage: 0.8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 83, 197, 0.96)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        padding: 16,
                        cornerRadius: 8,
                        titleFont: {
                            size: 14,
                            weight: '700',
                            family: 'Inter'
                        },
                        bodyFont: {
                            size: 13,
                            weight: '500',
                            family: 'Inter'
                        },
                        displayColors: false,
                        callbacks: {
                            title: function(context) {
                                return context[0].label;
                            },
                            label: function(context) {
                                return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        border: {
                            display: false
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.04)',
                            drawBorder: false
                        },
                        ticks: {
                            padding: 8,
                            font: {
                                size: 11,
                                weight: '500',
                                family: 'Inter'
                            },
                            color: '#6c757d',
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return (value / 1000000).toFixed(1) + 'Jt';
                                } else if (value >= 1000) {
                                    return (value / 1000).toFixed(0) + 'Rb';
                                }
                                return value;
                            }
                        }
                    },
                    x: {
                        border: {
                            display: false
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            padding: 8,
                            font: {
                                size: 11,
                                weight: '600',
                                family: 'Inter'
                            },
                            color: '#343a40'
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });

        // Animate progress bars on load
        const progressBars = document.querySelectorAll('.progress-bar-fill');
        progressBars.forEach((bar, index) => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 100 + (index * 100));
        });
    })();
</script>
@endpush