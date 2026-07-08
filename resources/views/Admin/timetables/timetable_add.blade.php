@extends('Admin.master')

@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">

            <h4 class="card-title">Add New Timetable</h4>

            <form action="{{ route('timetable_save') }}" method="POST" class="form-sample">
                @csrf

                <p class="card-description text-success">
                    Timetable Informations
                </p>

                <div class="row">
                    <!-- Teacher -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Teacher</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="teacher_id">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">
                                            {{ $teacher->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('teacher_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Subject -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="subject_id">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">
                                            {{ $subject->subject_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('subject_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <br>

                <div class="row">

                    <!-- Class -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Class</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="class_id">
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">
                                            {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('class_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Weekday -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Day</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="weekday">
                                    <option value="1">Saturday</option>
                                    <option value="2">Sunday</option>
                                    <option value="3">Monday</option>
                                    <option value="4">Tuesday</option>
                                    <option value="5">Wednesday</option>
                                    <option value="6">Thursday</option>
                                </select>
                            </div>
                        </div>
                        @error('weekday')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <br>

                <div class="row">

                    <!-- Time -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Time (Period)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="time" min="1" max="10">
                            </div>
                        </div>
                        @error('time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <br>

                <button type="submit" class="btn btn-primary mr-2">
                    Save
                </button>

            </form>

        </div>
    </div>
@endsection
