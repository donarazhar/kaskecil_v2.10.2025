@extends('layouts.sidebar')
@section('title', 'Pengisian Kas Kecil')
@section('header-title', 'Pengisian Kas')
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
.search-bar{padding:14px 20px;background:var(--gray-50);border-bottom:1px solid var(--gray-100);}
.search-row{display:flex;gap:10px;align-items:center;}
.search-wrap{position:relative;flex:1;}
.search-wrap i{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:13px;pointer-events:none;}
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
.info-stack{display:flex;flex-direction:column;gap:4px;}
.info-name{font-size:13px;font-weight:600;color:var(--gray-900);}
.info-codes{display:flex;gap:5px;flex-wrap:wrap;margin-bottom:2px;}
.info-detail{font-size:12px;color:var(--gray-500);}
.badge{display:inline-flex;align-items:center;padding:2px 8px;border-radius:5px;font-size:10.5px;font-weight:600;white-space:nowrap;}
.badge-blue{background:var(--blue-50);color:var(--blue);}
.badge-gray{background:var(--gray-100);color:var(--gray-600);}
.badge-green{background:var(--green-50);color:var(--green-700);}
.badge-red{background:var(--red-50);color:var(--red-700);}
/* Pencairan status badges */
.status-cair{display:inline-flex;align-items:center;gap:5px;padding:5px 12px;border-radius:8px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.3px;background:var(--green-50);color:var(--green-700);border:1px solid #bbf7d0;cursor:default;white-space:nowrap;}
.status-belum{display:inline-flex;align-items:center;gap:5px;padding:5px 12px;border-radius:8px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.3px;background:var(--red-50);color:var(--red-700);border:1px solid #fca5a5;text-decoration:none;white-space:nowrap;transition:background .15s,color .15s;}
.status-belum:hover{background:var(--red-600);color:#fff;}
/* Action buttons */
.act-btn{width:32px;height:32px;border:none;border-radius:7px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;transition:background .15s;font-size:12px;}
.act-edit{background:var(--blue-50);color:var(--blue);}
.act-edit:hover{background:var(--blue);color:#fff;}
.act-del{background:var(--red-50);color:var(--red-600);}
.act-del:hover{background:var(--red-600);color:#fff;}
.act-print{background:var(--green-50);color:var(--green-700);}
.act-print:hover{background:var(--green-700);color:#fff;}
.act-group{display:flex;align-items:center;gap:5px;justify-content:center;}
.empty-state{text-align:center;padding:60px 20px;}
.empty-state i{font-size:48px;color:var(--gray-300);display:block;margin-bottom:12px;}
.empty-state p{font-size:14px;color:var(--gray-400);margin:0;}
.pagi{padding:16px 20px;border-top:1px solid var(--gray-100);display:flex;justify-content:center;}
.pagi .pagination{margin:0;}
.pagi .page-link{font-size:13px;color:var(--blue);border-color:var(--gray-200);border-radius:8px !important;}
.pagi .page-item.active .page-link{background:var(--blue);border-color:var(--blue);color:#fff;}
/* Modal */
.modal-content{border:none;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.15);}
.modal-header{padding:18px 22px 14px;border-bottom:1px solid var(--gray-100);border-radius:16px 16px 0 0;}
.modal-title-text{font-size:15px;font-weight:700;color:var(--gray-900);display:flex;align-items:center;gap:8px;margin:0;}
.modal-title-text i{color:var(--blue);}
.modal-body{padding:22px;}
.btn-close-x{width:30px;height:30px;border:none;border-radius:7px;background:var(--gray-100);color:var(--gray-500);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:13px;}
.btn-close-x:hover{background:var(--gray-200);}
/* Form */
.form-group{margin-bottom:16px;}
.form-lbl{display:block;font-size:13px;font-weight:600;color:var(--gray-700);margin-bottom:6px;}
.form-inp-m,.form-sel-m{width:100%;padding:9px 12px;border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px;color:var(--gray-900);background:#fff;transition:border-color .15s,box-shadow .15s;}
.form-inp-m:focus,.form-sel-m:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-50);}
.form-inp-m::placeholder{color:var(--gray-400);}
textarea.form-inp-m{min-height:80px;resize:vertical;}
@media(max-width:640px){.ph{flex-direction:column;align-items:flex-start;}.search-row{flex-wrap:wrap;}.data-table{font-size:12px;}.data-table thead th,.data-table tbody td{padding:9px 10px;}}
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
        <h2><i class="fas fa-hand-holding-usd"></i> Pengisian Kas Kecil</h2>
        <p>Kelola transaksi pengisian kas kecil dan pencairan</p>
    </div>
    @if(Auth::user()->level == 'admin')
    <button class="btn-blue" id="btnTambahPengisian"><i class="fas fa-plus"></i> Tambah Data</button>
    @endif
</div>

{{-- Main Panel --}}
<div class="panel fade-up">
    <div class="panel-header">
        <h6 class="panel-title"><i class="fas fa-list"></i> Data Pengisian Kas Kecil</h6>
        <span style="font-size:12px;color:var(--gray-400);">Total: {{ $paginator->total() }} data</span>
    </div>

    {{-- Search --}}
    <div class="search-bar">
        <form action="{{ url('/transaksi/pengisian') }}" method="GET">
            <div class="search-row">
                <div class="search-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-inp" name="search" placeholder="Cari kode, nama akun, perincian..." value="{{ $search ?? '' }}">
                </div>
                <button type="submit" class="btn-blue"><i class="fas fa-search"></i> <span class="d-none d-sm-inline">Cari</span></button>
                @if(!empty($search))
                <a href="{{ url('/transaksi/pengisian') }}" class="btn-outline"><i class="fas fa-times"></i></a>
                @endif
            </div>
        </form>
    </div>

    @if(!empty($search))
    <div style="padding:10px 20px;background:var(--blue-50);border-bottom:1px solid var(--blue-100);font-size:12px;color:var(--blue);">
        <i class="fas fa-info-circle"></i> Hasil pencarian: <strong>"{{ $search }}"</strong>
    </div>
    @endif

    {{-- Table --}}
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
                    <th style="text-align:center">Pencairan</th>
                    @if(Auth::user()->level == 'admin')
                    <th style="text-align:center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($paginator as $d)
                <tr>
                    <td style="color:var(--gray-400);font-size:11px;">{{ ($paginator->currentPage()-1)*$paginator->perPage()+$loop->iteration }}</td>
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
                    <td style="text-align:center">
                        @if(isset($d->id_pengisian))
                            @if(DB::table('transaksi')->where('id_pengisian', $d->id_pengisian)->exists())
                                <span class="status-cair"><i class="fas fa-check-circle"></i> Sudah Cair</span>
                            @elseif(DB::table('transaksi_shadow')->where('id_pengisian', $d->id_pengisian)->exists())
                                @if(Auth::user()->level == 'admin')
                                <a href="{{ route('cair', ['id' => $d->id_pengisian]) }}" class="status-belum cair-confirm">
                                    <i class="fas fa-times-circle"></i> Belum Cair
                                </a>
                                @endif
                            @endif
                        @endif
                    </td>
                    @if(Auth::user()->level == 'admin')
                    <td>
                        @if(isset($d->id_pengisian))
                            @if(DB::table('transaksi')->where('id_pengisian', $d->id_pengisian)->exists())
                            <div style="text-align:center;color:var(--gray-400);font-size:12px;">—</div>
                            @elseif(DB::table('transaksi_shadow')->where('id_pengisian', $d->id_pengisian)->exists())
                            <div class="act-group">
                                <button class="act-btn act-edit edit" id="{{ $d->id_pengisian }}" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                                <form action="{{ route('transaksi.destroy', $d->id_pengisian) }}" method="post" style="margin:0">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="act-btn act-del delete-confirm" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                                <form action="/transaksi/pengisian/{{ $d->id_pengisian }}/cetak" target="_blank" method="POST" style="margin:0">
                                    @csrf
                                    <button type="submit" class="act-btn act-print" title="Cetak"><i class="fas fa-print"></i></button>
                                </form>
                            </div>
                            @endif
                        @endif
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="8"><div class="empty-state"><i class="fas fa-inbox"></i><p>{{ !empty($search) ? 'Tidak ada hasil pencarian' : 'Belum ada data pengisian kas kecil' }}</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($paginator->hasPages())
    <div class="pagi">{{ $paginator->links('vendor.pagination.bootstrap-5') }}</div>
    @endif
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modal-frmpengisian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-text"><i class="fas fa-plus-circle"></i> Tambah Pengisian Kas</h5>
                <button type="button" class="btn-close-x" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form action="/transaksi/storepengisian" method="post" id="frmpengisian">
                    @csrf
                    <div class="form-group">
                        <label class="form-lbl">Mata Anggaran <span style="color:red">*</span></label>
                        <select name="kode_matanggaran" id="kode_matanggaran" class="form-sel-m">
                            <option value="">— Pilih Akun Mata Anggaran —</option>
                            @foreach($matanggaran as $m)
                            @if($m->status == 'k' && $m->kategori == 'pengisian')
                            <option value="{{ $m->kode_matanggaran }}">{{ $m->kode_matanggaran }} | {{ $m->nama_aas }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-lbl">Jumlah (Rp) <span style="color:red">*</span></label>
                        <input type="text" name="jumlah" id="jumlah" class="form-inp-m" placeholder="Masukkan jumlah">
                    </div>
                    <input type="hidden" name="kategori" value="pengisian">
                    <div class="form-group">
                        <label class="form-lbl">Tanggal <span style="color:red">*</span></label>
                        <input type="date" name="tanggal" id="tanggal" class="form-inp-m">
                    </div>
                    <div class="form-group">
                        <label class="form-lbl">Perincian <span style="color:red">*</span></label>
                        <textarea name="perincian" id="perincian" class="form-inp-m" placeholder="Masukkan perincian transaksi"></textarea>
                    </div>
                    <button type="submit" class="btn-blue w-100" style="justify-content:center;padding:11px;"><i class="fas fa-save"></i> Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="modal-editpengisian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-text"><i class="fas fa-pencil-alt"></i> Edit Pengisian Kas</h5>
                <button type="button" class="btn-close-x" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" id="loadeditform"></div>
        </div>
    </div>
</div>

@endsection

@push('after-script')
<script>
$(function () {
    $('#jumlah').mask('00.000.000', { reverse: true });

    $("#btnTambahPengisian").click(function () { $("#modal-frmpengisian").modal("show"); });

    $("#frmpengisian").submit(function (e) {
        var checks = [
            { val: $("#kode_matanggaran").val(), msg: 'Akun Mata Anggaran harus dipilih' },
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
        $("#modal-editpengisian").modal("show");
        $.ajax({ type:'POST', url:'/transaksi/pengisian/edit', data:{ _token:"{{ csrf_token() }}", id:id }, success:function(r){ $('#loadeditform').html(r); } });
    });

    $(".delete-confirm").click(function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({ title:'Yakin ingin hapus?', text:'Data akan dihapus secara permanen.', icon:'warning', showCancelButton:true, confirmButtonColor:'#0053C5', cancelButtonColor:'#ef4444', confirmButtonText:'Ya, Hapus!', cancelButtonText:'Batal' })
            .then(function (r) { if (r.isConfirmed) form.submit(); });
    });

    $(".cair-confirm").click(function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal.fire({ title:'Konfirmasi Pencairan', text:'Apa benar kas ini sudah cair?', icon:'question', showCancelButton:true, confirmButtonColor:'#0053C5', cancelButtonColor:'#ef4444', confirmButtonText:'Ya, Sudah Cair!', cancelButtonText:'Batal' })
            .then(function (r) { if (r.isConfirmed) window.location.href = url; });
    });

    @if(Session::has('success'))
    Swal.fire({ title:'Berhasil!', text:"{{ Session::get('success') }}", icon:'success', confirmButtonColor:'#0053C5', timer:3000 });
    @endif

    @if(Session::has('warning'))
    Swal.fire({ title:'Perhatian!', text:"{{ Session::get('warning') }}", icon:'error', confirmButtonColor:'#0053C5', confirmButtonText:'Tutup' });
    @endif

    setTimeout(function () { $('.flash-alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush
