{{-- @extends('Admin.master')
@section('content')
    <div class="card mt-3 mr-3 ml-3">
        <div class="card-body">
            <h4 class="card-title">Add Teacher to Subject: {{ $subject->subject_name }}</h4>
            <form class="form-sample" action="{{ route('save_teacher_to_subject', $subject->id) }}" method="post">
                @csrf
                <p class="card-description text-success">
                    Select Teacher
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Teacher</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="teacher_id" required>
                                    <option value="">Select Teacher</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('teacher_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
                <a href="{{ route('subject_detail', $subject->id) }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection --}}
@extends('Admin.master')

@section('content')
    <div class="card mt-3 mr-3 ml-3">
        <div class="card-body">

            <h4 class="card-title">
                Assign Teachers to Subject
            </h4>

            <div class="alert alert-info">
                <strong>Subject:</strong> {{ $subject->subject_name }}
            </div>

            <form action="{{ route('save_teacher_to_subject', $subject->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Select Teachers</label>

                    <select name="teacher_ids[]" class="form-control" multiple size="10" required>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">
                                {{ $teacher->first_name }} {{ $teacher->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @error('teacher_ids')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <br>

                <button type="submit" class="btn btn-primary">
                    Save
                </button>

                <a href="{{ route('subject_detail', $subject->id) }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>
@endsection
