@extends('admin.master')
@section('content')
    <div class="card mr-3 mt-3 ml-3">
        <div class="card-body">
            <h4 class="card-title">Edite Teacher</h4>
            <form class="form-sample" action="{{ route('teacher_update', $teacher->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <p class="card-description text-success">
                    Personal info
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->first_name }}" class="form-control"
                                    name="first_name">
                            </div>
                        </div>
                    </div>
                    @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->last_name }}" class="form-control"
                                    name="last_name">
                            </div>
                        </div>
                    </div>
                    @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Father Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->father_name }}" class="form-control"
                                    name="father_name">
                            </div>
                        </div>
                    </div>
                    @error('father_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Birth year</label>
                            <div class="col-sm-9">
                                <input type="number" min="1" value="{{ $teacher->birth_year }}" class="form-control"
                                    name="birth_year">
                            </div>
                        </div>
                    </div>
                    @error('birth_year')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIC</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->nic }}" class="form-control" name="nic">
                            </div>
                        </div>
                    </div>
                    @error('nic')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{ $teacher->phone }}" class="form-control" name="phone">
                            </div>
                        </div>
                    </div>
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->email }}" class="form-control" name="email">
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Curent Address</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->curent_address }}" class="form-control"
                                    name="curent_address">
                            </div>
                        </div>
                    </div>
                    @error('curent_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">University</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->education_university }}" class="form-control"
                                    name="education_university">
                            </div>
                        </div>
                    </div>
                    @error('education_university')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Aducation Degree</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->education_degree }}" class="form-control"
                                    name="education_degree">
                            </div>
                        </div>
                    </div>
                    @error('education_degree')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Talent Score</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->talent_score }}" class="form-control"
                                    name="talent_score">
                            </div>
                        </div>
                    </div>
                    @error('talent_score')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Education Year</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->education_year }}" class="form-control"
                                    name="education_year">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gross Salary</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->gross_salary }}" class="form-control"
                                    name="gross_salary">
                            </div>
                        </div>
                    </div>
                    @error('gross_salary')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Reg Date</label>
                            <div class="col-sm-9">
                                <input type="date" value="{{ $teacher->reg_date }}" class="form-control"
                                    name="reg_date">
                            </div>
                        </div>
                    </div>
                    @error('reg_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" value="{{ $teacher->image }}" class="form-control"
                                    name ="image">
                            </div>
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="gender">
                                    <option value="1" {{ $teacher->gender == 1 ? 'selected' : '' }}>Male</option>
                                    <option value="0" {{ $teacher->gender == 0 ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Food</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $teacher->food }}" class="form-control" name ="food">
                            </div>
                        </div>
                        @error('food')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
        </div>
    </div>
@endsection
