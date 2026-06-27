@extends('layouts.sidebar')
@section('title', 'Laporan APCS')
@section('header-title', 'Laporan')
@section('content')
<style>
:root{--blue:#0053C5;--blue-dk:#003d91;--blue-50:#eff6ff;--blue-100:#dbeafe;--green-50:#f0fdf4;--green-700:#15803d;--gray-50:#f9fafb;--gray-100:#f3f4f6;--gray-200:#e5e7eb;--gray-400:#9ca3af;--gray-500:#6b7280;--gray-600:#4b5563;--gray-700:#374151;--gray-800:#1f2937;--gray-900:#111827;}
.ph{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;}
.ph-left h2{font-size:22px;font-weight:700;color:var(--gray-900);margin:0 0 2px;display:flex;align-items:center;gap:8px;}
.ph-left h2 i{color:var(--blue);font-size:20px;}
.ph-left p{font-size:13px;color:var(--gray-500);margin:0;}
.panel{background:#fff;border:1px solid var(--gray-100);border-radius:14px;overflow:hidden;margin-bottom:16px;}
.panel-header{padding:16px 20px;border-bottom:1px solid var(--gray-100);}
.panel-title{font-size:14px;font-weight:700;color:var(--gray-800);display:flex;align-items:center;gap:8px;margin:0;}
.panel-title i{color:var(--blue);}
.panel-body{padding:24px 20px;}

/* Info note */
.info-note{display:flex;align-items:flex-start;gap:12px;background:var(--blue-50);border:1px solid var(--blue-100);border-radius:10px;padding:14px 16px;margin-bottom:24px;}
.info-note-icon{width:36px;height:36px;background:var(--blue);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.info-note-icon i{color:#fff;font-size:16px;}
.info-note-body h5{font-size:13px;font-weight:700;color:var(--gray-900);margin:0 0 3px;}
.info-note-body p{font-size:12px;color:var(--gray-600);margin:0;line-height:1.5;}

/* Quick preset buttons */
.quick-row{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px;}
.quick-btn{padding:7px 14px;border:1.5px solid var(--gray-200);background:#fff;color:var(--gray-600);border-radius:8px;font-size:12px;font-weight:600;cursor:pointer;transition:border-color .15s,background .15s,color .15s;}
.quick-btn:hover,.quick-btn.active{border-color:var(--blue);background:var(--blue-50);color:var(--blue);}

/* Date fields */
.date-grid{display:grid;grid-template-columns:1fr auto 1fr;gap:12px;align-items:end;margin-bottom:20px;}
.date-sep{display:flex;align-items:center;justify-content:center;padding-bottom:2px;color:var(--blue);font-size:16px;}
.field-lbl{display:block;font-size:12px;font-weight:600;color:var(--gray-600);text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px;}
.form-inp{width:100%;padding:10px 12px;border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px;color:var(--gray-900);background:#fff;transition:border-color .15s,box-shadow .15s;}
.form-inp:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-50);}

/* Submit button */
.btn-cetak{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:12px;background:var(--blue);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;transition:background .15s,transform .15s,box-shadow .15s;text-decoration:none;}
.btn-cetak:hover{background:var(--blue-dk);color:#fff;transform:translateY(-1px);box-shadow:0 6px 20px rgba(0,83,197,.25);}
.btn-cetak:active{transform:scale(.97);}

/* Stat cards */
.stat-row{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:24px;}
.stat-card{background:var(--gray-50);border:1px solid var(--gray-100);border-radius:10px;padding:16px;text-align:center;}
.stat-card .stat-icon{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;margin:0 auto 8px;font-size:15px;}
.stat-card .stat-label{font-size:11px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.4px;margin-bottom:4px;}
.stat-card .stat-val{font-size:16px;font-weight:800;color:var(--gray-900);}

@media(max-width:640px){.date-grid{grid-template-columns:1fr;}.date-sep{display:none;}.stat-row{grid-template-columns:1fr;}.quick-row{flex-direction:column;}}
.fade-up{animation:fadeUp .3s ease both;}
@keyframes fadeUp{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
</style>

{{-- Page Header --}}
<div class="ph fade-up">
    <div class="ph-left">
        <h2><i class="fas fa-file-alt"></i> Laporan Kas Kecil</h2>
        <p>Cetak laporan kas kecil berdasarkan periode tanggal yang dipilih</p>
    </div>
</div>

{{-- Main Panel --}}
<div class="panel fade-up">
    <div class="panel-header">
        <h6 class="panel-title"><i class="fas fa-print"></i> Cetak Laporan</h6>
    </div>
    <div class="panel-body">

        {{-- Info Note --}}
        <div class="info-note">
            <div class="info-note-icon"><i class="fas fa-lightbulb"></i></div>
            <div class="info-note-body">
                <h5>Panduan Cetak Laporan</h5>
                <p>Pilih tanggal awal dan tanggal akhir periode laporan, atau gunakan tombol preset di bawah. Klik <strong>Cetak Laporan</strong> untuk membuka dokumen PDF di tab baru.</p>
            </div>
        </div>

        {{-- Preset quick dates --}}
        <div style="margin-bottom:10px;">
            <span style="font-size:11px;font-weight:700;color:var(--gray-500);text-transform:uppercase;letter-spacing:.4px;">Periode Cepat</span>
        </div>
        <div class="quick-row" id="quickRow">
            <button type="button" class="quick-btn" data-preset="bulanini"><i class="fas fa-calendar"></i> Bulan Ini</button>
            <button type="button" class="quick-btn" data-preset="bulanlalu"><i class="fas fa-history"></i> Bulan Lalu</button>
            <button type="button" class="quick-btn" data-preset="tahunini"><i class="fas fa-calendar-alt"></i> Tahun Ini</button>
            <button type="button" class="quick-btn" data-preset="q1">Q1 (Jan–Mar)</button>
            <button type="button" class="quick-btn" data-preset="q2">Q2 (Apr–Jun)</button>
            <button type="button" class="quick-btn" data-preset="q3">Q3 (Jul–Sep)</button>
            <button type="button" class="quick-btn" data-preset="q4">Q4 (Okt–Des)</button>
        </div>

        {{-- Form --}}
        <form action="{{ url('/laporan/cetaklaporan') }}" method="GET" target="_blank" id="formLaporan">
            <div class="date-grid">
                <div>
                    <label class="field-lbl"><i class="fas fa-calendar-alt" style="color:var(--blue)"></i> Tanggal Awal</label>
                    <input type="date" name="tanggalawal" id="tanggalawal" class="form-inp" required>
                </div>
                <div class="date-sep"><i class="fas fa-arrow-right"></i></div>
                <div>
                    <label class="field-lbl"><i class="fas fa-calendar-check" style="color:var(--blue)"></i> Tanggal Akhir</label>
                    <input type="date" name="tanggalakhir" id="tanggalakhir" class="form-inp" required>
                </div>
            </div>

            <button type="submit" name="tampilkan" class="btn-cetak">
                <i class="fas fa-print"></i> Cetak Laporan
            </button>
        </form>

        {{-- Stat preview cards --}}
        <div class="stat-row">
            <div class="stat-card">
                <div class="stat-icon" style="background:var(--blue-50)"><i class="fas fa-wallet" style="color:var(--blue)"></i></div>
                <div class="stat-label">Pembentukan</div>
                <div class="stat-val" style="color:var(--blue)">Rp {{ number_format($total_pembentukan ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:var(--green-50)"><i class="fas fa-hand-holding-usd" style="color:var(--green-700)"></i></div>
                <div class="stat-label">Pengisian</div>
                <div class="stat-val" style="color:var(--green-700)">Rp {{ number_format($total_pengisian ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#fef2f2"><i class="fas fa-money-bill-wave" style="color:#dc2626"></i></div>
                <div class="stat-label">Pengeluaran</div>
                <div class="stat-val" style="color:#dc2626">Rp {{ number_format($total_pengeluaran ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('after-script')
<script>
$(function () {
    var today = new Date();

    function fmt(d) {
        return d.toISOString().split('T')[0];
    }

    function setDates(awal, akhir, btn) {
        $('#tanggalawal').val(fmt(awal));
        $('#tanggalakhir').val(fmt(akhir));
        $('.quick-btn').removeClass('active');
        if (btn) $(btn).addClass('active');
    }

    $('.quick-btn').click(function () {
        var preset = $(this).data('preset');
        var y = today.getFullYear();
        var m = today.getMonth();

        if (preset === 'bulanini') {
            setDates(new Date(y, m, 1), new Date(y, m + 1, 0), this);
        } else if (preset === 'bulanlalu') {
            setDates(new Date(y, m - 1, 1), new Date(y, m, 0), this);
        } else if (preset === 'tahunini') {
            setDates(new Date(y, 0, 1), new Date(y, 11, 31), this);
        } else if (preset === 'q1') {
            setDates(new Date(y, 0, 1), new Date(y, 2, 31), this);
        } else if (preset === 'q2') {
            setDates(new Date(y, 3, 1), new Date(y, 5, 30), this);
        } else if (preset === 'q3') {
            setDates(new Date(y, 6, 1), new Date(y, 8, 30), this);
        } else if (preset === 'q4') {
            setDates(new Date(y, 9, 1), new Date(y, 11, 31), this);
        }
    });

    // Default: bulan ini
    $('.quick-btn[data-preset="bulanini"]').trigger('click');

    $('#formLaporan').submit(function (e) {
        var awal = $('#tanggalawal').val();
        var akhir = $('#tanggalakhir').val();
        if (!awal || !akhir) {
            e.preventDefault();
            Swal.fire({ icon:'warning', title:'Perhatian!', text:'Tanggal awal dan akhir harus diisi.', confirmButtonColor:'#0053C5' });
            return false;
        }
        if (new Date(akhir) < new Date(awal)) {
            e.preventDefault();
            Swal.fire({ icon:'warning', title:'Tanggal Tidak Valid!', text:'Tanggal akhir tidak boleh lebih awal dari tanggal awal.', confirmButtonColor:'#0053C5' });
            return false;
        }
    });
});
</script>
@endpush