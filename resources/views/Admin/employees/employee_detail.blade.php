@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="row g-4">
            <!-- LEFT COLUMN (Profile + Account) -->
            <div class="col-lg-4 col-md-5 col-13">
                <!-- Profile -->
                <div class="card shadow mb-4">
                    <div class="card-body text-center">

                        <img src="/images/employee/{{ $employee->image }}" class="rounded-circle p-1 bg-primary mb-3"
                            width="140" height="140">

                        <h5 class="mb-3">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </h5>

                        <p class="mb-1">{{ $employee->phone }}</p>
                        <p class="mb-1">{{ $employee->curent_ddress }}</p>
                        <p class="mb-3">{{ $employee->email }}</p>

                        @if (Auth::user()->can('employee_edit'))
                            <a href="{{ route('employee_edit', $employee->id) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        @endif
                        @if (Auth::user()->can('employee_delete'))
                            <a href="{{ route('employee_delete', $employee->id) }}" class="delete btn btn-danger btn-sm ">
                                Delete
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Account Info (UNDER PROFILE) -->
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-4">Account Information</h5>
                        <table class="table table-striped">
                            <tr>
                                <td class="px-3 py-3">Position</td>
                                <td class="px-3 py-3">{{ $employee->position }}</td>
                            </tr>

                            <tr>
                                <td>Role</td>
                                <td class="px-3 py-3">{{ $employee->User->role }}</td>
                            </tr>
                            <tr>
                                <td class="px-3 py-3">Reg Date</td>
                                <td class="px-3 py-3">{{ $employee->reg_date }}</td>
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
                                    <td class="px-3 py-3">{{ $employee->first_name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Last Name</td>
                                    <td class="px-3 py-3">{{ $employee->last_name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Father Name</td>
                                    <td class="px-3 py-3">{{ $employee->father_name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Phone</td>
                                    <td class="px-3 py-3">{{ $employee->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Email</td>
                                    <td class="px-3 py-3">{{ $employee->email }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">NIC</td>
                                    <td class="px-3 py-3">{{ $employee->nic }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Province</td>
                                    <td class="px-3 py-3">{{ $employee->province }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Address</td>
                                    <td class="px-3 py-3">{{ $employee->curent_address }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Gender</td>
                                    <td class="px-3 py-3">{{ $employee->gender == 0 ? 'Male' : 'Female' }}</td>
                                </tr>

                                <tr>
                                    <td class="px-3 py-3">Reg Date</td>
                                    <td class="px-3 py-3">{{ $employee->reg_date }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Position</td>
                                    <td class="px-3 py-3">{{ $employee->position }}</td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-3">Salary</td>
                                    <td class="px-3 py-3">{{ $employee->gross_salary }} AFG</td>
                                </tr>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
