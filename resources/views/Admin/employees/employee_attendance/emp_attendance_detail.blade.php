@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title mb-2 mb-md-0">
                        All Employee Attendance Detail
                    </h4>
                </div>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead class="text-muted">
                            <tr>
                                <th class="text-center">
                                    Remark
                                </th>
                                <th class="text-center">
                                    Absent Date
                                </th>
                                <th class="text-center">
                                    Detail
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td class="py-3 px-3 text-center"">
                                        {{ $attendance->remark }}</td>
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        {{ $attendance->attendance_date }}
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <a href="{{ route('emp_attendance_delete', $attendance->id) }}"
                                            class="btn btn-danger  btn-sm delete"><i class="fa  fa-solid fa-trash "></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
