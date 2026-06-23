@extends('layouts.sidebar')
@section('title', 'Manajemen User')
@section('header-title', 'Manajemen User')
@section('content')
<style>
:root{--blue:#0053C5;--blue-dk:#003d91;--blue-50:#eff6ff;--blue-100:#dbeafe;--green-50:#f0fdf4;--green-700:#15803d;--red-50:#fef2f2;--red-600:#dc2626;--red-700:#b91c1c;--amber-50:#fffbeb;--amber-700:#b45309;--gray-50:#f9fafb;--gray-100:#f3f4f6;--gray-200:#e5e7eb;--gray-400:#9ca3af;--gray-500:#6b7280;--gray-600:#4b5563;--gray-700:#374151;--gray-800:#1f2937;--gray-900:#111827;}
.flash-alert{display:flex;align-items:center;gap:10px;padding:14px 18px;border-radius:10px;font-size:13px;font-weight:500;margin-bottom:16px;}
.flash-success{background:var(--green-50);color:var(--green-700);border:1px solid #bbf7d0;}
.flash-warning{background:var(--amber-50);color:var(--amber-700);border:1px solid #fde68a;}
.ph{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;}
.ph-left h2{font-size:22px;font-weight:700;color:var(--gray-900);margin:0 0 2px;display:flex;align-items:center;gap:8px;}
.ph-left h2 i{color:var(--blue);font-size:20px;}
.ph-left p{font-size:13px;color:var(--gray-500);margin:0;}
.panel{background:#fff;border:1px solid var(--gray-100);border-radius:14px;overflow:hidden;margin-bottom:16px;}
.panel-header{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;padding:16px 20px;border-bottom:1px solid var(--gray-100);}
.panel-title{font-size:14px;font-weight:700;color:var(--gray-800);display:flex;align-items:center;gap:8px;margin:0;}
.panel-title i{color:var(--blue);}
.btn-blue{display:inline-flex;align-items:center;gap:7px;padding:9px 16px;background:var(--blue);color:#fff;border:none;border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;white-space:nowrap;transition:background .15s,transform .15s;}
.btn-blue:hover{background:var(--blue-dk);color:#fff;transform:translateY(-1px);}
/* User cards grid */
.user-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;padding:20px;}
.user-card{background:#fff;border:1px solid var(--gray-100);border-radius:12px;padding:20px;display:flex;flex-direction:column;align-items:center;text-align:center;transition:box-shadow .2s,transform .2s;position:relative;}
.user-card:hover{box-shadow:0 4px 20px rgba(0,83,197,.1);transform:translateY(-2px);}
.user-avatar{width:64px;height:64px;border-radius:50%;object-fit:cover;border:3px solid var(--blue-50);margin-bottom:12px;}
.user-name{font-size:14px;font-weight:700;color:var(--gray-900);margin-bottom:3px;}
.user-email{font-size:12px;color:var(--gray-500);margin-bottom:12px;word-break:break-all;}
.user-badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:20px;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.4px;margin-bottom:14px;}
.badge-admin{background:var(--blue-50);color:var(--blue);}
.badge-user{background:var(--gray-100);color:var(--gray-600);}
.user-actions{display:flex;gap:8px;justify-content:center;width:100%;}
.act-btn{flex:1;display:inline-flex;align-items:center;justify-content:center;gap:5px;padding:7px 10px;border:none;border-radius:8px;font-size:12px;font-weight:600;cursor:pointer;transition:background .15s;text-decoration:none;}
.act-edit{background:var(--blue-50);color:var(--blue);}
.act-edit:hover{background:var(--blue);color:#fff;}
.act-del{background:var(--red-50);color:var(--red-600);}
.act-del:hover{background:var(--red-600);color:#fff;}
/* Empty state */
.empty-state{text-align:center;padding:60px 20px;}
.empty-state i{font-size:48px;color:var(--gray-300);display:block;margin-bottom:12px;}
.empty-state p{font-size:14px;color:var(--gray-400);margin:0;}
/* Modal */
.modal-content{border:none;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.15);}
.modal-header{padding:18px 22px 14px;border-bottom:1px solid var(--gray-100);border-radius:16px 16px 0 0;}
.modal-title-text{font-size:15px;font-weight:700;color:var(--gray-900);display:flex;align-items:center;gap:8px;margin:0;}
.modal-title-text i{color:var(--blue);}
.modal-body{padding:22px;}
.btn-close-x{width:30px;height:30px;border:none;border-radius:7px;background:var(--gray-100);color:var(--gray-500);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:13px;}
.btn-close-x:hover{background:var(--gray-200);}
/* Form */
.form-group{margin-bottom:14px;}
.form-lbl{display:block;font-size:13px;font-weight:600;color:var(--gray-700);margin-bottom:6px;}
.form-inp{width:100%;padding:9px 12px;border:1.5px solid var(--gray-200);border-radius:9px;font-size:13px;color:var(--gray-900);background:#fff;transition:border-color .15s,box-shadow .15s;}
.form-inp:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-50);}
.form-inp::placeholder{color:var(--gray-400);}
@media(max-width:640px){.ph{flex-direction:column;align-items:flex-start;}.user-grid{grid-template-columns:1fr 1fr;}.act-btn span{display:none;}}
@media(max-width:420px){.user-grid{grid-template-columns:1fr;}}
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
        <h2><i class="fas fa-users"></i> Manajemen User</h2>
        <p>Kelola akun pengguna aplikasi</p>
    </div>
    <button class="btn-blue" id="btnTambahUser"><i class="fas fa-plus"></i> Tambah User</button>
</div>

{{-- Panel --}}
<div class="panel fade-up">
    <div class="panel-header">
        <h6 class="panel-title"><i class="fas fa-id-card"></i> Daftar Pengguna</h6>
        <span style="font-size:12px;color:var(--gray-400);">Total: {{ count($users ?? []) }} user</span>
    </div>

    @isset($users)
    @if($users->count() > 0)
    <div class="user-grid">
        @foreach($users as $user)
        <div class="user-card">
            @if($user->foto)
            <img src="{{ asset('uploads/users/' . $user->foto) }}" alt="{{ $user->name }}" class="user-avatar">
            @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0053C5&color=fff&size=64&bold=true" alt="{{ $user->name }}" class="user-avatar">
            @endif
            <div class="user-name">{{ $user->name }}</div>
            <div class="user-email">{{ $user->email }}</div>
            @if(isset($user->level))
            <span class="user-badge {{ $user->level == 'admin' ? 'badge-admin' : 'badge-user' }}">
                <i class="fas {{ $user->level == 'admin' ? 'fa-shield-alt' : 'fa-user' }}"></i>&nbsp;{{ ucfirst($user->level) }}
            </span>
            @endif
            <div class="user-actions">
                <a href="#" class="act-btn act-edit edit" id="{{ $user->id }}" title="Edit">
                    <i class="fas fa-pencil-alt"></i> <span>Edit</span>
                </a>
                <form action="{{ route('users.destroy', $user->id) }}" method="post" style="flex:1;margin:0">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="act-btn act-del delete-confirm w-100" data-id="{{ $user->id }}" data-email="{{ $user->email }}" title="Hapus">
                        <i class="fas fa-trash"></i> <span>Hapus</span>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state"><i class="fas fa-users"></i><p>Belum ada data pengguna</p></div>
    @endif
    @endisset
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modal-frmuser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-text"><i class="fas fa-user-plus"></i> Tambah User Baru</h5>
                <button type="button" class="btn-close-x" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="post" id="frmUser" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-lbl">Foto Profil</label>
                        <input type="file" name="foto" id="foto" class="form-inp" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label class="form-lbl">Nama <span style="color:red">*</span></label>
                        <input type="text" name="name" id="name" class="form-inp" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-group">
                        <label class="form-lbl">Email <span style="color:red">*</span></label>
                        <input type="email" name="email" id="email" class="form-inp" placeholder="Masukkan email">
                    </div>
                    <div class="form-group">
                        <label class="form-lbl">Password <span style="color:red">*</span></label>
                        <input type="password" name="password" id="password" class="form-inp" placeholder="Masukkan password">
                    </div>
                    <button type="button" class="btn-blue w-100 mt-2" id="btnSimpanData" style="justify-content:center;padding:11px;">
                        <i class="fas fa-save"></i> Simpan User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="modal-edituser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-text"><i class="fas fa-user-edit"></i> Edit User</h5>
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
    $("#btnTambahUser").click(function () { $("#modal-frmuser").modal("show"); });

    $("#btnSimpanData").click(function (e) {
        var name  = $("#name").val().trim();
        var email = $("#email").val().trim();
        var pass  = $("#password").val();
        var checks = [
            { val: name,  msg: 'Nama harus diisi' },
            { val: email, msg: 'Email harus diisi' },
            { val: pass,  msg: 'Password harus diisi' },
        ];
        for (var i = 0; i < checks.length; i++) {
            if (!checks[i].val) {
                Swal.fire({ icon:'warning', title:'Perhatian!', text:checks[i].msg, confirmButtonColor:'#0053C5' });
                return;
            }
        }
        $(this).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);
        $("#frmUser").submit();
    });

    $(".edit").click(function () {
        var id = $(this).attr('id');
        $('#loadeditform').html('<div style="text-align:center;padding:40px"><i class="fas fa-spinner fa-spin fa-2x" style="color:#0053C5"></i></div>');
        $("#modal-edituser").modal("show");
        $.ajax({ type:'POST', url:'/users/edit', data:{ _token:"{{ csrf_token() }}", id:id }, success:function(r){ $('#loadeditform').html(r); } });
    });

    $(".delete-confirm").click(function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var email = $(this).data('email');
        Swal.fire({
            title: 'Hapus User?',
            html: 'User <strong>' + email + '</strong> akan dihapus secara permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0053C5',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(function (r) { if (r.isConfirmed) form.submit(); });
    });

    @if(Session::has('success'))
    Swal.fire({ title:'Berhasil!', text:"{{ Session::get('success') }}", icon:'success', confirmButtonColor:'#0053C5', timer:3000 });
    @endif

    setTimeout(function () { $('.flash-alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush
