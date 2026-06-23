<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menandai semua file migrasi yang ada sebagai sudah dieksekusi di database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = \Illuminate\Support\Facades\File::files(database_path('migrations'));
        $count = 0;

        foreach ($files as $file) {
            $migration = $file->getFilenameWithoutExtension();
            
            $exists = \Illuminate\Support\Facades\DB::table('migrations')->where('migration', $migration)->exists();
            
            if (!$exists) {
                \Illuminate\Support\Facades\DB::table('migrations')->insert([
                    'migration' => $migration,
                    'batch' => 1
                ]);
                $count++;
                $this->info("Migrasi disinkronkan: {$migration}");
            }
        }

        $this->info("Berhasil menyinkronkan {$count} file migrasi ke dalam database!");
    }
}
