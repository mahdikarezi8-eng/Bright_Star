@extends('Admin.master')

@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">

            <h4 class="card-title">Edit Timetable</h4>

            <form action="{{ route('timetable_update', $timetable->id) }}" method="POST" class="form-sample">
                @csrf
                @method('PUT')

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
                                        <option value="{{ $teacher->id }}"
                                            {{ $timetable->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="subject_id">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{ $timetable->subject_id == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->subject_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                                        <option value="{{ $class->id }}"
                                            {{ $timetable->class_id == $class->id ? 'selected' : '' }}>
                                            {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Weekday -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Day</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="weekday">
                                    <option value="1" {{ $timetable->weekday == 1 ? 'selected' : '' }}>Saturday
                                    </option>
                                    <option value="2" {{ $timetable->weekday == 2 ? 'selected' : '' }}>Sunday</option>
                                    <option value="3" {{ $timetable->weekday == 3 ? 'selected' : '' }}>Monday</option>
                                    <option value="4" {{ $timetable->weekday == 4 ? 'selected' : '' }}>Tuesday
                                    </option>
                                    <option value="5" {{ $timetable->weekday == 5 ? 'selected' : '' }}>Wednesday
                                    </option>
                                    <option value="6" {{ $timetable->weekday == 6 ? 'selected' : '' }}>Thursday
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <br>

                <!-- Time -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Time (Period)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="time" min="1" max="10"
                                    value="{{ $timetable->time }}">
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <button type="submit" class="btn btn-primary mr-2">
                    Update
                </button>

            </form>

        </div>
    </div>
@endsection
