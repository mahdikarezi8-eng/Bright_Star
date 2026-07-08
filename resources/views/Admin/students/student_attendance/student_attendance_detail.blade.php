@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title mb-2 mb-md-0">
                        All student Attendance Detail
                    </h4>
                </div>
                <div class="table-responsive">

                    @php
                        $month = request('month', date('n'));
                        $year = request('year', date('Y'));
                    @endphp
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
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student_attendances as $attendance)
                                <tr>

                                    <td class="py-3 px-3 text-center"">
                                        {{ $attendance->absent_type }}</td>
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        {{ $attendance->absent_date }}
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <a href="{{ route('student_attendance_delete', ['id' => $attendance->student_id, 'year' => $year, 'month' => $month]) }}"
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
