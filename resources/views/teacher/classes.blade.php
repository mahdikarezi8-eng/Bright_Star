@extends('Admin.master')

@section('content')

    <style>
        .page-title {
            font-weight: 700;
            color: #2c3e50;
        }

        .class-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .class-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, .15);
        }

        .class-header {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: #fff;
            padding: 18px;
            cursor: pointer;
        }

        .student-count {
            background: #fff;
            color: #224abe;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: bold;
        }

        .table thead {
            background: #f8f9fc;
        }

        .table tbody tr:hover {
            background: #f2f6ff;
            transition: .3s;
        }

        .subject-badge {
            background: linear-gradient(45deg, #1cc88a, #17a673);
            color: #fff;
            padding: 6px 10px;
            border-radius: 20px;
            margin: 2px;
            display: inline-block;
            font-size: 12px;
        }

        .student-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #4e73df;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title">
                <i class="fas fa-chalkboard-teacher text-primary"></i>
                My Classes
            </h2>
        </div>

        @if (count($classes))
            <div class="accordion" id="teacherAccordion">

                @foreach ($classes as $index => $class)
                    <div class="class-card">

                        <div class="class-header accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#class{{ $index }}">

                            <div class="w-100 d-flex justify-content-between align-items-center">

                                <div>
                                    <h5 class="mb-1">
                                        <i class="fas fa-school me-2"></i>
                                        {{ $class->class_name }}
                                    </h5>

                                    <small>
                                        Teacher Dashboard
                                    </small>

                                </div>

                                <span class="student-count">
                                    {{ $class->students->count() }} Students
                                </span>

                            </div>

                        </div>

                        <div id="class{{ $index }}" class="accordion-collapse collapse">

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table align-middle">

                                        <thead>

                                            <tr>

                                                <th>#</th>

                                                <th>Student</th>

                                                <th>Subjects</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach ($class->students as $student)
                                                <tr>

                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>

                                                        <div class="d-flex align-items-center">

                                                            <div class="student-avatar me-3">

                                                                {{ strtoupper(substr($student->first_name, 0, 1)) }}

                                                            </div>

                                                            <div>

                                                                <strong>

                                                                    {{ $student->first_name }}
                                                                    {{ $student->last_name }}

                                                                </strong>

                                                            </div>

                                                        </div>

                                                    </td>

                                                    <td>

                                                        @foreach ($subjects as $subject)
                                                            @if ($subject->classes->contains($class))
                                                                <span class="subject-badge">

                                                                    {{ $subject->subject_name }}

                                                                </span>
                                                            @endif
                                                        @endforeach

                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <div class="card shadow border-0">

                <div class="card-body text-center py-5">

                    <i class="fas fa-school fa-4x text-primary mb-3"></i>

                    <h4>No Classes Assigned</h4>

                    <p class="text-muted">
                        You don't have any classes assigned yet.
                    </p>

                </div>

            </div>
        @endif

    </div>

@endsection
