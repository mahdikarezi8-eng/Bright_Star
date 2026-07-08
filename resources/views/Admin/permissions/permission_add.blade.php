@extends('Admin.master')
@section('content')
    <div class='card mt-3 mr-3 ml-3'>
        <div class="card-body">
            <h4 class="card-title">Add Permission</h4>
            <form class="form-sample mt-3" action="{{ route('permission_save') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Permission Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name">
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
                                    <option value="Dashboard">Dashboard</option>
                                    <option value="Employee Managment">Employee Managment</option>
                                    <option value="Teacher Managment">Teacher Managment</option>
                                    <option value="Class & Subject Managment">Class & Subject Managment</option>
                                    <option value="Student Managment">Student Managment</option>
                                    <option value="Exam & Score Managment">Exam & Score Managment</option>
                                    <option value="Finance Managment">Finance Managment</option>
                                    <option value="User Managment">User Managment</option>
                                    <option value="Role & Permission Managment">Role & Permission Managment</option>
                                    <option value="Wesite Managment">Wesite Managment</option>
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
