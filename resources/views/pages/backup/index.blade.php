@extends('layouts.sidebar')

@section('title', 'Backup Database')
@section('header-title', 'Backup Database')

@section('content')

<style>
    .custom-table th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        padding: 12px 16px;
    }

    .custom-table td {
        padding: 12px 16px;
        vertical-align: middle;
        color: #334155;
        font-size: 14px;
        border-bottom: 1px solid #f1f5f9;
    }

    .custom-table tbody tr:hover { background-color: #f8fafc; }

    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s;
        border: none;
    }
    
    .btn-action-primary { background: #eff6ff; color: #3b82f6; }
    .btn-action-primary:hover { background: #3b82f6; color: white; transform: translateY(-2px); box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2); }

    .btn-action-danger { background: #fef2f2; color: #ef4444; }
    .btn-action-danger:hover { background: #ef4444; color: white; transform: translateY(-2px); box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2); }
</style>

<div class="row">
    <div class="col-12">
        <div class="card bg-white border-0" style="border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center" style="padding: 20px 24px; border-bottom: 1px solid #f1f5f9 !important;">
                <h6 class="m-0 font-weight-bold" style="color: #1e293b; font-size: 16px;">
                    <i class="fas fa-database text-primary mr-2"></i> Manajemen Backup Database
                </h6>
                <form action="{{ route('backup.create') }}" method="POST" id="backupForm">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="border-radius: 8px; font-weight: 500; padding: 8px 16px; font-size: 14px; box-shadow: 0 4px 10px rgba(78,115,223,0.2);">
                        <i class="fas fa-plus mr-1"></i> Buat Backup Manual
                    </button>
                </form>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="alert alert-info mx-4 mt-4" style="border-radius: 8px; border: none; background-color: #eff6ff; color: #1e40af; display: flex; align-items: flex-start; gap: 12px;">
                    <i class="fas fa-info-circle mt-1"></i>
                    <div>
                        <strong>Informasi:</strong> Sistem telah diatur untuk melakukan backup database secara otomatis setiap hari. Anda juga dapat membuat backup seketika melalui tombol "Buat Backup Manual". <br><br>
                        <strong><i class="fas fa-exclamation-triangle"></i> Sangat Penting:</strong> Setelah melakukan input data atau sebelum menyelesaikan pekerjaan harian, selalu lakukan backup dan <strong>Download</strong> file tersebut ke komputer lokal, Flashdisk, atau Google Drive Anda untuk berjaga-jaga dari kerusakan server atau ancaman peretasan.
                    </div>
                </div>

                <div class="table-responsive px-4 pb-4 mt-2">
                    <table class="table align-middle mb-0 custom-table">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Nama File</th>
                                <th>Ukuran File</th>
                                <th>Tanggal Backup</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($backups as $index => $backup)
                                <tr>
                                    <td class="text-center" style="font-weight: 500;">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3" style="width: 36px; height: 36px; border-radius: 8px; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                                                <i class="fas fa-file-sql"></i>
                                            </div>
                                            <div>
                                                <div style="font-weight: 600; color: #1e293b;">{{ $backup['name'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: #f1f5f9; color: #475569; padding: 6px 10px; border-radius: 6px; font-weight: 500;">
                                            {{ $backup['size'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="color: #475569;">
                                            <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($backup['date'])->isoFormat('D MMMM YYYY') }} <br>
                                            <small><i class="far fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($backup['date'])->format('H:i:s') }}</small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center" style="gap: 8px;">
                                            <a href="{{ route('backup.download', $backup['name']) }}" class="btn-action btn-action-primary" title="Download Backup">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <form action="{{ route('backup.delete', $backup['name']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus file backup ini?');">
                                                @csrf
                                                <button type="submit" class="btn-action btn-action-danger" title="Hapus Backup">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div style="color: #94a3b8; font-size: 48px; margin-bottom: 16px;">
                                            <i class="fas fa-database"></i>
                                        </div>
                                        <h6 style="color: #475569; font-weight: 600; margin-bottom: 8px;">Belum Ada File Backup</h6>
                                        <p style="color: #64748b; margin-bottom: 0;">File backup akan muncul di sini setelah dibuat.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('backupForm').addEventListener('submit', function(e) {
    var btn = this.querySelector('button[type="submit"]');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Memproses...';
    btn.disabled = true;
});
</script>
@endsection
