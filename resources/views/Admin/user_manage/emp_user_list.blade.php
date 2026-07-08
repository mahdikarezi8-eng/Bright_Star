@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title mb-2 mb-md-0">
                        All Users List
                    </h4>
                </div>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead class="text-muted">
                            <tr>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Role
                                </th>
                                <th>
                                    Update
                                </th>
                                <th>
                                    Delete
                                </th>ٰ
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="py-2 px-2">{{ $user->name }}</td>
                                    <td class="py-2 px-2">{{ $user->email }}</td>
                                    <td class="py-2 px-2">
                                        @foreach ($user->roles as $role)
                                            <span class="badge bagge-pill bg-info text-dark"> {{ $role->name }}</sapn>
                                        @endforeach
                                    </td>
                                    <td class="py-2 px-2">
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light" href="{{ route('emp_user_edit', $user->id) }}"><span
                                                    class="fa-solid fa-pen-to-square"></span></a>
                                        </button>
                                    </td>
                                    <td class="py-2 px-2">
                                        <a href="{{ route('emp_user_delete', $user->id) }}"
                                            class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a>
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
