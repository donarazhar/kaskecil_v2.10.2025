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

        try {
            $dbName = config('database.connections.mysql.database');
            $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
            $tableKey = 'Tables_in_' . $dbName;

            $sql = "-- Database Backup: " . $dbName . "\n";
            $sql .= "-- Generated: " . Carbon::now()->format('Y-m-d H:i:s') . "\n\n";

            foreach ($tables as $table) {
                $tableName = $table->$tableKey ?? (array_values((array)$table)[0]);

                $createTable = \Illuminate\Support\Facades\DB::select("SHOW CREATE TABLE `$tableName`");
                $sql .= "DROP TABLE IF EXISTS `$tableName`;\n";
                $sql .= $createTable[0]->{'Create Table'} . ";\n\n";

                $rows = \Illuminate\Support\Facades\DB::table($tableName)->get();
                foreach ($rows as $row) {
                    $rowArray = (array) $row;
                    $keys = array_map(function($key) { return "`$key`"; }, array_keys($rowArray));
                    $values = array_map(function($value) {
                        if ($value === null) return 'NULL';
                        return "'" . addslashes($value) . "'";
                    }, array_values($rowArray));

                    $sql .= "INSERT INTO `$tableName` (" . implode(', ', $keys) . ") VALUES (" . implode(', ', $values) . ");\n";
                }
                $sql .= "\n";
            }

            file_put_contents($fullPath, $sql);

            $this->info("Backup successfully created at " . $fullPath);
            Log::info("Database backup created: " . $filename);
        } catch (\Throwable $e) {
            $this->error("Backup failed: " . $e->getMessage());
            Log::error("Database backup failed: " . $e->getMessage());
            throw $e;
        }
    }
}
