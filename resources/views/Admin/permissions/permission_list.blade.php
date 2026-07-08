@extends('Admin.master')

@section('content')
    <div class="content-wrapper mt-3">

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Permission List</h4>

                    <a href="{{ route('permission_add') }}" class="btn btn-primary btn-sm">
                        Add Permission
                    </a>
                </div>

                <hr>

                <div class="table-responsive">
                    <table id="data" class="table table-striped table-hover">

                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Permission Name</th>
                                <th class="text-center">Group Name</th>
                                <th class="text-center">Update</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($permissions as $groupName => $groupPermissions)
                                {{-- 🔥 Permissions inside group --}}
                                @foreach ($groupPermissions as $permission)
                                    <tr>

                                        <td class="text-center">
                                            {{ $permission->id }}
                                        </td>

                                        <td class="text-center">
                                            {{ $permission->name }}
                                        </td>

                                        <td class="text-center">
                                            {{ $permission->group_name }}
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('permission_edit', $permission->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('permission_delete', $permission->id) }}"
                                                class="btn btn-danger btn-sm delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection
