@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="row g-4">
            <!-- LEFT COLUMN (Profile + Account) -->
            <div class="col-lg-4 col-md-5 col-13">
                <!-- Profile -->
                <div class="card shadow mb-4">
                    <div class="card-body text-center">

                        <img src="/images/students/{{ $student->image }}" class="rounded-circle p-1 bg-primary mb-3"
                            width="140" height="140">
                        <h5 class="mb-3">
                            {{ $student->first_name }} {{ $student->last_name }}
                        </h5>
                        <p class="mb-1">{{ $student->phone }}</p>
                        <p class="mb-1">{{ $student->curent_ddress }}</p>
                        <p class="mb-3">{{ $student->email }}</p>

                        <a href="{{ route('student_edit', $student->id) }}" class="btn btn-primary btn-sm">
                            Edit
                        </a>
                        <a href="{{ route('student_delete', $student->id) }}" class="delete btn btn-danger btn-sm ">
                            Delete
                        </a>

                    </div>
                </div>

                <!-- Account Info (UNDER PROFILE) -->
                {{-- <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-4">Personal Information</h5>
                        <table class="table table-striped">
                            <tr>
                                <td class="px-3 py-3">Name</td>
                                <td class="px-3 py-3">{{ $student->first_name }}</td>
                            </tr>

                            <tr>
                                <td>Last Name</td>
                                <td class="px-3 py-3">{{ $student->last_name }}</td>
                            </tr>
                            <tr>
                                <td class="px-3 py-3">Birth Year</td>
                                <td class="px-3 py-3">{{ $student->birth_year }}</td>
                            </tr>
                            <tr>
                                <td class="px-3 py-3">Father Name</td>
                                <td class="px-3 py-3">{{ $student->father_name }}</td>
                            </tr>
                        </table>
                    </div>
                </div> --}}

            </div>

            <!-- RIGHT: Basic Info -->
            <div class="col-lg-8 col-md-7 col-13">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Basic Information</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <td class="px-3 py-3">Full Name</td>
                                    <td class="px-3 py-3">{{ $student->first_name }} {{ $student->last_name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Father Name</td>
                                    <td class="px-3 py-3">{{ $student->father_name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Birth Year</td>
                                    <td class="px-3 py-3">{{ $student->birth_year }}</td>
                                </tr>

                                <tr>
                                    <td class="px-3 py-3">Class</td>
                                    <td class="px-3 py-3">{{ $student->class->class_name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Phone</td>
                                    <td class="px-3 py-3">{{ $student->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Email</td>
                                    <td class="px-3 py-3">{{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">NIC</td>
                                    <td class="px-3 py-3">{{ $student->nic }}</td>
                                </tr>

                                <tr>
                                    <td class="px-3 py-3">Address</td>
                                    <td class="px-3 py-3">{{ $student->curent_address }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Gender</td>
                                    <td class="px-3 py-3">{{ $student->gender == 0 ? 'Male' : 'Femal' }}</td>
                                </tr>

                                <tr>
                                    <td class="px-3 py-3">Reg Date</td>
                                    <td class="px-3 py-3">{{ $student->reg_date }}</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
