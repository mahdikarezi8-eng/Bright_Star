@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title mb-2 mb-md-0">
                        Role List
                    </h4>
                    <a class="btn btn-primary btn-sm" href="{{route('role_add')}}">Add Role</a>
                </div>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead class="text-muted">
                            <tr>
                                <th class="text-center">
                                    Id
                                </th>
                                <th class="text-center">
                                    Role Name
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
                                    <td class="py-3 px-3 text-center">{{ $role->id }}</td>
                                    <td class="py-3 px-3 text-center">
                                        {{ $role->name }}
                                   </td>
                                    <td class="py-2 px-2 text-center">
                                        <a href="{{route('role_edit',$role->id)}}"
                                            class="btn btn-success btn-sm"><i class="fa  fa-solid fa-edit "></i></a>
                                    </td>

                                    <td class="py-2 px-2 text-center">
                                        <a href="{{route('role_delete',$role->id)}}"
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
@endsection
