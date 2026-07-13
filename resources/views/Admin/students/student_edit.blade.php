@extends('Admin.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">Edite Student</h4>
            <form class="form-sample" action="{{ route('student_update', $student->id) }}" method="post"
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
                                <input type="text" value="{{ $student->first_name }}" class="form-control"
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
                                <input type="text" value="{{ $student->last_name }}" class="form-control"
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
                                <input type="text" value="{{ $student->father_name }}" class="form-control"
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
                                <input type="number" min="1" value="{{ $student->birth_year }}" class="form-control"
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
                                <input type="text" value="{{ $student->nic }}" class="form-control" name="nic">
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
                                <input type="number" value="{{ $student->phone }}" class="form-control" name="phone">
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
                                <input type="text" value="{{ $student->email }}" class="form-control" name="email">
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
                                <input type="text" value="{{ $student->curent_address }}" class="form-control"
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
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" value="{{ $student->image }}" class="form-control" name ="image">
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
                                    <option value="1" {{ $student->gender == 1 ? 'selected' : '' }}>Male</option>
                                    <option value="0" {{ $student->gender == 0 ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Class</label>
                        <div class="col-sm-9">
                            <select class="form-control form-select" name="class_id">
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ $student->class_id == $class->id ? 'selected' : '' }}>{{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('teacher_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
        </div>
    </div>
@endsection
