@extends('Admin.master')
@section('content')
    <div class="card mt-3 mr-3 ml-3">
        <div class="card-body">
            <h4 class="card-title">Register student Absdent</h4>
            <form class="form-sample" action="{{ route('student_attendance_save') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">student</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="student_id">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->first_name }}
                                            {{ $student->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('student_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Absent Date</label>
                            <div class="col-sm-9">
                                <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="absent_date">
                            </div>
                        </div>
                        @error('absent_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Absent Type</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="absent_type">
                            </div>
                        </div>
                    </div>
                    @error('absent_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
        </div>
    </div>
@endsection
