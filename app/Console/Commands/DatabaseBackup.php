<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = "backup-" . Carbon::now()->format('Y-m-d-H-i-s') . ".sql";
        $backupPath = storage_path("app/backups");
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }
        $fullPath = $backupPath . DIRECTORY_SEPARATOR . $filename;

        $dbHost = config('database.connections.mysql.host');
        $dbPort = config('database.connections.mysql.port');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');
        $dbName = config('database.connections.mysql.database');

        $mysqldumpPath = 'mysqldump';
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $laragonMysqlPath = glob('C:\\laragon\\bin\\mysql\\*\\bin\\mysqldump.exe');
            if (!empty($laragonMysqlPath)) {
                $mysqldumpPath = '"' . $laragonMysqlPath[0] . '"';
            }
        }

        $passwordParam = empty($dbPass) ? '' : '--password="' . $dbPass . '"';
        $command = sprintf(
            '%s --user="%s" %s --host="%s" --port="%s" "%s" > "%s"',
            $mysqldumpPath,
            $dbUser,
            $passwordParam,
            $dbHost,
            $dbPort,
            $dbName,
            $fullPath
        );

        $returnVar = NULL;
        $output  = NULL;
        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info("Backup successfully created at " . $fullPath);
            Log::info("Database backup created: " . $filename);
        } else {
            $this->error("Backup failed. Command: " . $command);
            Log::error("Database backup failed: " . implode("\n", $output));
        }
    }
}
