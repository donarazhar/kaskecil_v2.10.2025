@extends('layouts.sidebar')
@section('title', 'Master Mata Anggaran')
@section('header-title', 'Master Mata Anggaran')

@section('content')

<style>
    :root {
        --blue:     #0053C5;
        --blue-dk:  #003d91;
        --blue-50:  #eff6ff;
        --blue-100: #dbeafe;
        --green-50: #f0fdf4; --green-700: #15803d;
        --red-50:   #fef2f2; --red-600:   #dc2626; --red-700: #b91c1c;
        --amber-50: #fffbeb; --amber-700: #b45309;
        --gray-50:  #f9fafb; --gray-100: #f3f4f6; --gray-200: #e5e7eb;
        --gray-300: #d1d5db; --gray-400: #9ca3af; --gray-500: #6b7280;
        --gray-600: #4b5563; --gray-700: #374151; --gray-800: #1f2937; --gray-900: #111827;
    }

    /* ── Flash ── */
    .flash-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 16px;
        animation: fadeSlide 0.3s ease both;
    }
    .flash-success { background: var(--green-50); color: var(--green-700); border: 1px solid #bbf7d0; }
    .flash-warning { background: var(--amber-50); color: var(--amber-700); border: 1px solid #fde68a; }
    @keyframes fadeSlide { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }

    /* ── Page header ── */
    .ph { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:20px; }
    .ph-left h2 { font-size:22px; font-weight:700; color:var(--gray-900); margin:0 0 2px; display:flex; align-items:center; gap:8px; }
    .ph-left h2 i { color:var(--blue); font-size:20px; }
    .ph-left p { font-size:13px; color:var(--gray-500); margin:0; }

    /* ── Panel ── */
    .panel { background:#fff; border:1px solid var(--gray-100); border-radius:14px; overflow:hidden; margin-bottom:20px; }
    .panel-header { display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; padding:16px 20px; border-bottom:1px solid var(--gray-100); }
    .panel-title { font-size:14px; font-weight:700; color:var(--gray-800); display:flex; align-items:center; gap:8px; margin:0; }
    .panel-title i { color:var(--blue); }

    /* ── Search ── */
    .search-bar { padding:16px 20px; background:var(--gray-50); border-bottom:1px solid var(--gray-100); }
    .search-row { display:flex; gap:10px; align-items:center; }
    .search-input-wrap { position:relative; flex:1; }
    .search-input-wrap i { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--gray-400); font-size:13px; pointer-events:none; }
    .search-input { width:100%; padding:10px 14px 10px 38px; border:1.5px solid var(--gray-200); border-radius:10px; font-size:13px; color:var(--gray-800); background:#fff; transition:border-color .15s, box-shadow .15s; }
    .search-input:focus { outline:none; border-color:var(--blue); box-shadow:0 0 0 3px var(--blue-50); }
    .search-input::placeholder { color:var(--gray-400); }

    /* ── Buttons ── */
    .btn-blue { display:inline-flex; align-items:center; gap:7px; padding:10px 18px; background:var(--blue); color:#fff; border:none; border-radius:10px; font-size:13px; font-weight:600; cursor:pointer; text-decoration:none; white-space:nowrap; transition:background .15s, transform .15s, box-shadow .15s; }
    .btn-blue:hover { background:var(--blue-dk); color:#fff; transform:translateY(-1px); box-shadow:0 4px 12px rgba(0,83,197,.25); }
    .btn-blue:active { transform:scale(.97); }
    .btn-outline { display:inline-flex; align-items:center; gap:7px; padding:10px 18px; background:#fff; color:var(--blue); border:1.5px solid var(--blue-100); border-radius:10px; font-size:13px; font-weight:600; cursor:pointer; text-decoration:none; white-space:nowrap; transition:background .15s; }
    .btn-outline:hover { background:var(--blue-50); color:var(--blue); }

    /* ── Table ── */
    .tbl-wrap { overflow-x:auto; -webkit-overflow-scrolling:touch; }
    .tbl-wrap::-webkit-scrollbar { height:5px; }
    .tbl-wrap::-webkit-scrollbar-thumb { background:var(--gray-200); border-radius:10px; }

    .data-table { width:100%; border-collapse:collapse; font-size:13.5px; }
    .data-table thead th { background:var(--gray-50); padding:11px 16px; text-align:left; font-size:11px; font-weight:700; color:var(--gray-500); text-transform:uppercase; letter-spacing:.5px; border-bottom:1px solid var(--gray-200); white-space:nowrap; }
    .data-table tbody td { padding:14px 16px; border-bottom:1px solid var(--gray-50); color:var(--gray-700); vertical-align:middle; }
    .data-table tbody tr:last-child td { border-bottom:none; }
    .data-table tbody tr:hover td { background:var(--blue-50); }

    /* ── Info stack ── */
    .info-stack { display:flex; flex-direction:column; gap:5px; }
    .info-name { font-size:14px; font-weight:600; color:var(--gray-900); }
    .info-codes { display:flex; align-items:center; gap:6px; flex-wrap:wrap; }

    /* ── Saldo ── */
    .saldo-val { font-size:14px; font-weight:700; color:var(--gray-900); }
    .saldo-sub { font-size:11px; color:var(--gray-400); margin-top:1px; }

    /* ── Badges ── */
    .badge { display:inline-flex; align-items:center; padding:3px 10px; border-radius:6px; font-size:11px; font-weight:600; white-space:nowrap; }
    .badge-blue   { background:var(--blue-50);  color:var(--blue); }
    .badge-gray   { background:var(--gray-100); color:var(--gray-600); }
    .badge-green  { background:var(--green-50); color:var(--green-700); }

    /* ── Action buttons ── */
    .act-btn { width:34px; height:34px; border:none; border-radius:8px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:background .15s, transform .15s; font-size:13px; }
    .act-btn:active { transform:scale(.93); }
    .act-edit { background:var(--blue-50); color:var(--blue); }
    .act-edit:hover { background:var(--blue); color:#fff; }
    .act-del  { background:var(--red-50);  color:var(--red-600); }
    .act-del:hover  { background:var(--red-600);  color:#fff; }
    .act-group { display:flex; align-items:center; gap:6px; }

    /* ── Empty state ── */
    .empty-state { text-align:center; padding:60px 20px; }
    .empty-state i { font-size:48px; color:var(--gray-300); display:block; margin-bottom:12px; }
    .empty-state p { font-size:14px; color:var(--gray-400); margin:0; }



    /* ── Modal ── */
    .modal-content { border:none; border-radius:16px; box-shadow:0 20px 60px rgba(0,0,0,.15); }
    .modal-header { padding:20px 24px 16px; border-bottom:1px solid var(--gray-100); border-radius:16px 16px 0 0; }
    .modal-title-text { font-size:16px; font-weight:700; color:var(--gray-900); display:flex; align-items:center; gap:8px; margin:0; }
    .modal-title-text i { color:var(--blue); }
    .modal-body { padding:24px; }
    .btn-close-custom { width:32px; height:32px; border:none; border-radius:8px; background:var(--gray-100); color:var(--gray-500); display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:14px; transition:background .15s; }
    .btn-close-custom:hover { background:var(--gray-200); }

    /* ── Form ── */
    .form-group { margin-bottom:18px; }
    .form-lbl { display:block; font-size:13px; font-weight:600; color:var(--gray-700); margin-bottom:7px; }
    .form-inp, .form-sel { width:100%; padding:10px 14px; border:1.5px solid var(--gray-200); border-radius:10px; font-size:13px; color:var(--gray-900); background:#fff; transition:border-color .15s, box-shadow .15s; }
    .form-inp:focus, .form-sel:focus { outline:none; border-color:var(--blue); box-shadow:0 0 0 3px var(--blue-50); }
    .form-inp::placeholder { color:var(--gray-400); }
    .form-sel { appearance:none; cursor:pointer; }

    /* ── Responsive ── */
    @media (max-width:640px) {
        .ph { flex-direction:column; align-items:flex-start; }
        .search-row { flex-wrap:wrap; }
        .data-table { font-size:13px; }
        .data-table thead th, .data-table tbody td { padding:10px 12px; }
    }

    /* ── Animate ── */
    .fade-up { animation:fadeUp .35s ease both; }
    .d1 { animation-delay:.05s; }
    .d2 { animation-delay:.10s; }
    @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
</style>

{{-- Flash --}}
@if(Session::get('success'))
<div class="flash-alert flash-success fade-up">
    <i class="fas fa-check-circle"></i>
    <span>{{ Session::get('success') }}</span>
</div>
@endif
@if(Session::get('warning'))
<div class="flash-alert flash-warning fade-up">
    <i class="fas fa-exclamation-triangle"></i>
    <span>{{ Session::get('warning') }}</span>
</div>
@endif

{{-- Page Header --}}
<div class="ph fade-up">
    <div class="ph-left">
        <h2><i class="fas fa-file-invoice-dollar"></i> Master Mata Anggaran</h2>
        <p>Kelola data akun mata anggaran dan alokasi saldo</p>
    </div>
    @if(Auth::user()->level == 'admin')
    <button class="btn-blue" id="btnTambahMatanggaran">
        <i class="fas fa-plus"></i> Tambah Data
    </button>
    @endif
</div>

{{-- Main Panel --}}
<div class="panel fade-up d1">
    <div class="panel-header">
        <h6 class="panel-title"><i class="fas fa-list"></i> Daftar Akun Mata Anggaran</h6>
        <span style="font-size:12px; color:var(--gray-400);">Total: {{ $matanggaran->total() }} data</span>
    </div>

    {{-- Search --}}
    <div class="search-bar">
        <form action="/master/matanggaran" method="GET">
            <div class="search-row">
                <div class="search-input-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-input" name="nama_akunaas"
                        placeholder="Cari nama akun mata anggaran..."
                        value="{{ Request('nama_akunaas') }}">
                </div>
                <button type="submit" class="btn-blue">
                    <i class="fas fa-search"></i>
                    <span class="d-none d-sm-inline">Cari</span>
                </button>
                @if(Request('nama_akunaas'))
                <a href="/master/matanggaran" class="btn-outline">
                    <i class="fas fa-times"></i>
                    <span class="d-none d-sm-inline">Reset</span>
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="tbl-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:50px">#</th>
                    <th>Informasi Akun</th>
                    <th>Saldo Anggaran</th>
                    @if(Auth::user()->level == 'admin')
                    <th style="width:100px; text-align:center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($matanggaran as $d)
                <tr>
                    <td style="color:var(--gray-400); font-size:12px;">{{ $loop->iteration + $matanggaran->firstItem() - 1 }}</td>
                    <td>
                        <div class="info-stack">
                            <div class="info-codes">
                                <span class="badge badge-blue">{{ $d->kode_matanggaran }}</span>
                                <span class="badge badge-gray">{{ $d->kode_aas }}</span>
                            </div>
                            <span class="info-name">{{ $d->nama_aas }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="saldo-val">Rp {{ number_format($d->saldo, 0, ',', '.') }}</div>
                        <div class="saldo-sub">Saldo tersedia</div>
                    </td>
                    @if(Auth::user()->level == 'admin')
                    <td>
                        <div class="act-group" style="justify-content:center">
                            <button class="act-btn act-edit edit" id="{{ $d->id }}" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <form action="/master/matanggaran/{{ $d->id }}/deletematanggaran" method="post" style="margin:0">
                                @csrf
                                <button type="button" class="act-btn act-del delete-confirm" title="Hapus">
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
                            <i class="fas fa-folder-open"></i>
                            <p>Belum ada data akun mata anggaran</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pagi">
        {{ $matanggaran->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

{{-- ─── MODAL TAMBAH ─── --}}
<div class="modal fade" id="modal-frmmatanggaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-text">
                    <i class="fas fa-plus-circle"></i> Tambah Mata Anggaran
                </h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="/master/storematanggaran" id="frmmatanggaran" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-lbl" for="kode_aas_sel">Nama Akun AAS <span style="color:red">*</span></label>
                        <select name="kode_aas" id="kode_aas_sel" class="form-sel">
                            <option value="">— Pilih Nama Anggaran —</option>
                            @foreach($aas as $a)
                            <option value="{{ $a->kode_aas }}">{{ $a->kode_aas }} | {{ $a->nama_aas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-lbl" for="kode_matanggaran">Kode Mata Anggaran <span style="color:red">*</span></label>
                        <input type="text" name="kode_matanggaran" id="kode_matanggaran" class="form-inp"
                            placeholder="Contoh: 1.2.3456">
                    </div>
                    <div class="form-group">
                        <label class="form-lbl" for="saldo_matanggaran">Saldo Anggaran <span style="color:red">*</span></label>
                        <input type="text" name="saldo_matanggaran" id="saldo_matanggaran" class="form-inp"
                            placeholder="Masukkan jumlah saldo">
                    </div>
                    <button type="button" class="btn-blue w-100 mt-2" id="btnSimpanData" style="justify-content:center; padding:12px;">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ─── MODAL EDIT ─── --}}
<div class="modal fade" id="modal-editmatanggaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-text">
                    <i class="fas fa-pencil-alt"></i> Edit Mata Anggaran
                </h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" id="loadeditform">
                {{-- Loaded via AJAX --}}
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-script')
<script>
$(function () {

    // Mask
    $("#kode_matanggaran").mask('0.0.0000');
    $('#saldo_matanggaran').mask("#.##0", { reverse: true });

    // Buka modal tambah
    $("#btnTambahMatanggaran").click(function () {
        $("#modal-frmmatanggaran").modal("show");
    });

    // Simpan data — validasi
    $("#btnSimpanData").click(function (e) {
        e.preventDefault();
        var kode_aas   = $("#kode_aas_sel").val();
        var kode_mata  = $("#kode_matanggaran").val().trim();
        var saldo      = $("#saldo_matanggaran").val().trim();

        var checks = [
            { val: kode_aas,  msg: 'Nama Akun AAS harus dipilih',       el: '#kode_aas_sel'       },
            { val: kode_mata, msg: 'Kode Mata Anggaran harus diisi',     el: '#kode_matanggaran'   },
            { val: saldo,     msg: 'Saldo Anggaran harus diisi',         el: '#saldo_matanggaran'  },
        ];

        for (var i = 0; i < checks.length; i++) {
            if (!checks[i].val) {
                var el = checks[i].el;
                Swal.fire({ icon:'warning', title:'Perhatian!', text: checks[i].msg, confirmButtonColor:'#0053C5' })
                    .then(function () { $(el).focus(); });
                return;
            }
        }

        $(this).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);
        $("#frmmatanggaran").submit();
    });

    // Edit data via AJAX
    $(".edit").click(function () {
        var id = $(this).attr('id');
        $('#loadeditform').html('<div style="text-align:center;padding:40px"><i class="fas fa-spinner fa-spin fa-2x" style="color:#0053C5"></i></div>');
        $("#modal-editmatanggaran").modal("show");
        $.ajax({
            type: 'POST',
            url: '/master/editmatanggaran',
            data: { _token: "{{ csrf_token() }}", id: id },
            success: function (respond) { $('#loadeditform').html(respond); },
            error: function () { $('#loadeditform').html('<p style="color:red;text-align:center">Gagal memuat data</p>'); }
        });
    });

    // Konfirmasi hapus
    $(".delete-confirm").click(function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: 'Yakin ingin hapus?',
            text: 'Data akan dihapus secara permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0053C5',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(function (r) { if (r.isConfirmed) form.submit(); });
    });

    // Auto-hide flash
    setTimeout(function () { $('.flash-alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush