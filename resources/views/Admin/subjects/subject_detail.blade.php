@extends('Admin.master')

@section('content')
    <div class="content-wrapper mt-3">
        <div class="row g-4">

            <!-- LEFT: SUBJECT INFORMATION -->
            <div class="col-lg-4 col-md-5 col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-4">Subject Information</h5>

                        <table class="table table-striped">
                            <tr>
                                <td>Name</td>
                                <td>{{ $subject->subject_name }}</td>
                            </tr>
                            <tr>
                                <td>Authore</td>
                                <td>{{ $subject->authore }}</td>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
            <!-- RIGHT SIDE -->
            <div class="col-lg-8 col-md-7 col-12">
                <!-- TOP: TEACHERS -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h5 class="mb-4 d-inline">Teachers Teaching This Subject</h5>
                        <a href="{{ route('add_teacher_to_subject', $subject->id) }}"
                            class="btn btn-primary btn-sm float-right">Assign Teacher</a>
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 tableD">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Position</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subject->teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->id }}</td>
                                            <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>{{ $teacher->phone }}</td>
                                            <td>{{ $teacher->position }}</td>
                                            <td>
                                                {{-- <button class="btn btn-danger btn-sm delete">
                                                    <a class="text-light"
                                                        href="{{ route('subject_teacher_delete', ['subject_id' => $subject->id, 'teacher_id' => $teacher->id]) }}"><span
                                                            class="fa-solid fa-trash "></span></a>
                                                </button> --}}
                                                <a class="btn btn-danger btn-sm delete"
                                                    href="{{ route('subject_teacher_delete', ['subject_id' => $subject->id, 'teacher_id' => $teacher->id]) }}">
                                                    <span class="fa-solid fa-trash"></span>

                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-12 mt-n1">
                <!-- BOTTOM: STUDENTS -->
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-4 d-inline">Students Enrolled in This Subject</h5>
                        <a href="{{ route('add_student_to_subject', $subject->id) }}"
                            class="btn btn-primary btn-sm float-right">Assign Student</a>
                        <div class="table-responsive">
                            <table class="table table-striped mt-2 tableD">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Father Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subject->students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                            <td>{{ $student->father_name }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>
                                                {{-- <button class="btn btn-danger btn-sm delete">
                                                    <a class="text-light"
                                                        href="{{ route('subject_student_delete', ['subject_id' => $subject->id, 'student_id' => $student->id]) }}"><span
                                                            class="fa-solid fa-trash "></span></a>
                                                </button> --}}
                                                <a class="btn btn-danger btn-sm delete"
                                                    href="{{ route('subject_student_delete', ['subject_id' => $subject->id, 'student_id' => $student->id]) }}">
                                                    <span class="fa-solid fa-trash"></span>

                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
