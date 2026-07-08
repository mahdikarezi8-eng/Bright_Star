<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupController extends Controller
{
    public function backup_list()
    {
        $backups = collect();
        $backupPath = storage_path('app/backups');
        
        if (File::exists($backupPath)) {
            $files = File::files($backupPath);
            foreach ($files as $file) {
                $backups->push([
                    'filename' => $file->getFilename(),
                    'path' => $file->getPathname(),
                    'size' => $this->formatSize($file->getSize()),
                    'created_at' => date('Y-m-d H:i:s', $file->getCTime()),
                    'type' => pathinfo($file->getFilename(), PATHINFO_EXTENSION) === 'sql' ? 'database' : 'files'
                ]);
            }
        }
        
        $backups = $backups->sortByDesc('created_at');
        
        return view('Admin.backups.backup_list', compact('backups'));
    }

    public function backup_create(Request $request)
    {
        $type = $request->type ?? 'database';
        
        if ($type === 'database') {
            return $this->createDatabaseBackup();
        } elseif ($type === 'files') {
            return $this->createFilesBackup();
        } elseif ($type === 'full') {
            $dbResult = $this->createDatabaseBackup();
            $filesResult = $this->createFilesBackup();
            
            if ($dbResult && $filesResult) {
                return redirect()->route('backup_list')->with('success', 'Full backup created successfully.');
            }
            return redirect()->route('backup_list')->with('error', 'Backup creation failed.');
        }
        
        return redirect()->route('backup_list')->with('error', 'Invalid backup type.');
    }

    private function createDatabaseBackup()
    {
        try {
            $backupPath = storage_path('app/backups');
            if (!File::exists($backupPath)) {
                File::makeDirectory($backupPath, 0755, true);
            }

            $filename = 'database_backup_' . date('Y_m_d_His') . '.sql';
            $filepath = $backupPath . '/' . $filename;

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
                $filepath
            );

            $process = Process::fromShellCommandline($command);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return redirect()->route('backup_list')->with('success', 'Database backup created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('backup_list')->with('error', 'Database backup failed: ' . $e->getMessage());
        }
    }

    private function createFilesBackup()
    {
        try {
            $backupPath = storage_path('app/backups');
            if (!File::exists($backupPath)) {
                File::makeDirectory($backupPath, 0755, true);
            }

            $filename = 'files_backup_' . date('Y_m_d_His') . '.zip';
            $filepath = $backupPath . '/' . $filename;

            $zip = new \ZipArchive();
            if ($zip->open($filepath, \ZipArchive::CREATE) !== TRUE) {
                throw new \Exception('Cannot create zip file');
            }

            // Add public folder
            $this->addFolderToZip($zip, public_path(), 'public');

            // Add storage folder (excluding backups)
            $this->addFolderToZip($zip, storage_path('app'), 'storage_app', ['backups']);

            $zip->close();

            return redirect()->route('backup_list')->with('success', 'Files backup created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('backup_list')->with('error', 'Files backup failed: ' . $e->getMessage());
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

    public function backup_download($filename)
    {
        $filepath = storage_path('app/backups/' . $filename);
        
        if (!File::exists($filepath)) {
            return redirect()->route('backup_list')->with('error', 'Backup file not found.');
        }

        return response()->download($filepath);
    }

    public function backup_delete($filename)
    {
        $filepath = storage_path('app/backups/' . $filename);
        
        if (File::exists($filepath)) {
            File::delete($filepath);
            return redirect()->route('backup_list')->with('success', 'Backup deleted successfully.');
        }

        return redirect()->route('backup_list')->with('error', 'Backup file not found.');
    }

    public function backup_restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:sql'
        ]);

        try {
            $file = $request->file('backup_file');
            $filepath = $file->storeAs('temp', 'restore_backup.sql');

            $dbHost = env('DB_HOST', '127.0.0.1');
            $dbDatabase = env('DB_DATABASE', 'laravel');
            $dbUsername = env('DB_USERNAME', 'root');
            $dbPassword = env('DB_PASSWORD', '');

            $command = sprintf(
                'mysql -h%s -u%s %s %s < %s',
                $dbHost,
                $dbUsername,
                $dbPassword ? '-p' . $dbPassword : '',
                $dbDatabase,
                storage_path('app/' . $filepath)
            );

            $process = Process::fromShellCommandline($command);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            File::delete(storage_path('app/' . $filepath));

            return redirect()->route('backup_list')->with('success', 'Database restored successfully.');
        } catch (\Exception $e) {
            return redirect()->route('backup_list')->with('error', 'Database restore failed: ' . $e->getMessage());
        }
    }

    private function formatSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
