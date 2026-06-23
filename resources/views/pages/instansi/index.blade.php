@extends('layouts.sidebar')
@section('title', 'Profil Instansi')
@section('header-title', 'Profil Instansi')
@section('content')
<style>
:root{--blue:#0053C5;--blue-dk:#003d91;--blue-50:#eff6ff;--blue-100:#dbeafe;--gray-50:#f9fafb;--gray-100:#f3f4f6;--gray-200:#e5e7eb;--gray-400:#9ca3af;--gray-500:#6b7280;--gray-600:#4b5563;--gray-700:#374151;--gray-800:#1f2937;--gray-900:#111827;}
.ph{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;}
.ph-left h2{font-size:22px;font-weight:700;color:var(--gray-900);margin:0 0 2px;display:flex;align-items:center;gap:8px;}
.ph-left h2 i{color:var(--blue);font-size:20px;}
.ph-left p{font-size:13px;color:var(--gray-500);margin:0;}
.panel{background:#fff;border:1px solid var(--gray-100);border-radius:14px;overflow:hidden;margin-bottom:16px;}
.panel-header{padding:16px 20px;border-bottom:1px solid var(--gray-100);}
.panel-title{font-size:14px;font-weight:700;color:var(--gray-800);display:flex;align-items:center;gap:8px;margin:0;}
.panel-title i{color:var(--blue);}
.panel-body{padding:24px 20px;}
.profile-card{display:flex;gap:24px;background:var(--gray-50);border:1px solid var(--gray-100);border-radius:12px;padding:24px;align-items:center;}
.profile-icon{width:80px;height:80px;background:var(--blue-50);border-radius:16px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.profile-icon i{font-size:32px;color:var(--blue);}
.profile-details{flex:1;}
.pd-row{margin-bottom:12px;}
.pd-row:last-child{margin-bottom:0;}
.pd-label{font-size:11px;font-weight:700;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;}
.pd-val{font-size:15px;font-weight:600;color:var(--gray-900);}
.pd-val i{color:var(--blue);margin-right:6px;width:16px;text-align:center;}
.btn-blue{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:var(--blue);color:#fff;border:none;border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:background .15s,transform .15s;}
.btn-blue:hover{background:var(--blue-dk);color:#fff;transform:translateY(-1px);}
@media(max-width:640px){.profile-card{flex-direction:column;text-align:center;}.profile-icon{margin:0 auto;}}
.fade-up{animation:fadeUp .3s ease both;}
@keyframes fadeUp{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
</style>

{{-- Page Header --}}
<div class="ph fade-up">
    <div class="ph-left">
        <h2><i class="fas fa-building"></i> Profil Instansi</h2>
        <p>Informasi detail mengenai instansi Anda</p>
    </div>
</div>

{{-- Main Panel --}}
<div class="panel fade-up">
    <div class="panel-header">
        <h6 class="panel-title"><i class="fas fa-info-circle"></i> Detail Instansi</h6>
    </div>
    <div class="panel-body">
        <div class="profile-card">
            <div class="profile-icon">
                <i class="fas fa-landmark"></i>
            </div>
            <div class="profile-details">
                <div class="pd-row">
                    <div class="pd-label">Nama Instansi</div>
                    <div class="pd-val"><i class="fas fa-building"></i> {{ $instansi->nama }}</div>
                </div>
                <div class="pd-row">
                    <div class="pd-label">Alamat Lengkap</div>
                    <div class="pd-val"><i class="fas fa-map-marker-alt"></i> {{ $instansi->alamat }}</div>
                </div>
                <div class="pd-row">
                    <div class="pd-label">Kepala / Pimpinan</div>
                    <div class="pd-val"><i class="fas fa-user-tie"></i> {{ $instansi->pimpinan }}</div>
                </div>
            </div>
        </div>
        <div style="margin-top:24px;">
            <a href="{{ url('/instansi/' . $instansi->id . '/edit') }}" class="btn-blue">
                <i class="fas fa-pencil-alt"></i> Ubah Profil Instansi
            </a>
        </div>
    </div>
</div>

@endsection

@push('after-script')
<script>
$(function() {
    @if(Session::has('success'))
    Swal.fire({ title:'Berhasil!', text:"{{ Session::get('success') }}", icon:'success', confirmButtonColor:'#0053C5', timer:3000 });
    @endif
});
</script>
@endpush
