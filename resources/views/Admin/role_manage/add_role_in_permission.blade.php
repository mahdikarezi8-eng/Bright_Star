@extends('Admin.master')

@section('content')
    <div class="card mt-3 mx-3">
        <div class="card-body">

            <h4 class="card-title">Add Role in Permission</h4>

            <form action="{{ route('role_to_permission_save') }}" method="post">
                @csrf

                {{-- Role Select --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label">Role Name</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="role_id">
                                    <option selected disabled>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- Select All --}}
                <div class="form-check d-flex align-items-center mb-3">
                    <input type="checkbox" id="select_all_permission"
                        class="form-check-input border border-primary shadow-sm">

                    <label class="form-check-label ms-2" for="select_all_permission">
                        All Permissions
                    </label>
                </div>

                <hr>

                {{-- Permission Groups --}}
                @foreach ($permission_group as $group)
                    <div class="row py-3">

                        {{-- Group --}}
                        <div class="col-md-3 d-flex align-items-start">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox"
                                    class="form-check-input border border-primary shadow-sm group-checkbox">

                                <label class="form-check-label ms-2 fw-bold">
                                    {{ $group->group_name }}
                                </label>
                            </div>
                        </div>

                        {{-- Permissions --}}
                        <div class="col-md-9">
                            <div class="row">

                                @php
                                    $permissions = App\Models\User::getPermissionBygroupName($group->group_name);
                                @endphp

                                @foreach ($permissions as $permission)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check d-flex align-items-center">

                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                                class="form-check-input border border-primary shadow-sm permission-checkbox">

                                            <label class="form-check-label ml-1">
                                                {{ $permission->name }}
                                            </label>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    {{-- Divider line between groups --}}
                    <hr class="my-2 text-primary">
                @endforeach

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection

{{-- @extends('Admin.master')
@section('content')
    <div class='card mt-3 mr-3 ml-3'>
        <div class="card-body">
            <h4 class="card-title">Add Role in Permission</h4>
            <form class="form-sample mt-3" action="{{ route('role_to_permission_save') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Role Name</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="role_id">
                                    <option selected disabled><span class="text-dark">Select Role</span></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input type="checkbox" id="select_all_permission"
                                class="form-check-input border border border-primary shadow-sm">
                        </div>
                        <label class="col-sm-3 col-form-label">All Permission</label>
                    </div>
                    <hr>
                </div>

                @foreach ($permission_group as $group)
                    <div class="row mt-n4">
                        <div class="col-5">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ $group->group_name }}</label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input type="checkbox" name=""
                                            class="form-check-input border border-primary shadow-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $permissions = App\Models\User::getPermissionBygroupName($group->group_name);
                        @endphp
                        <div class="col-7 ">
                            <div class="form-group row">
                                @foreach ($permissions as $permission)
                                    <label class="col-sm-3 col-form-label">{{ $permission->name }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                                class="form-check-input border border border-primary shadow-sm">
                                            @error('permission')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary mr-2">Save</button>
            </form>
        </div>
    </div>
@endsection --}}
