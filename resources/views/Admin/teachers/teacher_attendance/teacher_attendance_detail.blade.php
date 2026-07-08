@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title d-inline">Teacher Attendance Detail</h4>

                <div class="table-responsive">
                    <br>
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
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td class="py-3 px-3 text-center">
                                        {{ $attendance->remark }}
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        {{ $attendance->absent_date }}
                                    </td>

                                    <td class="py-2 px-2 text-center">

                                        <a href="{{ route('teacher_attendance_delete', $attendance->id) }}"
                                            class="btn btn-danger btn-sm delete"><i class="fa-solid fa-trash"></i></a>
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
