@extends('layouts.sidebar')
@section('title', 'Ubah Profil Instansi')
@section('header-title', 'Ubah Instansi')
@section('content')
<style>
:root{--blue:#0053C5;--blue-dk:#003d91;--blue-50:#eff6ff;--blue-100:#dbeafe;--gray-50:#f9fafb;--gray-100:#f3f4f6;--gray-200:#e5e7eb;--gray-400:#9ca3af;--gray-500:#6b7280;--gray-600:#4b5563;--gray-700:#374151;--gray-800:#1f2937;--gray-900:#111827;}
.ph{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;}
.ph-left h2{font-size:22px;font-weight:700;color:var(--gray-900);margin:0 0 2px;display:flex;align-items:center;gap:8px;}
.ph-left h2 i{color:var(--blue);font-size:20px;}
.ph-left p{font-size:13px;color:var(--gray-500);margin:0;}
.panel{background:#fff;border:1px solid var(--gray-100);border-radius:14px;overflow:hidden;margin-bottom:16px;max-width:700px;}
.panel-header{padding:16px 20px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between;}
.panel-title{font-size:14px;font-weight:700;color:var(--gray-800);display:flex;align-items:center;gap:8px;margin:0;}
.panel-title i{color:var(--blue);}
.panel-body{padding:24px 20px;}
.form-group{margin-bottom:16px;}
.form-lbl{display:block;font-size:13px;font-weight:600;color:var(--gray-700);margin-bottom:6px;}
.form-inp{width:100%;padding:10px 14px;border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px;color:var(--gray-900);background:#fff;transition:border-color .15s,box-shadow .15s;}
.form-inp:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-50);}
.form-inp::placeholder{color:var(--gray-400);}
.is-invalid{border-color:#dc2626;box-shadow:0 0 0 3px #fef2f2;}
.invalid-feedback{color:#dc2626;font-size:12px;margin-top:4px;}
.btn-blue{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:var(--blue);color:#fff;border:none;border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:background .15s,transform .15s;}
.btn-blue:hover{background:var(--blue-dk);color:#fff;transform:translateY(-1px);}
.btn-outline{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:#fff;color:var(--gray-600);border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;transition:background .15s,color .15s;}
.btn-outline:hover{background:var(--gray-50);color:var(--gray-800);}
.form-actions{display:flex;gap:10px;margin-top:24px;}
@media(max-width:640px){.ph{flex-direction:column;align-items:flex-start;}.form-actions{flex-direction:column;}.btn-blue,.btn-outline{width:100%;justify-content:center;}}
.fade-up{animation:fadeUp .3s ease both;}
@keyframes fadeUp{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
</style>

{{-- Page Header --}}
<div class="ph fade-up">
    <div class="ph-left">
        <h2><i class="fas fa-edit"></i> Ubah Profil Instansi</h2>
        <p>Perbarui informasi detail instansi Anda</p>
    </div>
</div>

{{-- Main Panel --}}
<div class="panel fade-up">
    <div class="panel-header">
        <h6 class="panel-title"><i class="fas fa-pen"></i> Form Ubah Profil</h6>
    </div>
    <div class="panel-body">
        <form action="{{ url('/instansi/' . $instansi->id) }}" method="post" id="formInstansi">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-lbl">Nama Instansi <span style="color:red">*</span></label>
                <input type="text" name="nama" class="form-inp @error('nama') is-invalid @enderror" value="{{ old('nama') ?? $instansi->nama }}" placeholder="Contoh: Masjid Nurul Ihsan">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-lbl">Kepala / Pimpinan <span style="color:red">*</span></label>
                <input type="text" name="pimpinan" class="form-inp @error('pimpinan') is-invalid @enderror" value="{{ old('pimpinan') ?? $instansi->pimpinan }}" placeholder="Masukkan nama pimpinan">
                @error('pimpinan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-lbl">Alamat Lengkap <span style="color:red">*</span></label>
                <textarea name="alamat" rows="4" class="form-inp @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat lengkap instansi" style="resize:vertical">{{ old('alamat') ?? $instansi->alamat }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="button" class="btn-blue" id="btnSimpan"><i class="fas fa-save"></i> Simpan Perubahan</button>
                <a href="{{ url('/instansi') }}" class="btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('after-script')
<script>
$(function() {
    $('#btnSimpan').click(function(e) {
        var btn = $(this);
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Profil instansi akan diperbarui sesuai data ini.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0053C5',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                btn.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);
                $('#formInstansi').submit();
            }
        });
    });
});
</script>
@endpush
