@extends('Admin.master')

@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Backup Management</h4>
                </div>

                {{-- Create Backup --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Create New Backup</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('backup_create') }}" method="POST">
                            @csrf

                            <button type="submit" name="type" value="database" class="btn btn-primary">
                                <i class="fa-solid fa-database"></i>
                                Database Backup
                            </button>

                            <button type="submit" name="type" value="files" class="btn btn-success">
                                <i class="fa-solid fa-folder"></i>
                                Files Backup
                            </button>

                            <button type="submit" name="type" value="full" class="btn btn-info">
                                <i class="fa-solid fa-cloud"></i>
                                Full Backup
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Restore --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Restore Database</h5>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('backup_restore') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-4">
                                    <input type="file" name="backup_file" class="form-control" accept=".sql" required>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-warning">
                                        <i class="fa-solid fa-rotate-left"></i>
                                        Restore
                                    </button>
                                </div>

                            </div>

                            <small class="text-danger">
                                Warning: This will replace your current database.
                            </small>

                        </form>

                    </div>
                </div>

                {{-- Backup List --}}
                <div class="table-responsive">

                    <table id="data" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>Filename</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Created At</th>
                                <th>Download</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($backups as $backup)
                                <tr>

                                    <td>{{ $backup['filename'] }}</td>

                                    <td>
                                        @if ($backup['type'] == 'database')
                                            <span class="badge bg-primary">
                                                Database
                                            </span>
                                        @elseif($backup['type'] == 'files')
                                            <span class="badge bg-success">
                                                Files
                                            </span>
                                        @else
                                            <span class="badge bg-info">
                                                Full
                                            </span>
                                        @endif
                                    </td>

                                    <td>{{ $backup['size'] }}</td>

                                    <td>{{ $backup['created_at'] }}</td>

                                    <td>
                                        <a href="{{ route('backup_download', $backup['filename']) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('backup_delete', $backup['filename']) }}"
                                            class="btn btn-danger btn-sm delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td>No backups found.</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>
@endsection
