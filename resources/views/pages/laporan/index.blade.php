@extends('layouts.sidebar')
@section('title', 'Laporan Kas Kecil')
@section('header-title', 'Laporan Kas Kecil')

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

    body {
        background-color: var(--gray-50);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

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
    }

    .modern-card {
        background: var(--white);
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-100);
        overflow: hidden;
    }

    .modern-card-header {
        padding: 24px 32px;
        border-bottom: 1px solid var(--gray-100);
        background: var(--white);
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

    .info-banner {
        background: linear-gradient(135deg, var(--primary-lighter) 0%, #E0EFFF 100%);
        border-left: 4px solid var(--primary-blue);
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .info-banner-icon {
        width: 48px;
        height: 48px;
        background: var(--primary-blue);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-banner-icon i {
        font-size: 24px;
        color: var(--white);
    }

    .info-banner-content h4 {
        font-size: 16px;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0 0 4px 0;
    }

    .info-banner-content p {
        font-size: 14px;
        color: var(--gray-600);
        margin: 0;
    }

    .form-section {
        background: var(--gray-50);
        border-radius: 16px;
        padding: 28px;
        border: 2px dashed var(--gray-200);
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        color: var(--gray-700);
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .form-control {
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

    .form-control:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 4px var(--primary-lighter);
        outline: none;
    }

    .btn-modern {
        padding: 13px 28px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        text-decoration: none;
        box-shadow: var(--shadow-sm);
        width: 100%;
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

    .date-range-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-700);
        text-align: center;
        padding: 0 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .date-range-icon {
        font-size: 20px;
        color: var(--primary-blue);
    }

    /* Quick Date Buttons */
    .quick-dates {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .quick-date-btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        border: 2px solid var(--gray-200);
        background: var(--white);
        color: var(--gray-700);
        cursor: pointer;
        transition: all 0.3s ease;
        flex: 1;
        min-width: 120px;
    }

    .quick-date-btn:hover {
        border-color: var(--primary-blue);
        background: var(--primary-lighter);
        color: var(--primary-blue);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 24px 20px;
        }

        .page-header-content h1 {
            font-size: 22px;
        }

        .modern-card-body {
            padding: 20px;
        }

        .form-section {
            padding: 20px;
        }

        .date-range-label {
            padding: 10px 0;
        }

        .quick-dates {
            flex-direction: column;
        }

        .quick-date-btn {
            min-width: 100%;
        }
    }

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
</style>

<div class="page-header">
    <div class="page-header-content">
        <h1>
            <i class="fas fa-file-alt"></i> 
            Laporan Kas Kecil
        </h1>
        <p>Cetak laporan kas kecil berdasarkan periode tanggal</p>
    </div>
</div>

<div class="modern-card">
    <div class="modern-card-header">
        <h6 class="modern-card-title">
            <i class="fas fa-print"></i>
            Cetak Laporan
        </h6>
    </div>

    <div class="modern-card-body">
        <!-- Info Banner -->
        <div class="info-banner">
            <div class="info-banner-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="info-banner-content">
                <h4>Panduan Cetak Laporan</h4>
                <p>Pilih tanggal awal dan tanggal akhir periode, kemudian klik tombol Cetak Laporan untuk menghasilkan dokumen PDF</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <form action="{{ url('/laporan/cetaklaporan') }}" method="GET" target="_blank" id="formLaporan">
                @csrf

                <div class="row align-items-center">
                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <label for="tanggalawal" class="form-label">
                            <i class="fas fa-calendar-alt"></i> Tanggal Awal
                        </label>
                        <input type="date" name="tanggalawal" id="tanggalawal" class="form-control" required>
                    </div>

                    <div class="col-lg-2 mb-3 mb-lg-0">
                        <div class="date-range-label">
                            <i class="fas fa-arrow-right date-range-icon"></i>
                        </div>
                    </div>

                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <label for="tanggalakhir" class="form-label">
                            <i class="fas fa-calendar-check"></i> Tanggal Akhir
                        </label>
                        <input type="date" name="tanggalakhir" id="tanggalakhir" class="form-control" required>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <button type="submit" name="tampilkan" class="btn-modern btn-primary-modern">
                            <i class="fas fa-print"></i>
                            Cetak Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('after-style')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@endpush