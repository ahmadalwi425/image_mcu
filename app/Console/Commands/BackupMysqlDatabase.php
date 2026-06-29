<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class BackupMysqlDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup-mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database MySQL otomatis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ambil konfigurasi dari .env
        $host     = config('database.connections.mysql.host');
        $port     = config('database.connections.mysql.port');
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        // Nama file: backup_2025-01-15_14-30-00.sql
        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $filename  = "backup_{$timestamp}.sql";

        // Folder tujuan backup (otomatis dibuat jika belum ada)
        $backupDir = storage_path('app/backups/mysql');
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $filepath = "{$backupDir}/{$filename}";

        // Perintah mysqldump
        $mysqldump = 'C:\xampp2\mysql\bin\mysqldump.exe'; // ← sesuaikan path XAMPP kamu

        $passwordFlag = $password ? "--password={$password}" : '';

        $command = "\"{$mysqldump}\" --host={$host} --port={$port} --user={$username} {$passwordFlag} {$database} > \"{$filepath}\" 2>&1";

        exec($command, $output, $returnCode);

        if ($returnCode === 0) {
            $this->info("✅ Backup berhasil: {$filename}");
            $this->hapusBackupLama($backupDir); // hapus backup > 7 hari
        } else {
            $this->error("❌ Backup gagal! Output: " . implode("\n", $output));
        }
    }

    private function hapusBackupLama(string $dir): void
    {
        $files = glob("{$dir}/*.sql");
        $batasWaktu = now()->subDays(7)->timestamp;

        foreach ($files as $file) {
            if (filemtime($file) < $batasWaktu) {
                unlink($file);
                $this->line("🗑️  Hapus backup lama: " . basename($file));
            }
        }
    }
}
