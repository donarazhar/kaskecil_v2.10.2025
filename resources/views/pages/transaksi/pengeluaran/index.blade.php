@extends('layouts.sidebar')
@section('title', 'Pengeluaran Kas Kecil')
@section('header-title', 'Pengeluaran Kas')
@section('content')
<style>
:root{--blue:#0053C5;--blue-dk:#003d91;--blue-50:#eff6ff;--blue-100:#dbeafe;--green-50:#f0fdf4;--green-700:#15803d;--red-50:#fef2f2;--red-600:#dc2626;--red-700:#b91c1c;--amber-50:#fffbeb;--amber-700:#b45309;--gray-50:#f9fafb;--gray-100:#f3f4f6;--gray-200:#e5e7eb;--gray-400:#9ca3af;--gray-500:#6b7280;--gray-600:#4b5563;--gray-700:#374151;--gray-800:#1f2937;--gray-900:#111827;}
.flash-alert{display:flex;align-items:center;gap:10px;padding:14px 18px;border-radius:10px;font-size:13px;font-weight:500;margin-bottom:16px;}
.flash-success{background:var(--green-50);color:var(--green-700);border:1px solid #bbf7d0;}
.flash-warning{background:var(--amber-50);color:var(--amber-700);border:1px solid #fde68a;}
.flash-info{background:var(--blue-50);color:var(--blue);border:1px solid var(--blue-100);}
.ph{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;}
.ph-left h2{font-size:22px;font-weight:700;color:var(--gray-900);margin:0 0 2px;display:flex;align-items:center;gap:8px;}
.ph-left h2 i{color:var(--blue);font-size:20px;}
.ph-left p{font-size:13px;color:var(--gray-500);margin:0;}
.panel{background:#fff;border:1px solid var(--gray-100);border-radius:14px;overflow:hidden;margin-bottom:16px;}
.panel-header{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;padding:16px 20px;border-bottom:1px solid var(--gray-100);}
.panel-title{font-size:14px;font-weight:700;color:var(--gray-800);display:flex;align-items:center;gap:8px;margin:0;}
.panel-title i{color:var(--blue);}
.filter-bar{padding:16px 20px;background:var(--gray-50);border-bottom:1px solid var(--gray-100);}
.filter-row{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;}
.search-row{display:flex;gap:10px;align-items:center;}
.search-wrap{position:relative;flex:1;}
.search-wrap i{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:13px;pointer-events:none;}
.field-lbl{display:block;font-size:11px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.4px;margin-bottom:5px;}
.form-inp,.form-sel{width:100%;padding:9px 12px;border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px;color:var(--gray-800);background:#fff;transition:border-color .15s,box-shadow .15s;}
.form-inp:focus,.form-sel:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-50);}
.search-inp{width:100%;padding:9px 12px 9px 36px;border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px;color:var(--gray-800);background:#fff;transition:border-color .15s,box-shadow .15s;}
.search-inp:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-50);}
.search-inp::placeholder{color:var(--gray-400);}
.btn-blue{display:inline-flex;align-items:center;gap:7px;padding:9px 16px;background:var(--blue);color:#fff;border:none;border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;white-space:nowrap;transition:background .15s,transform .15s;}
.btn-blue:hover{background:var(--blue-dk);color:#fff;transform:translateY(-1px);}
.btn-outline{display:inline-flex;align-items:center;gap:7px;padding:9px 14px;background:#fff;color:var(--gray-600);border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;white-space:nowrap;}
.btn-outline:hover{background:var(--gray-50);color:var(--gray-700);}
.tbl-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;}
.tbl-wrap::-webkit-scrollbar{height:4px;}
.tbl-wrap::-webkit-scrollbar-thumb{background:var(--gray-200);border-radius:4px;}
.data-table{width:100%;border-collapse:collapse;font-size:13px;}
.data-table thead th{background:var(--gray-50);padding:10px 14px;text-align:left;font-size:10.5px;font-weight:700;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;border-bottom:1px solid var(--gray-200);white-space:nowrap;}
.data-table tbody td{padding:12px 14px;border-bottom:1px solid var(--gray-50);color:var(--gray-700);vertical-align:middle;}
.data-table tbody tr:last-child td{border-bottom:none;}
.data-table tbody tr:hover td{background:var(--blue-50);}
.data-table tfoot th{padding:12px 14px;background:var(--blue-50);color:var(--blue);font-size:13px;font-weight:700;border-top:1px solid var(--blue-100);}
.info-stack{display:flex;flex-direction:column;gap:4px;}
.info-name{font-size:13px;font-weight:600;color:var(--gray-900);}
.info-codes{display:flex;gap:5px;flex-wrap:wrap;margin-bottom:2px;}
.info-detail{font-size:12px;color:var(--gray-500);}
.badge{display:inline-flex;align-items:center;padding:2px 8px;border-radius:5px;font-size:10.5px;font-weight:600;white-space:nowrap;}
.badge-blue{background:var(--blue-50);color:var(--blue);}
.badge-gray{background:var(--gray-100);color:var(--gray-600);}
.badge-green{background:var(--green-50);color:var(--green-700);}
.badge-red{background:var(--red-50);color:var(--red-700);}
.act-btn{width:32px;height:32px;border:none;border-radius:7px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;transition:background .15s;font-size:12px;}
.act-edit{background:var(--blue-50);color:var(--blue);}
.act-edit:hover{background:var(--blue);color:#fff;}
.act-del{background:var(--red-50);color:var(--red-600);}
.act-del:hover{background:var(--red-600);color:#fff;}
.act-view{background:var(--amber-50);color:var(--amber-700);}
.act-view:hover{background:var(--amber-700);color:#fff;}
.act-group{display:flex;align-items:center;gap:5px;justify-content:center;}
.empty-state{text-align:center;padding:60px 20px;}
.empty-state i{font-size:48px;color:var(--gray-300);display:block;margin-bottom:12px;}
.empty-state p{font-size:14px;color:var(--gray-400);margin:0;}
.pagi{padding:16px 20px;border-top:1px solid var(--gray-100);display:flex;justify-content:center;}
.pagi .pagination{margin:0;}
.pagi .page-link{font-size:13px;color:var(--blue);border-color:var(--gray-200);border-radius:8px !important;}
.pagi .page-item.active .page-link{background:var(--blue);border-color:var(--blue);color:#fff;}
.modal-content{border:none;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.15);}
.modal-header{padding:18px 22px 14px;border-bottom:1px solid var(--gray-100);border-radius:16px 16px 0 0;}
.modal-title-text{font-size:15px;font-weight:700;color:var(--gray-900);display:flex;align-items:center;gap:8px;margin:0;}
.modal-title-text i{color:var(--blue);}
.modal-body{padding:22px;}
.btn-close-x{width:30px;height:30px;border:none;border-radius:7px;background:var(--gray-100);color:var(--gray-500);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:13px;}
.btn-close-x:hover{background:var(--gray-200);}
.form-group{margin-bottom:16px;}
.form-lbl{display:block;font-size:13px;font-weight:600;color:var(--gray-700);margin-bottom:6px;}
.form-inp-m,.form-sel-m{width:100%;padding:9px 12px;border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px;color:var(--gray-900);background:#fff;transition:border-color .15s,box-shadow .15s;}
.form-inp-m:focus,.form-sel-m:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-50);}
.form-inp-m::placeholder{color:var(--gray-400);}
textarea.form-inp-m{min-height:80px;resize:vertical;}
.preview-thumb{border-radius:8px;overflow:hidden;border:1.5px solid var(--gray-200);margin-top:8px;}
.preview-thumb img{width:100%;display:block;}
@media(max-width:640px){.filter-row{grid-template-columns:1fr;}.ph{flex-direction:column;align-items:flex-start;}.data-table{font-size:12px;}.data-table thead th,.data-table tbody td{padding:9px 10px;}}
.fade-up{animation:fadeUp .3s ease both;}
@keyframes fadeUp{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
</style>

{{-- Flash --}}
@if(Session::get('success'))
<div class="flash-alert flash-success fade-up"><i class="fas fa-check-circle"></i><span>{{ Session::get('success') }}</span></div>
@endif
@if(Session::get('warning'))
<div class="flash-alert flash-warning fade-up"><i class="fas fa-exclamation-triangle"></i><span>{{ Session::get('warning') }}</span></div>
@endif

{{-- Page Header --}}
<div class="ph fade-up">
    <div class="ph-left">
        <h2><i class="fas fa-money-bill-wave"></i> Pengeluaran Kas Kecil</h2>
        <p>Kelola transaksi pengeluaran kas kecil</p>
    </div>
    @if(Auth::user()->level == 'admin')
    <button class="btn-blue" id="btnTambahPengeluaran"><i class="fas fa-plus"></i> Tambah Data</button>
    @endif
</div>

{{-- Filter Panel --}}
<div class="panel fade-up">
    <div class="filter-bar">
        <form action="{{ url('/transaksi/pengeluaran') }}" method="GET" id="filterForm">
            <div class="filter-row">
                <div>
                    <label class="field-lbl">Bulan</label>
                    <select name="bulan" id="bulan" class="form-sel" onchange="this.form.submit()">
                        @for($i=1;$i<=12;$i++)
                        <option value="{{ $i }}" {{ ($bulan??date('m'))==$i?'selected':'' }}>{{ $namabulan[$i] }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="field-lbl">Tahun</label>
                    <select name="tahun" id="tahun" class="form-sel" onchange="this.form.submit()">
                        @for($y=2023;$y<=date('Y');$y++)
                        <option value="{{ $y }}" {{ ($tahun??date('Y'))==$y?'selected':'' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="search-row">
                <div class="search-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-inp" name="search" placeholder="Cari kode, nama akun, perincian..." value="{{ $search??'' }}">
                </div>
                <button type="submit" class="btn-blue"><i class="fas fa-search"></i> <span class="d-none d-sm-inline">Cari</span></button>
                @if(!empty($search))
                <a href="{{ url('/transaksi/pengeluaran') }}?bulan={{ $bulan }}&tahun={{ $tahun }}" class="btn-outline"><i class="fas fa-times"></i></a>
                @endif
            </div>
        </form>
    </div>
</div>

@if(!empty($search))
<div class="flash-alert flash-info fade-up"><i class="fas fa-info-circle"></i><span>Hasil pencarian: <strong>"{{ $search }}"</strong></span></div>
@endif

{{-- Data Panel --}}
<div class="panel fade-up">
    <div class="panel-header">
        <h6 class="panel-title"><i class="fas fa-list"></i> Data Pengeluaran</h6>
        <span style="font-size:12px;color:var(--gray-400);">Total: {{ $pengeluaranbulanini->total() }} data</span>
    </div>
    <div class="tbl-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Tanggal</th>
                    <th>Informasi Akun</th>
                    <th>Perincian</th>
                    <th>Status</th>
                    <th class="text-right">Jumlah</th>
                    <th style="text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluaranbulanini as $d)
                <tr>
                    <td style="color:var(--gray-400);font-size:11px;">{{ ($pengeluaranbulanini->currentPage()-1)*$pengeluaranbulanini->perPage()+$loop->iteration }}</td>
                    <td style="white-space:nowrap;font-size:12px;">{{ \Carbon\Carbon::parse($d->tanggal)->isoFormat('DD MMM YY') }}</td>
                    <td>
                        <div class="info-stack">
                            <div class="info-codes">
                                <span class="badge badge-blue">{{ $d->kode_matanggaran }}</span>
                                <span class="badge badge-gray">{{ $d->kode_aas }}</span>
                            </div>
                            <span class="info-name">{{ $d->nama_aas }}</span>
                        </div>
                    </td>
                    <td><span class="info-detail">{{ Str::limit($d->perincian, 50) }}</span></td>
                    <td>
                        @if($d->status=='k') <span class="badge badge-green">Kredit</span>
                        @elseif($d->status=='d') <span class="badge badge-red">Debit</span>
                        @endif
                    </td>
                    <td style="text-align:right;font-weight:700;white-space:nowrap;">Rp {{ number_format($d->jumlah,0,',','.') }}</td>
                    <td>
                        <div class="act-group">
                            <button class="act-btn act-view lihat" id="{{ $d->id }}" title="Lihat Lampiran"><i class="fas fa-image"></i></button>
                            @if(Auth::user()->level=='admin')
                            <button class="act-btn act-edit edit" id="{{ $d->id }}" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <form action="/transaksi/hapuspengeluaran/{{ $d->id }}" method="post" style="margin:0">
                                @csrf
                                <button type="button" class="act-btn act-del delete-confirm" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7"><div class="empty-state"><i class="fas fa-inbox"></i><p>{{ !empty($search)?'Tidak ada hasil pencarian':'Belum ada data pengeluaran' }}</p></div></td></tr>
                @endforelse
            </tbody>
            @if($pengeluaranbulanini->count()>0)
            <tfoot>
                <tr>
                    <th colspan="4" style="font-size: 14px; text-transform: uppercase;">Total Pengeluaran — {{ $namabulan[(int)($bulan??date('m'))] }} {{ $tahun??date('Y') }}</th>
                    <th colspan="3" style="text-align: right; font-size: 16px; font-weight: 800; color: var(--blue-dk);">Rp {{ number_format($totalpengeluaran->total_pengeluaran??0,0,',','.') }}</th>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
    @if($pengeluaranbulanini->hasPages())
    <div class="pagi">{{ $pengeluaranbulanini->links('vendor.pagination.bootstrap-5') }}</div>
    @endif
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modal-frmpengeluaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-text"><i class="fas fa-plus-circle"></i> Tambah Pengeluaran</h5>
                <button type="button" class="btn-close-x" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('transaksi.store') }}" method="post" id="frmpengeluaran" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-lbl">Mata Anggaran <span style="color:red">*</span></label>
                                <select name="kode_matanggaran" id="kode_matanggaran" class="form-sel-m">
                                    <option value="">— Pilih Mata Anggaran —</option>
                                    @foreach($matanggaran as $m)
                                    @if($m->status=='d' && $m->kategori=='pengeluaran')
                                    <option value="{{ $m->kode_matanggaran }}">{{ $m->kode_matanggaran }} | {{ $m->nama_aas }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-lbl">Jumlah (Rp) <span style="color:red">*</span></label>
                                <input type="text" name="jumlah" id="jumlah" class="form-inp-m" placeholder="Masukkan jumlah">
                            </div>
                            <div class="form-group">
                                <label class="form-lbl">Tanggal <span style="color:red">*</span></label>
                                <input type="date" name="tanggal" id="tanggal" class="form-inp-m">
                            </div>
                            <div class="form-group">
                                <label class="form-lbl">Perincian <span style="color:red">*</span></label>
                                <textarea name="perincian" id="perincian" class="form-inp-m" placeholder="Perincian transaksi"></textarea>
                            </div>
                            <input type="hidden" name="kategori" value="pengeluaran">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-lbl">Lampiran (Maks 3 file)</label>
                                <input class="form-inp-m mb-2" type="file" name="lampiran" accept="image/*" onchange="previewImage('lampiran','prev1','prev-c1')">
                                <div id="prev-c1" class="preview-thumb" style="display:none"><img id="prev1" src="#" alt="Preview"></div>
                                <input class="form-inp-m mb-2 mt-2" type="file" name="lampiran2" accept="image/*" onchange="previewImage('lampiran2','prev2','prev-c2')">
                                <div id="prev-c2" class="preview-thumb" style="display:none"><img id="prev2" src="#" alt="Preview"></div>
                                <input class="form-inp-m mt-2" type="file" name="lampiran3" accept="image/*" onchange="previewImage('lampiran3','prev3','prev-c3')">
                                <div id="prev-c3" class="preview-thumb" style="display:none"><img id="prev3" src="#" alt="Preview"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-blue w-100 mt-2" style="justify-content:center;padding:11px;"><i class="fas fa-save"></i> Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="modal-editpengeluaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-text"><i class="fas fa-pencil-alt"></i> Edit Pengeluaran</h5>
                <button type="button" class="btn-close-x" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" id="loadeditform"></div>
        </div>
    </div>
</div>

{{-- Modal Lampiran --}}
<div class="modal fade" id="modal-lihatlampiran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-text"><i class="fas fa-image"></i> Lampiran Pengeluaran</h5>
                <button type="button" class="btn-close-x" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" id="loadeditformlihat"></div>
        </div>
    </div>
</div>

@endsection

@push('after-script')
<script>
function previewImage(inputId, previewId, containerId) {
    var file = document.getElementById(inputId).files[0];
    var container = document.getElementById(containerId);
    var preview = document.getElementById(previewId);
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) { preview.src = e.target.result; container.style.display = 'block'; };
        reader.readAsDataURL(file);
    } else { container.style.display = 'none'; }
}

$(function () {
    $('#jumlah').mask('00.000.000', { reverse: true });

    $("#btnTambahPengeluaran").click(function () { $("#modal-frmpengeluaran").modal("show"); });

    $("#frmpengeluaran").submit(function (e) {
        var checks = [
            { val: $("#kode_matanggaran").val(), msg: 'Mata Anggaran harus dipilih' },
            { val: $("#jumlah").val(),            msg: 'Jumlah harus diisi' },
            { val: $("#tanggal").val(),           msg: 'Tanggal harus diisi' },
            { val: $("#perincian").val().trim(),  msg: 'Perincian harus diisi' },
        ];
        for (var i = 0; i < checks.length; i++) {
            if (!checks[i].val) {
                e.preventDefault();
                Swal.fire({ icon: 'warning', title: 'Perhatian!', text: checks[i].msg, confirmButtonColor: '#0053C5' });
                return false;
            }
        }
    });

    $(".edit").click(function () {
        var id = $(this).attr('id');
        $('#loadeditform').html('<div style="text-align:center;padding:40px"><i class="fas fa-spinner fa-spin fa-2x" style="color:#0053C5"></i></div>');
        $("#modal-editpengeluaran").modal("show");
        $.ajax({ type:'POST', url:'/transaksi/pengeluaran/edit', data:{ _token:"{{ csrf_token() }}", id:id }, success:function(r){ $('#loadeditform').html(r); } });
    });

    $(".lihat").click(function () {
        var id = $(this).attr('id');
        $('#loadeditformlihat').html('<div style="text-align:center;padding:40px"><i class="fas fa-spinner fa-spin fa-2x" style="color:#0053C5"></i></div>');
        $("#modal-lihatlampiran").modal("show");
        $.ajax({ type:'POST', url:'/transaksi/pengeluaran/lihat', data:{ _token:"{{ csrf_token() }}", id:id }, success:function(r){ $('#loadeditformlihat').html(r); } });
    });

    $(".delete-confirm").click(function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({ title:'Yakin ingin hapus?', text:'Data akan dihapus secara permanen.', icon:'warning', showCancelButton:true, confirmButtonColor:'#0053C5', cancelButtonColor:'#ef4444', confirmButtonText:'Ya, Hapus!', cancelButtonText:'Batal' })
            .then(function (r) { if (r.isConfirmed) form.submit(); });
    });

    setTimeout(function () { $('.flash-alert').fadeOut('slow'); }, 5000);

    @if(Session::has('warning'))
    Swal.fire({
        title: 'Perhatian!',
        text: "{{ Session::get('warning') }}",
        icon: 'error',
        confirmButtonColor: '#0053C5',
        confirmButtonText: 'Tutup'
    });
    @endif

    @if(Session::has('success'))
    Swal.fire({
        title: 'Berhasil!',
        text: "{{ Session::get('success') }}",
        icon: 'success',
        confirmButtonColor: '#0053C5',
        confirmButtonText: 'Tutup',
        timer: 3000
    });
    @endif
});
</script>
@endpush
