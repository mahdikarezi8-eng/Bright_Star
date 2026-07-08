<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AutoBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically create database and file backups';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting automatic backup...');

        try {
            $backupPath = storage_path('app/backups');
            if (!\Illuminate\Support\Facades\File::exists($backupPath)) {
                \Illuminate\Support\Facades\File::makeDirectory($backupPath, 0755, true);
            }

            // Create database backup
            $dbFilename = 'auto_database_backup_' . date('Y_m_d_His') . '.sql';
            $dbFilepath = $backupPath . '/' . $dbFilename;

            $dbHost = env('DB_HOST', '127.0.0.1');
            $dbDatabase = env('DB_DATABASE', 'laravel');
            $dbUsername = env('DB_USERNAME', 'root');
            $dbPassword = env('DB_PASSWORD', '');

            $command = sprintf(
                'mysqldump -h%s -u%s %s %s > %s',
                $dbHost,
                $dbUsername,
                $dbPassword ? '-p' . $dbPassword : '',
                $dbDatabase,
                $dbFilepath
            );

            $process = \Symfony\Component\Process\Process::fromShellCommandline($command);
            $process->run();

            if ($process->isSuccessful()) {
                $this->info('Database backup created: ' . $dbFilename);
            } else {
                $this->error('Database backup failed: ' . $process->getErrorOutput());
            }

            // Create files backup
            $filesFilename = 'auto_files_backup_' . date('Y_m_d_His') . '.zip';
            $filesFilepath = $backupPath . '/' . $filesFilename;

            $zip = new \ZipArchive();
            if ($zip->open($filesFilepath, \ZipArchive::CREATE) === TRUE) {
                // Add public folder
                $this->addFolderToZip($zip, public_path(), 'public');

                // Add storage folder (excluding backups)
                $this->addFolderToZip($zip, storage_path('app'), 'storage_app', ['backups']);

                $zip->close();
                $this->info('Files backup created: ' . $filesFilename);
            } else {
                $this->error('Files backup failed: Cannot create zip file');
            }

            // Clean old backups (keep last 10)
            $this->cleanOldBackups($backupPath, 10);

            $this->info('Automatic backup completed successfully.');
            return 0;
        } catch (\Exception $e) {
            $this->error('Automatic backup failed: ' . $e->getMessage());
            return 1;
        }
    }

    private function addFolderToZip($zip, $folderPath, $zipPath, $excludeFolders = [])
    {
        if (!file_exists($folderPath)) {
            return;
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($folderPath),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if ($file->isDir()) {
                continue;
            }

            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($folderPath) + 1);
            
            // Check if file is in excluded folders
            foreach ($excludeFolders as $exclude) {
                if (strpos($relativePath, $exclude) === 0) {
                    continue 2;
                }
            }

            $zip->addFile($filePath, $zipPath . '/' . $relativePath);
        }
    }

    private function cleanOldBackups($backupPath, $keepCount)
    {
        $files = \Illuminate\Support\Facades\File::files($backupPath);
        
        if (count($files) > $keepCount) {
            // Sort by creation time (oldest first)
            usort($files, function($a, $b) {
                return $a->getCTime() - $b->getCTime();
            });

            // Delete oldest files
            $filesToDelete = count($files) - $keepCount;
            for ($i = 0; $i < $filesToDelete; $i++) {
                \Illuminate\Support\Facades\File::delete($files[$i]->getPathname());
                $this->info('Deleted old backup: ' . $files[$i]->getFilename());
            }
        }
    }
}
