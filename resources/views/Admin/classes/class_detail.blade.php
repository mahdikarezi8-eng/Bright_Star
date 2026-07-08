@extends('Admin.master')

@section('content')
    <div class="content-wrapper mt-3">

        <div class="row g-4 align-items-stretch">

            {{-- LEFT SIDE --}}
            <div class="col-lg-4 col-md-5 d-flex flex-column">

                {{-- CLASS PROFILE --}}
                <div class="card shadow mb-4 h-100">

                    <div class="card-body text-center">

                        <img src="/images/class/{{ $class->image }}" class="rounded-circle p-1 bg-primary mb-3" width="140"
                            height="140">

                        <h5 class="mb-2">
                            {{ $class->class_name }}
                        </h5>

                        <p class="mb-1">Capacity: {{ $class->capacity }}</p>
                        <p class="mb-3">Fees: {{ $class->fees }} AFG</p>

                        <a href="{{ route('class_edit', $class->id) }}" class="btn btn-primary btn-sm">
                            Edit
                        </a>

                        <a href="{{ route('class_delete', $class->id) }}" class="btn btn-danger btn-sm delete">
                            Delete
                        </a>

                    </div>
                </div>

                {{-- CLASS INFO --}}
                <div class="card shadow h-100">

                    <div class="card-body">

                        <h5 class="mb-3">Class Information</h5>
                        <table class="table table-striped mb-0">
                            <tr>
                                <td class="px-1 py-3">Name</td>
                                <td class="px-1 py-3">{{ $class->class_name }}</td>
                            </tr>

                            <tr>
                                <td class="px-1 py-3">Capacity</td>
                                <td class="px-1 py-3">{{ $class->capacity }}</td>
                            </tr>

                            <tr>
                                <td class="px-1 py-3">Fees</td>
                                <td class="px-1 py-3">{{ $class->fees }} AFG</td>
                            </tr>
                        </table>

                    </div>

                </div>

            </div>
            {{-- RIGHT SIDE --}}
            <div class="col-lg-8 col-md-7 d-flex flex-column">

                {{-- DESCRIPTION --}}
                <div class="card shadow mb-4 h-100">

                    <div class="card-body">

                        <h5 class="mb-3">Class Description</h5>

                        <p>
                            {{ $class->description ?? 'No description available' }}
                        </p>

                    </div>
                </div>
                {{-- STUDENTS --}}
                <div class="card shadow mb-4 h-100">

                    <div class="card-body">

                        <h5 class="mb-3">Students in this Class</h5>

                        <div class="table-responsive" style="max-height: 300px; overflow-y:auto;">

                            <table class="table table-striped table-hover">

                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Father Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($class->students as $student)
                                        <tr>
                                            <td>
                                                <img src="/images/students/{{ $student->image }}" width="40"
                                                    height="40" class="rounded-circle">
                                            </td>
                                            <td>{{ $student->first_name }}</td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->father_name }}</td>
                                            <td>{{ $student->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>

                    </div>
                </div>
                {{-- SUBJECTS --}}
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h5 class="mb-0">Subjects in this Class</h5>

                            <a href="{{ route('assign_subject_to_class', $class->id) }}" class="btn btn-primary btn-sm">
                                Assign Subject
                            </a>

                        </div>

                        <div class="table-responsive" style="max-height: 300px; overflow-y:auto;">

                            <table id="data" class="table table-striped table-hover">

                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Author</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($class->subjects as $subject)
                                        <tr>
                                            <td class="px-2 py-3">{{ $subject->subject_name }}</td>
                                            <td class="px-2 py-3">{{ $subject->authore }}</td>
                                            <td>
                                                {{-- <button class="btn btn-danger btn-sm delete">
                                                    <a class="text-light"
                                                        href="{{ route('class_subject_delete', ['class_id' => $class->id, 'subject_id' => $subject->id]) }}"><span
                                                            class="fa-solid fa-trash "></span></a>
                                                </button> --}}
                                                <a class="btn btn-danger btn-sm delete"
                                                    href="{{ route('class_subject_delete', [
                                                        'class_id' => $class->id,
                                                        'subject_id' => $subject->id,
                                                    ]) }}">

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
