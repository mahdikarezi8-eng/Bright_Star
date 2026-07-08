@extends('Admin.master')

@section('content')
    <div class="card mt-3 mr-3 ml-3">
        <div class="card-body">
            <h4 class="card-title">Teacher Attendance Edite</h4>
            <form class="form-sample"
                action="{{ route('teacher_attendance_update', [$attendance->teacher_id, $attendance->absent_year, $attendance->absent_month, $attendance->absent_day]) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Teacher</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="teacher_id">
                                    @foreach ($teachers as $teach)
                                        <option value="{{ $teach->id }}"
                                            {{ $teach->id == $attendance->teacher_id ? 'selected' : '' }}>
                                            {{ $teach->first_name }}
                                            {{ $teach->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('teacher_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                                <input type="date"
                                    value="{{ $attendance->absent_year }}-{{ str_pad($attendance->absent_month, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($attendance->absent_day, 2, '0', STR_PAD_LEFT) }}"
                                    class="form-control" name="absent_date">
                            </div>
                        </div>
                    </div>
                    @error('absent_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remark</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="remark"
                                    value="{{ $attendance->remark }}">
                            </div>
                        </div>
                    </div>
                    @error('remark')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
        </div>
    </div>
@endsection
