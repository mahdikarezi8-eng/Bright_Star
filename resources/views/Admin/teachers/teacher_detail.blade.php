@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="row g-4">
            <!-- LEFT COLUMN (Profile + Account) -->
            <div class="col-lg-4 col-md-5 col-13">
                <!-- Profile -->
                <div class="card shadow mb-4">
                    <div class="card-body text-center">

                        <img src="/images/teachers/{{ $teacher->image }}" class="rounded-circle p-1 bg-primary mb-3"
                            width="140" height="140">
                        <h5 class="mb-3">
                            {{ $teacher->first_name }} {{ $teacher->last_name }}
                        </h5>

                        <p class="mb-1">{{ $teacher->phone }}</p>
                        <p class="mb-1">{{ $teacher->curent_ddress }}</p>
                        <p class="mb-3">{{ $teacher->email }}</p>

                        <a href="{{ route('teacher_edit', $teacher->id) }}" class="btn btn-primary btn-sm">
                            Edit
                        </a>
                        <a href="{{ route('teacher_delete', $teacher->id) }}" class="delete btn btn-danger btn-sm ">
                            Delete
                        </a>

                    </div>
                </div>

                <!-- Account Info (UNDER PROFILE) -->
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-4">Education Information</h5>
                        <table class="table table-striped">
                            <tr>
                                <td class="px-3 py-3">Education</td>
                                <td class="px-3 py-3">{{ $teacher->education_degree }}</td>
                            </tr>

                            <tr>
                                <td>University</td>
                                <td class="px-3 py-3">{{ $teacher->education_university }}</td>
                            </tr>
                            <tr>
                                <td class="px-3 py-3">Education Year</td>
                                <td class="px-3 py-3">{{ $teacher->education_year }}</td>
                            </tr>
                            <tr>
                                <td class="px-3 py-3">Talent Score</td>
                                <td class="px-3 py-3">{{ $teacher->talent_score }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>

            <!-- RIGHT: Basic Info -->
            <div class="col-lg-8 col-md-7 col-13">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Basic Information</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <td class="px-3 py-3">First Name</td>
                                    <td class="px-3 py-3">{{ $teacher->first_name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Last Name</td>
                                    <td class="px-3 py-3">{{ $teacher->last_name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Father Name</td>
                                    <td class="px-3 py-3">{{ $teacher->father_name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Phone</td>
                                    <td class="px-3 py-3">{{ $teacher->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Email</td>
                                    <td class="px-3 py-3">{{ $teacher->email }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">NIC</td>
                                    <td class="px-3 py-3">{{ $teacher->nic }}</td>
                                </tr>

                                <tr>
                                    <td class="px-3 py-3">Address</td>
                                    <td class="px-3 py-3">{{ $teacher->curent_address }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Gender</td>
                                    <td class="px-3 py-3">{{ $teacher->gender == 1 ? 'Male' : 'Femal' }}</td>
                                </tr>

                                <tr>
                                    <td class="px-3 py-3">Reg Date</td>
                                    <td class="px-3 py-3">{{ $teacher->reg_date }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Birth Year</td>
                                    <td class="px-3 py-3">{{ $teacher->birth_year }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Salary</td>
                                    <td class="px-3 py-3">{{ $teacher->gross_salary }} AFG</td>
                                </tr>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
