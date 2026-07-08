@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Employee List</h4>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover DataTable">
                        <thead class="text-muted">
                            <tr>
                                <th>
                                    Image
                                </th>ٰ
                                <th>
                                    First name
                                </th>
                                <th>
                                    Last Name
                                </th>

                                <th>
                                    Phone
                                </th>
                                <th>
                                    Position
                                </th>
                                <th>
                                    Salary
                                </th>ٰ
                                <th>Detil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="py-2 px-2 "><img src="images/employee/{{ $employee->image }}" alt="image">
                                    </td>
                                    <td class="py-2 px-2">{{ $employee->first_name }}</td>
                                    <td class="py-2 px-2">{{ $employee->last_name }}</td>
                                    <td class="py-2 px-2">{{ $employee->phone }}</td>
                                    <td class="py-2 px-2">{{ $employee->position }}</td>
                                    <td class="py-2 px-2">{{ $employee->gross_salary }} AFG</td>

                                    <td class="py-2 px-2 ">
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light" href="{{ route('employee_detail', $employee->id) }}"><span
                                                    class="fa-solid fa-eye"></span></a>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $employees->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
