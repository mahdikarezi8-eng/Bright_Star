@extends('Admin.master')

@section('content')
    <div class="card mt-3 mx-3">
        <div class="card-body">

            <h4 class="card-title">Update Role in Permission</h4>

            <form action="{{ route('role_to_permission_update', $role->id) }}" method="post">
                @csrf
                @method('PUT')

                {{-- Role Name --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label">Role Name</label>
                            <div class="col-sm-9">
                                <h5 class="text-muted fw-bold">
                                    {{ $role->name }}
                                </h5>
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
                    @php
                        $permissions = App\Models\User::getPermissionBygroupName($group->group_name);
                    @endphp

                    <div class="row py-3">

                        {{-- Group Checkbox --}}
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

                                @foreach ($permissions as $permission)
                                    <div class="col-md-4 mb-2">

                                        <div class="form-check d-flex align-items-center">

                                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                                class="form-check-input border border-primary shadow-sm permission-checkbox"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                                            <label class="form-check-label ms-2">
                                                {{ $permission->name }}
                                            </label>

                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>

                    {{-- Divider between groups --}}
                    <hr class="my-2">
                @endforeach

                {{-- Submit --}}
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        Update
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
            <h4 class="card-title">Update Role in Permission</h4>
            <form class="form-sample mt-3" action="{{ route('role_to_permission_update', $role->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Role Name</label>
                            <div class="col-sm-9">
                                <h3 class="ml-n2 text-muted fw-bold">{{ $role->name }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-n3">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">All Permission</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input type="checkbox" id="select_all_permission"
                                    class="form-check-input border border border-primary shadow-sm">
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                @foreach ($permission_group as $group)
                    <div class="row mt-n4">
                        <div class="col-5">
                            @php
                                $permissions = App\Models\User::getPermissionBygroupName($group->group_name);
                            @endphp
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ $group->group_name }}</label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input type="checkbox" name=""
                                            {{ App\Models\User::roleHasPermission($role, $permissions) ? 'checked' : '' }}
                                            class="form-check-input border border-primary shadow-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7 ">
                            <div class="form-group row">
                                @foreach ($permissions as $permission)
                                    <label class="col-sm-3 col-form-label">{{ $permission->name }}</label>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
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
