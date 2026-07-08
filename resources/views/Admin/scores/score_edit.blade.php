@extends('Admin.master')
@section('content')
    <div class='card mt-3 mr-3 ml-3'>
        <div class="card-body">
            <h4 class="card-title">Edit Score</h4>
            <form class="form-sample mt-3" action="{{ route('score_update', $score->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Student</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="student_id">
                                    <option selected disabled>Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}"
                                            {{ $score->id == $student->id ? 'selected' : '' }}>
                                            {{ $student->first_name }}{{ $student->last_name }}

                                        </option>
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
                            <label class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="subject_id">
                                    <option selected disabled>Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{ $score->id == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->subject_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('subject_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Class</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="class_id">
                                    <option selected disabled>Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ $score->id == $class->id ? 'selected' : '' }}>
                                            {{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('class_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Exam Year</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $score->exam_year }}" class="form-control"
                                    name="exam_year">
                            </div>
                            @error('exam_year')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Chance</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $score->first_chance }}" class="form-control"
                                    name="first_chance">
                            </div>
                            @error('first_chance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Second Chance</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $score->second_chance }}" class="form-control"
                                    name="second_chance">
                            </div>
                            @error('second_chance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
            </form>
        </div>
    </div>
@endsection
