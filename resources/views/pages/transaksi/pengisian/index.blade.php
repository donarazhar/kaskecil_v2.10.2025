@extends('layouts.sidebar')
@section('title', 'Pengisian')
@section('header-title', 'Pengisian Kas Kecil')

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
        margin-bottom: 24px;
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

    .table-responsive {
        border-radius: 12px;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
    }

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
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 14px;
        background: var(--white);
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

    .badge-primary {
        background: linear-gradient(135deg, var(--primary-light) 0%, #D1E5FF 100%);
        color: var(--primary-blue);
        border: 1px solid #A8D0FF;
    }

    .badge-danger {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        color: #991B1B;
        border: 1px solid #FCA5A5;
    }

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

    .btn-print {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        color: #065F46;
    }

    .btn-print:hover {
        background: var(--success);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

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

    .stacked-info {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .stacked-info .info-codes {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .stacked-info .info-name {
        font-weight: 700;
        color: var(--gray-900);
        font-size: 14px;
        line-height: 1.4;
    }

    .stacked-info .info-detail {
        font-size: 12px;
        color: var(--gray-600);
        line-height: 1.3;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .status-badge i {
        font-size: 14px;
    }

    .status-cair {
        background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
        color: #065F46;
        border: 2px solid #6EE7B7;
        cursor: default;
    }

    .status-belum-cair {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        color: #991B1B;
        border: 2px solid #FCA5A5;
    }

    .status-belum-cair:hover {
        background: var(--danger);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

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
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

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

    @media (max-width: 768px) {
        .page-header {
            padding: 24px 20px;
        }

        .page-header-content h1 {
            font-size: 22px;
        }

        .modern-card-header {
            padding: 20px;
        }

        .modern-card-body {
            padding: 20px;
        }

        .table-modern {
            font-size: 13px;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 14px 10px;
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
            <i class="fas fa-hand-holding-usd"></i> 
            Pengisian Kas Kecil
        </h1>
        <p>Kelola transaksi pengisian kas kecil dan pencairan</p>
    </div>
</div>

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

<div class="modern-card">
    <div class="modern-card-header">
        <h6 class="modern-card-title">
            <i class="fas fa-list"></i>
            Data Pengisian Kas Kecil
        </h6>
        @if (Auth::user()->level == 'admin')
        <button class="btn-modern btn-primary-modern" id="btnTambahPengisian">
            <i class="fas fa-plus"></i>
            Tambah Data
        </button>
        @endif
    </div>

    <div class="modern-card-body">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th style="width: 4%;">No</th>
                        <th style="width: 10%;">Tanggal</th>
                        <th style="width: 30%;">Informasi Akun</th>
                        <th style="width: 20%;">Perincian</th>
                        <th style="width: 8%;">Status</th>
                        <th style="width: 12%;" class="text-right">Jumlah</th>
                        <th style="width: 12%;" class="text-center">Pencairan</th>
                        @if (Auth::user()->level == 'admin')
                        <th style="width: 12%;" class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @forelse ($combinedData as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($d->tanggal)->isoFormat('DD/MM/YY') }}</td>
                        <td>
                            <div class="stacked-info">
                                <div class="info-codes">
                                    <span class="badge-modern badge-primary">{{ $d->kode_matanggaran }}</span>
                                    <span class="badge-modern badge-info">{{ $d->kode_aas }}</span>
                                </div>
                                <div class="info-name">{{ $d->nama_aas }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="info-detail">{{ $d->perincian }}</div>
                        </td>
                        <td>
                            @if ($d->status == 'k')
                            <span class="badge-modern badge-success">Kredit</span>
                            @elseif ($d->status == 'd')
                            <span class="badge-modern badge-danger">Debit</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <strong>Rp {{ number_format($d->jumlah, 0, ',', '.') }}</strong>
                        </td>
                        <td class="text-center">
                            @if (isset($d->id_pengisian))
                                @if (DB::table('transaksi')->where('id_pengisian', $d->id_pengisian)->exists())
                                    <span class="status-badge status-cair">
                                        <i class="fas fa-check-circle"></i>
                                        Sudah Cair
                                    </span>
                                @elseif (DB::table('transaksi_shadow')->where('id_pengisian', $d->id_pengisian)->exists())
                                    @if (Auth::user()->level == 'admin')
                                        <a href="{{ route('cair', ['id' => $d->id_pengisian]) }}" class="status-badge status-belum-cair">
                                            <i class="fas fa-times-circle"></i>
                                            Belum Cair
                                        </a>
                                    @endif
                                @endif
                            @endif
                        </td>
                        @if (isset($d->id_pengisian))
                            @if (DB::table('transaksi')->where('id_pengisian', $d->id_pengisian)->exists())
                                @if (Auth::user()->level == 'admin')
                                <td class="text-center">-</td>
                                @endif
                            @elseif (DB::table('transaksi_shadow')->where('id_pengisian', $d->id_pengisian)->exists())
                                @if (Auth::user()->level == 'admin')
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <button class="btn-action btn-edit edit" id="{{ $d->id_pengisian }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('transaksi.destroy', $d->id_pengisian) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn-action btn-delete delete-confirm" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <form action="/transaksi/pengisian/{{ $d->id_pengisian }}/cetak" target="_blank" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-action btn-print" title="Cetak">
                                                <i class="fas fa-print"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                            @endif
                        @endif
                        @php
                            $total += $d->jumlah;
                        @endphp
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h3>Belum Ada Data</h3>
                                <p>Silakan tambahkan data pengisian kas kecil</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-frmpengisian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Pengisian Kas Kecil
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/transaksi/storepengisian" method="post" id="frmpengisian">
                    @csrf
                    <div class="form-group">
                        <label for="kode_matanggaran" class="form-label">Mata Anggaran</label>
                        <select name="kode_matanggaran" id="kode_matanggaran" class="form-select">
                            <option value="">- Pilih Akun Mata Anggaran -</option>
                            @foreach ($matanggaran as $d)
                                @if ($d->status == 'k' && $d->kategori == 'pengisian')
                                    <option value="{{ $d->kode_matanggaran }}">
                                        {{ $d->kode_matanggaran }} | {{ $d->nama_aas }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                        <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan jumlah">
                    </div>
                    
                    <input type="hidden" name="kategori" id="kategori" value="pengisian">
                    
                    <div class="form-group">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="perincian" class="form-label">Perincian</label>
                        <textarea name="perincian" id="perincian" class="form-control" placeholder="Masukkan perincian transaksi"></textarea>
                    </div>
                    
                    <button type="submit" class="btn-modern btn-success-modern w-100">
                        <i class="fas fa-save"></i>
                        Simpan Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-editpengisian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit"></i>
                    Edit Pengisian Kas Kecil
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loadeditform"></div>
        </div>
    </div>
</div>

@endsection

@push('after-style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@endpush

@push('after-script')
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

<script>
    $(function() {
        $('#jumlah').mask('00.000.000', {
            reverse: true
        });

        $("#btnTambahPengisian").click(function() {
            $("#modal-frmpengisian").modal("show");
        });

        $("#frmpengisian").submit(function(e) {
            var kode_matanggaran = $("#kode_matanggaran").val();
            var jumlah = $("#jumlah").val();
            var tanggal = $("#tanggal").val();
            var perincian = $("#perincian").val();
            
            if (kode_matanggaran == "") {
                e.preventDefault();
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Akun Mata Anggaran harus dipilih',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                });
                return false;
            } else if (jumlah == "") {
                e.preventDefault();
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Jumlah harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                });
                return false;
            } else if (tanggal == "") {
                e.preventDefault();
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Tanggal harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                });
                return false;
            } else if (perincian == "") {
                e.preventDefault();
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Perincian harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                });
                return false;
            }
        });

        $(".edit").click(function() {
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: '/transaksi/pengisian/edit',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(respond) {
                    $('#loadeditform').html(respond);
                }
            });
            $("#modal-editpengisian").modal("show");
        });

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

        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    });
</script>
@endpush