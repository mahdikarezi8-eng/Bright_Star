@extends('Admin.master')

@section('content')
    <div class="content-wrapper mt-3">

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title mb-2 mb-md-0">
                        Permission In Role List
                    </h4>

                    <a class="btn btn-primary btn-sm" href="{{ route('add_role_in_permission') }}">
                        Add Permissions In Role
                    </a>
                </div>

                <hr>

                <div class="table-responsive">

                    <table id="data" class="table table-striped table-hover align-middle">

                        <thead class="text-muted">
                            <tr>
                                <th class="text-center py-3">Role Name</th>
                                <th class="text-center py-3">Permissions</th>
                                <th class="text-center py-3">Update</th>
                                <th class="text-center py-3">Delete</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($roles as $role)
                                <tr>

                                    {{-- Role Name --}}
                                    <td class="text-center py-3 fw-semibold">
                                        {{ $role->name }}
                                    </td>

                                    {{-- Permissions with scroll --}}
                                    <td class="py-3">
                                        <div class="permission-box">

                                            <div class="d-flex flex-wrap gap-1 justify-content-center">

                                                @foreach ($role->permissions as $item)
                                                    <span class="badge bg-info text-dark px-2 py-1">
                                                        {{ $item->name }}
                                                    </span>
                                                @endforeach

                                            </div>

                                        </div>
                                    </td>

                                    {{-- Update --}}
                                    <td class="text-center py-3">
                                        <a href="{{ route('role_to_permission_edit', $role->id) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-solid fa-edit"></i>
                                        </a>
                                    </td>

                                    {{-- Delete --}}
                                    <td class="text-center py-3">
                                        <a href="{{ route('role_to_permission_delete', $role->id) }}"
                                            class="btn btn-danger btn-sm delete">
                                            <i class="fa fa-solid fa-trash"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
@endsection
{{-- @extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title mb-2 mb-md-0">
                        Permission In Role List
                    </h4>
                    <a class="btn btn-primary btn-sm" href="{{ route('add_role_in_permission') }}">Add Permissions In Role</a>
                </div>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead class="text-muted">
                            <tr>
                                <th class="text-center">
                                    Role Name
                                </th>

                                <th class="text-center">
                                    Permissions
                                </th>
                                <th class="text-center">
                                    Update
                                </th>
                                <th class="text-center">
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="py-3 px-3 text-center">
                                        {{ $role->name }}
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        <div class="d-flex flex-wrap justify-content-center gap-2">
                                            @foreach ($role->permissions as $item)
                                                <span class="badge bg-info text-dark px-2 py-1 permission-badge">
                                                    {{ $item->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <a href="{{ route('role_to_permission_edit', $role->id) }}"
                                            class="btn btn-success btn-sm"><i class="fa  fa-solid fa-edit "></i></a>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <a href="{{ route('role_to_permission_delete', $role->id) }}"
                                            class="btn btn-danger  btn-sm delete"><i class="fa  fa-solid fa-trash "></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
