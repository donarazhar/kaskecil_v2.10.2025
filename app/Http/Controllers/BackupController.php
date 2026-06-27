<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class BackupController extends Controller
{
    public function index()
    {
        $backupPath = storage_path("app/backups");
        $backups = [];

        if (File::exists($backupPath)) {
            $files = File::files($backupPath);
            foreach ($files as $file) {
                if ($file->getExtension() === 'sql') {
                    $backups[] = [
                        'name' => $file->getFilename(),
                        'size' => number_format($file->getSize() / 1048576, 2) . ' MB',
                        'date' => Carbon::createFromTimestamp($file->getMTime())->format('Y-m-d H:i:s'),
                        'path' => $file->getRealPath()
                    ];
                }
            }
        }

        // Sort backups by date descending
        usort($backups, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return view('pages.backup.index', compact('backups'));
    }

    public function create()
    {
        try {
            Artisan::call('db:backup');
            Alert::success('Berhasil', 'Backup database berhasil dibuat!');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function download($name)
    {
        $file = storage_path('app/backups/' . $name);
        if (File::exists($file)) {
            return response()->download($file);
        }
        
        Alert::error('Gagal', 'File backup tidak ditemukan!');
        return redirect()->back();
    }

    public function delete($name)
    {
        $file = storage_path('app/backups/' . $name);
        if (File::exists($file)) {
            File::delete($file);
            Alert::success('Berhasil', 'File backup berhasil dihapus!');
        } else {
            Alert::error('Gagal', 'File backup tidak ditemukan!');
        }
        
        return redirect()->back();
    }
}
