@extends('Admin.master')

@section('content')

    <style>
        .profile-card-modern {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            background: #fff;
            position: relative;
            height: 100%;
        }

        .profile-image-modern {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 4px solid #4e73df;
            object-fit: cover;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }

        .profile-image-modern:hover {
            transform: scale(1.05);
        }

        .info-badge-modern {
            background: #f8f9fc;
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
            color: #333;
        }

        .info-badge-modern:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .stat-badge-modern {
            background: #4e73df;
            color: #fff;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .welcome-card-full {
            height: 100%;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            background: #fff;
        }
    </style>

    <div class="container-fluid">


        <div class="teacher-dashboard">
            <div class="row mb-4 mt-4">
                <div class="col-lg-4 col-md-5">
                    <div class="profile-card-modern">
                        <div class="card-body p-4 position-relative">
                            <div class="text-center mb-4">
                                @php
                                    $imagePath = $teacher->image
                                        ? asset('images/teachers/' . $teacher->image)
                                        : asset('images/default-user.png');
                                @endphp

                                <img src="{{ $imagePath }}" alt="{{ $teacher->first_name }}"
                                    class="profile-image-modern mb-3">

                                <h3 class="mb-1 fw-bold text-dark">{{ $teacher->first_name }} {{ $teacher->last_name }}</h3>
                                <div class="stat-badge-modern mb-3">
                                    {{ $teacher->education_degree ?? 'Professional Educator' }}
                                </div>
                            </div>

                            <div class="d-flex flex-column gap-3">
                                <div class="info-badge-modern">
                                    <i class="fas fa-envelope text-primary"></i>
                                    <span>{{ $teacher->email }}</span>
                                </div>
                                <div class="info-badge-modern">
                                    <i class="fas fa-phone text-primary"></i>
                                    <span>{{ $teacher->phone }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-7">
                    <div class="welcome-card-full">
                        <div class="card-body p-4 d-flex flex-column justify-content-center">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                                <div>
                                    <h2 class="mb-2 fw-bold text-dark">Welcome back, {{ $teacher->first_name }}!</h2>
                                    <p class="mb-0 text-muted">Your teaching overview is ready. Check subjects, classes, and students at a glance.</p>
                                </div>
                                <div class="badge bg-primary text-white px-3 py-2 rounded-pill">
                                    <i class="fas fa-calendar-check me-2"></i>Active Today
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stat-card h-100"
                        style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fw-bold mb-1">{{ $subjects->count() }}</h3>
                                    <p class="mb-0 text-muted">Subjects</p>
                                </div>
                                <div class="rounded-circle p-3" style="background:#10b981;color:white;">
                                    <i class="fas fa-book fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card h-100"
                        style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fw-bold mb-1">{{ count($classes) }}</h3>
                                    <p class="mb-0 text-muted">Classes</p>
                                </div>
                                <div class="rounded-circle p-3" style="background:#3b82f6;color:white;">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card h-100"
                        style="background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fw-bold mb-1">{{ count($students) }}</h3>
                                    <p class="mb-0 text-muted">Students</p>
                                </div>
                                <div class="rounded-circle p-3" style="background:#f59e0b;color:white;">
                                    <i class="fas fa-user-graduate fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card h-100"
                        style="background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fw-bold mb-1">{{ $teacher->education_degree ?? 'N/A' }}</h3>
                                    <p class="mb-0 text-muted">Degree</p>
                                </div>
                                <div class="rounded-circle p-3" style="background:#ec4899;color:white;">
                                    <i class="fas fa-graduation-cap fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card panel-card mb-4">
                        <div class="card-header pt-4 pb-3">
                            <h5 class="mb-0"><i class="fas fa-book me-2 text-primary"></i>My Subjects</h5>
                        </div>
                        <div class="card-body">
                            @if ($subjects->count() > 0)
                                <div class="list-group list-group-flush">
                                    @foreach ($subjects as $subject)
                                        <div class="list-row px-0 py-3 d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">{{ $subject->subject_name }}</h6>
                                                <small class="text-muted">Assigned subject</small>
                                            </div>
                                            <span class="badge rounded-pill"
                                                style="background:#dbeafe;color:#1d4ed8;">{{ $subject->classes->count() }}
                                                Classes</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0">No subjects assigned yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card panel-card mb-4">
                        <div class="card-header pt-4 pb-3">
                            <h5 class="mb-0"><i class="fas fa-users me-2 text-info"></i>My Classes</h5>
                        </div>
                        <div class="card-body">
                            @if (count($classes) > 0)
                                <div class="accordion" id="classesAccordion">
                                    @foreach ($classes as $index => $class)
                                        <div class="accordion-item border-0 mb-2 rounded shadow-sm">
                                            <h2 class="accordion-header" id="heading{{ $index }}">
                                                <button class="accordion-button collapsed rounded" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                                    aria-expanded="false" aria-controls="collapse{{ $index }}">
                                                    {{ $class->class_name }} <span class="badge rounded-pill ms-2"
                                                        style="background:#eff6ff;color:#1d4ed8;">{{ $class->students->count() }}
                                                        Students</span>
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading{{ $index }}"
                                                data-bs-parent="#classesAccordion">
                                                <div class="accordion-body">
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($class->students as $student)
                                                            <li class="list-group-item px-0 py-2">
                                                                {{ $student->first_name }} {{ $student->last_name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0">No classes assigned yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card panel-card mb-4">
                        <div class="card-header pt-4 pb-3">
                            <h5 class="mb-0"><i class="fas fa-user-graduate me-2 text-warning"></i>My Students</h5>
                        </div>
                        <div class="card-body">
                            @if (count($students) > 0)
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0">
                                        <thead>
                                            <tr class="border-bottom">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Class</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="rounded-circle me-2"
                                                                style="width:36px;height:36px;background:#e0f2fe;display:flex;align-items:center;justify-content:center;color:#0284c7;">
                                                                <i class="fas fa-user"></i>
                                                            </div>
                                                            <span>{{ $student->first_name }}
                                                                {{ $student->last_name }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $student->Classe->class_name ?? 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted mb-0">No students found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endsection
