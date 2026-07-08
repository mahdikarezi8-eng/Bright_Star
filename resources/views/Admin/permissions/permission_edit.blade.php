@extends('Admin.master')
@section('content')
    <div class='card mt-3 mr-3 ml-3'>
        <div class="card-body">
            <h4 class="card-title">Edit Permission</h4>
            <form class="form-sample mt-3" action="{{ route('permission_update', $permission->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Permission Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $permission->name }}" class="form-control" name="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Group Name</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="group_name">
                                    <option selected disabled>Select Group</option>
                                    <option value="Employee Managment"
                                        {{ $permission->group_name == 'Employee Managment' ? 'selected' : '' }}>
                                        Employee Managment</option>
                                    <option value="Teacher Managment"
                                        {{ $permission->group_name == 'Teacher Managment' ? 'selected' : '' }}>
                                        Teacher</option>
                                    <option value="Class & Subject Managment"
                                        {{ $permission->group_name == 'Class & Subject Managment' ? 'selected' : '' }}">
                                        Class &
                                        Subject Managment</option>
                                    <option value="Student Managment"
                                        {{ $permission->group_name == 'Student Managment' ? 'selected' : '' }}>
                                        Student Managment</option>
                                    <option value="Exam & Score Managment"
                                        {{ $permission->group_name == 'Exam & Score Managment' ? 'selected' : '' }}">Exam &
                                        Score Managment
                                    </option>
                                    <option value="Finance Managment"
                                        {{ $permission->group_name == 'Finance Managment' ? 'selected' : '' }}>
                                        Finance Managment</option>
                                    <option value="User Managment"
                                        {{ $permission->group_name == 'User Managment' ? 'selected' : '' }}>
                                        User Managment</option>
                                    <option value="Role & Permission"
                                        {{ $permission->group_name == 'Role & Permission' ? 'selected' : '' }}">Role &
                                        Permission Managment</option>
                                </select>
                                @error('group_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary mr-2">Save</button>
            </form>
        </div>
    </div>
@endsection
