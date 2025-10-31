@extends('layouts.sidebar')
@section('title', 'Master Akun')
@section('header-title', 'Master Akun AAS')

@section('content')

<style>
    :root {
        --primary-blue: #0053C5;
        --primary-dark: #003d91;
        --primary-light: #E8F1FD;
        --primary-lighter: #F5F9FF;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --white: #ffffff;
        --gray-50: #F9FAFB;
        --gray-100: #F3F4F6;
        --gray-200: #E5E7EB;
        --gray-300: #D1D5DB;
        --gray-400: #9CA3AF;
        --gray-500: #6B7280;
        --gray-600: #4B5563;
        --gray-700: #374151;
        --gray-800: #1F2937;
        --gray-900: #111827;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    }

    /* Global Styles */
    body {
        background-color: var(--gray-50);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Page Header - Minimalist Modern */
    .page-header {
        background: var(--white);
        border-radius: 20px;
        padding: 32px 36px;
        margin-bottom: 28px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-100);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
    }

    .page-header-content {
        position: relative;
        z-index: 1;
    }

    .page-header-content h1 {
        color: var(--gray-900);
        font-size: 28px;
        font-weight: 700;
        margin: 0 0 8px 0;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header-content h1 i {
        color: var(--primary-blue);
        font-size: 32px;
    }

    .page-header-content p {
        color: var(--gray-600);
        font-size: 15px;
        margin: 0;
        font-weight: 400;
    }

    /* Modern Card with Subtle Shadow */
    .modern-card {
        background: var(--white);
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-100);
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .modern-card:hover {
        box-shadow: var(--shadow-md);
    }

    .modern-card-header {
        padding: 24px 32px;
        border-bottom: 1px solid var(--gray-100);
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .modern-card-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modern-card-title i {
        color: var(--primary-blue);
        font-size: 20px;
    }

    .modern-card-body {
        padding: 32px;
    }

    /* Alert Messages - Clean & Modern */
    .alert {
        border: none;
        border-radius: 14px;
        padding: 18px 22px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 14px;
        font-weight: 500;
        box-shadow: var(--shadow-sm);
    }

    .alert i {
        font-size: 22px;
        flex-shrink: 0;
    }

    .alert-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        color: #065F46;
        border-left: 4px solid var(--success);
    }

    .alert-warning {
        background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        color: #92400E;
        border-left: 4px solid var(--warning);
    }

    /* Modern Button - Refined */
    .btn-modern {
        padding: 12px 26px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        text-decoration: none;
        box-shadow: var(--shadow-sm);
    }

    .btn-modern i {
        font-size: 16px;
    }

    .btn-modern:active {
        transform: scale(0.98);
    }

    .btn-primary-modern {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
        color: var(--white);
    }

    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: var(--white);
    }

    .btn-success-modern {
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
        color: var(--white);
    }

    .btn-success-modern:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: var(--white);
    }

    /* Search Section - Clean Design */
    .search-section {
        background: var(--gray-50);
        padding: 24px;
        border-radius: 16px;
        margin-bottom: 28px;
        border: 1px solid var(--gray-200);
    }

    .form-control-modern {
        padding: 13px 18px;
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: var(--white);
        color: var(--gray-900);
    }

    .form-control-modern::placeholder {
        color: var(--gray-400);
    }

    .form-control-modern:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px var(--primary-lighter);
        outline: none;
        background: var(--white);
    }

    /* Modern Table - Ultra Clean */
    .table-responsive {
        border-radius: 12px;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        position: relative;
    }

    /* Custom Scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: var(--primary-blue);
        border-radius: 10px;
        transition: background 0.3s ease;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }

    /* Scroll Hint for Mobile */
    .scroll-hint {
        display: none;
        text-align: center;
        padding: 12px;
        background: linear-gradient(135deg, var(--primary-lighter) 0%, var(--primary-light) 100%);
        color: var(--primary-blue);
        font-size: 13px;
        font-weight: 600;
        border-radius: 12px 12px 0 0;
        margin-bottom: -1px;
    }

    .scroll-hint i {
        margin-left: 6px;
        animation: slideHint 1.5s ease-in-out infinite;
    }

    @keyframes slideHint {

        0%,
        100% {
            transform: translateX(0);
        }

        50% {
            transform: translateX(8px);
        }
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 14px;
        background: var(--white);
    }

    /* Stacked Info Column */
    .stacked-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .stacked-info .info-code {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stacked-info .info-name {
        font-weight: 700;
        color: var(--gray-900);
        font-size: 15px;
        line-height: 1.4;
    }

    .stacked-info .info-category {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .info-divider {
        height: 4px;
        width: 40px;
        background: linear-gradient(90deg, var(--primary-blue), transparent);
        border-radius: 2px;
        margin: 4px 0;
    }

    .table-modern thead th {
        background: var(--gray-50);
        color: var(--gray-700);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.8px;
        padding: 18px 20px;
        text-align: left;
        border-bottom: 2px solid var(--gray-200);
        white-space: nowrap;
    }

    .table-modern tbody td {
        padding: 18px 20px;
        border-bottom: 1px solid var(--gray-100);
        color: var(--gray-800);
        vertical-align: middle;
        background: var(--white);
    }

    .table-modern tbody tr {
        transition: all 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background: var(--primary-lighter);
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badge Styles - Refined */
    .badge-modern {
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        display: inline-block;
        white-space: nowrap;
    }

    .badge-success {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        color: #065F46;
        border: 1px solid #6EE7B7;
    }

    .badge-info {
        background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
        color: #1E40AF;
        border: 1px solid #93C5FD;
    }

    .badge-warning {
        background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        color: #92400E;
        border: 1px solid #FCD34D;
    }

    .badge-primary {
        background: linear-gradient(135deg, var(--primary-light) 0%, #D1E5FF 100%);
        color: var(--primary-blue);
        border: 1px solid #A8D0FF;
    }

    /* Action Buttons - Modern & Clean */
    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0;
        margin: 0 4px;
        cursor: pointer;
        box-shadow: var(--shadow-sm);
        flex-shrink: 0;
    }

    .btn-action i {
        font-size: 15px;
    }

    .btn-action:active {
        transform: scale(0.95);
    }

    .btn-edit {
        background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
        color: #1E40AF;
    }

    .btn-edit:hover {
        background: var(--info);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-delete {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        color: #991B1B;
    }

    .btn-delete:hover {
        background: var(--danger);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* Action Column Fix */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-wrap: nowrap;
        white-space: nowrap;
    }

    .action-buttons form {
        display: inline-flex;
        margin: 0;
    }

    /* Modal Styles - Premium Look */
    .modal-content {
        border: none;
        border-radius: 20px;
        box-shadow: var(--shadow-xl);
        border: 1px solid var(--gray-100);
    }

    .modal-header {
        background: var(--white);
        color: var(--gray-900);
        border-radius: 20px 20px 0 0;
        padding: 24px 28px;
        border-bottom: 1px solid var(--gray-100);
        position: relative;
    }

    .modal-header::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 28px;
        right: 28px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
        border-radius: 3px 3px 0 0;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--gray-900);
    }

    .modal-title i {
        color: var(--primary-blue);
        font-size: 24px;
    }

    .modal-body {
        padding: 28px;
    }

    .btn-close {
        background: var(--gray-100);
        opacity: 1;
        border-radius: 10px;
        width: 36px;
        height: 36px;
        padding: 0;
        transition: all 0.3s ease;
    }

    .btn-close:hover {
        background: var(--gray-200);
        transform: rotate(90deg);
    }

    /* Form Styles - Clean & Modern */
    .form-group {
        margin-bottom: 22px;
    }

    .form-label {
        display: block;
        color: var(--gray-700);
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .form-control,
    .form-select {
        padding: 13px 18px;
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        width: 100%;
        background: var(--white);
        color: var(--gray-900);
        font-weight: 500;
    }

    .form-control::placeholder {
        color: var(--gray-400);
        font-weight: 400;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px var(--primary-lighter);
        outline: none;
    }

    .form-select {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%234B5563' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 16px 12px;
        padding-right: 40px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    /* Select option styling */
    .form-select option {
        color: var(--gray-900);
        background: var(--white);
        padding: 10px;
        font-weight: 500;
    }

    .form-select option:disabled {
        color: var(--gray-400);
        font-style: italic;
    }

    /* Select when selected value */
    .form-select:not([value=""]) {
        color: var(--gray-900);
        font-weight: 600;
    }

    /* Disabled state */
    .form-control:disabled,
    .form-select:disabled {
        background-color: var(--gray-50);
        color: var(--gray-500);
        cursor: not-allowed;
        opacity: 0.6;
    }

    /* Pagination - Modern Style */
    .pagination {
        gap: 8px;
        margin: 0;
    }

    .page-link {
        border: 1px solid var(--gray-200);
        border-radius: 10px;
        padding: 10px 16px;
        color: var(--gray-700);
        font-weight: 500;
        transition: all 0.3s ease;
        background: var(--white);
        text-decoration: none;
    }

    .page-link:hover {
        background: var(--primary-blue);
        color: var(--white);
        border-color: var(--primary-blue);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
        border-color: var(--primary-blue);
        color: var(--white);
        box-shadow: var(--shadow-sm);
    }

    .page-item.disabled .page-link {
        background: var(--gray-50);
        color: var(--gray-400);
        border-color: var(--gray-200);
    }

    /* Empty State - Elegant */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state i {
        font-size: 72px;
        color: var(--gray-300);
        margin-bottom: 20px;
        opacity: 0.7;
    }

    .empty-state h3 {
        color: var(--gray-700);
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: var(--gray-500);
        font-size: 15px;
        margin: 0;
    }

    /* Loading State */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            padding: 24px 20px;
        }

        .page-header-content h1 {
            font-size: 22px;
        }

        .page-header-content h1 i {
            font-size: 26px;
        }

        .modern-card-header {
            padding: 20px 20px;
        }

        .modern-card-body {
            padding: 20px;
        }

        .search-section {
            padding: 20px;
        }

        .table-modern {
            font-size: 13px;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 14px 10px;
        }

        /* Mobile Button Fix */
        .btn-modern {
            padding: 11px 20px;
            font-size: 13px;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            margin: 0 3px;
        }

        .btn-action i {
            font-size: 14px;
        }

        .action-buttons {
            gap: 6px;
        }

        /* Ensure action column doesn't wrap */
        .table-modern tbody td:last-child {
            white-space: nowrap;
            min-width: 100px;
        }

        .empty-state {
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 56px;
        }

        /* Show scroll hint on mobile */
        .scroll-hint {
            display: block;
        }

        /* Mobile table adjustments */
        .table-responsive {
            margin: 0 -20px;
            padding: 0 20px;
            border-radius: 0;
        }

        /* Badge adjustments for mobile */
        .badge-modern {
            font-size: 11px;
            padding: 6px 12px;
        }

        .stacked-info .info-name {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .page-header-content h1 {
            font-size: 20px;
        }

        .modern-card-body {
            padding: 16px;
        }

        .search-section {
            padding: 16px;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 12px 8px;
        }

        .btn-action {
            width: 34px;
            height: 34px;
            margin: 0 2px;
        }

        .action-buttons {
            gap: 4px;
        }
    }

    /* Animation for page load */
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

    .page-header,
    .modern-card {
        animation: fadeInUp 0.5s ease-out;
    }

    .modern-card {
        animation-delay: 0.1s;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <h1>
            <i class="fas fa-database"></i>
            Master Akun AAS
        </h1>
        <p>Kelola data akun Anggaran Aktivitas Satuan (AAS)</p>
    </div>
</div>

<!-- Alert Messages -->
@if (Session::get('success'))
<div class="alert alert-success">
    <i class="fas fa-check-circle"></i>
    <span>{{ Session::get('success') }}</span>
</div>
@endif

@if (Session::get('warning'))
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle"></i>
    <span>{{ Session::get('warning') }}</span>
</div>
@endif

<!-- Main Card -->
<div class="modern-card">
    <div class="modern-card-header">
        <h6 class="modern-card-title">
            <i class="fas fa-list"></i>
            Daftar Akun AAS
        </h6>
        @if (Auth::user()->level == 'admin')
        <button class="btn-modern btn-primary-modern" id="btnTambahAas">
            <i class="fas fa-plus"></i>
            Tambah Data
        </button>
        @endif
    </div>

    <div class="modern-card-body">
        <!-- Search Section -->
        <div class="search-section">
            <form action="/master/aas" method="GET">
                <div class="d-flex gap-2 align-items-end flex-wrap flex-md-nowrap">
                    <div class="flex-fill">
                        <label class="form-label">Pencarian</label>
                        <input type="text" class="form-control-modern" name="nama_akunaas" id="nama_akunaas"
                            placeholder="Cari berdasarkan nama akun..." value="{{ Request('nama_akunaas') }}">
                    </div>
                    <div class="flex-shrink-0" style="width: auto;">
                        <button type="submit" class="btn-modern btn-primary-modern" style="white-space: nowrap; padding: 13px 24px;">
                            <i class="fas fa-search"></i>
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="scroll-hint">
            <i class="fas fa-info-circle"></i>
            Geser tabel ke kanan untuk melihat lebih banyak
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 50%;">Informasi Akun</th>
                        <th style="width: 12%;">Status</th>
                        @if (Auth::user()->level == 'admin')
                        <th style="width: 18%;" class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aas as $d)
                    <tr>
                        <td>{{ $loop->iteration + $aas->firstItem() - 1 }}</td>
                        <td>
                            <div class="stacked-info">
                                <div class="info-code">
                                    <span class="badge-modern badge-primary">
                                        {{ $d->kode_aas }}
                                    </span>
                                </div>
                                <div class="info-name">{{ $d->nama_aas }}</div>
                                <div class="info-divider"></div>
                                <div class="info-category">
                                    @if ($d->kategori == 'pembentukan')
                                    <span class="badge-modern badge-primary">Pembentukan Kas</span>
                                    @elseif ($d->kategori == 'pengisian')
                                    <span class="badge-modern badge-success">Pengisian Kas Kecil</span>
                                    @elseif ($d->kategori == 'pengeluaran')
                                    <span class="badge-modern badge-warning">Pengeluaran Kas Kecil</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            @if ($d->status == 'k')
                            <span class="badge-modern badge-success">Kredit</span>
                            @elseif ($d->status == 'd')
                            <span class="badge-modern badge-info">Debit</span>
                            @endif
                        </td>
                        @if (Auth::user()->level == 'admin')
                        <td class="text-center">
                            <div class="action-buttons">
                                <button class="btn-action btn-edit edit" id="{{ $d->id }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="/master/aas/{{ $d->id }}/deleteaas" method="post">
                                    @csrf
                                    <button type="button" class="btn-action btn-delete delete-confirm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h3>Belum Ada Data</h3>
                                <p>Silakan tambahkan data akun AAS terlebih dahulu</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $aas->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Modal Input AAS -->
<div class="modal fade" id="modal-frmaas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle"></i>
                    Input Akun AAS
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/master/storeaas" id="frmaas" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_aas" class="form-label">Kode AAS</label>
                        <input type="text" name="kode_aas" id="kode_aas" class="form-control"
                            placeholder="Masukkan kode AAS">
                    </div>
                    <div class="form-group">
                        <label for="nama_aas" class="form-label">Nama Akun AAS</label>
                        <input type="text" name="nama_aas" id="nama_aas" class="form-control"
                            placeholder="Masukkan nama akun AAS">
                    </div>
                    <div class="form-group">
                        <label for="status" class="form-label">Status Akun</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">- Pilih Status -</option>
                            <option value="d">Debit</option>
                            <option value="k">Kredit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="form-label">Kategori Akun</label>
                        <select name="kategori" id="kategori" class="form-select">
                            <option value="">- Pilih Kategori -</option>
                            <option value="pembentukan">Pembentukan Kas</option>
                            <option value="pengisian">Pengisian Kas</option>
                            <option value="pengeluaran">Pengeluaran Kas</option>
                        </select>
                    </div>
                    <button type="button" class="btn-modern btn-success-modern w-100" id="btnSimpanData">
                        <i class="fas fa-save"></i>
                        Simpan Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit AAS -->
<div class="modal fade" id="modal-editAas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit"></i>
                    Edit Akun AAS
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loadeditform">
                <!-- Content will be loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@endpush

@push('after-script')
<script>
    $(function() {
        // Mask for kode_aas (max 10 digits)
        $("#kode_aas").mask('0000000000');

        // Show add modal
        $("#btnTambahAas").click(function() {
            $("#modal-frmaas").modal("show");
        });

        // Save data with validation
        $("#btnSimpanData").click(function(e) {
            e.preventDefault();

            var kode_aas = $("#kode_aas").val();
            var nama_aas = $("#nama_aas").val();
            var status = $("#status").val();
            var kategori = $("#kategori").val();

            if (kode_aas == "") {
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Kode AAS harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                }).then((result) => {
                    $("#kode_aas").focus();
                });
                return false;
            } else if (nama_aas == "") {
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Nama Akun AAS harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                }).then((result) => {
                    $("#nama_aas").focus();
                });
                return false;
            } else if (status == "") {
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Status Akun harus dipilih',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                }).then((result) => {
                    $("#status").focus();
                });
                return false;
            } else if (kategori == "") {
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Kategori Akun harus dipilih',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                }).then((result) => {
                    $("#kategori").focus();
                });
                return false;
            }

            // Submit form if all validations pass
            $("#frmaas").submit();
        });

        // Edit data
        $(".edit").click(function() {
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: '/master/editaas',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(respond) {
                    $('#loadeditform').html(respond);
                }
            });
            $("#modal-editAas").modal("show");
        });

        // Delete confirmation
        $(".delete-confirm").click(function(e) {
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
                title: "Yakin Hapus Data?",
                text: "Data akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#0053C5",
                cancelButtonColor: "#ef4444",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    });
</script>
@endpush