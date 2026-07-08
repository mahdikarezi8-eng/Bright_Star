@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title">All Teacher Attendance List</h4>
                    <a href="{{ route('teacher_attendance_add') }}" class="btn btn-primary btn-sm  mb-3"> Take
                        Attendance</a>
                </div>
                @php
                    $month = request('month', date('n'));
                    $year = request('year', date('Y'));
                @endphp
                <form method="GET" action="{{ route('teacher_attendance_list') }}" class="mt-3">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select name="month" class="form-select border-gray">
                                <option disabled selected>Select Month</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="year" class="form-select border-gray">
                                <option disabled selected>Select Year</option>
                                @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">

                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead class="text-muted">
                            <tr>
                                <th class="text-center">
                                    Id
                                </th>
                                <th class="text-center">
                                    Name
                                </th>

                                <th class="text-center">
                                    Absent Amount
                                </th>
                                <th class="text-center">
                                    Detail
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher_attendance)
                                <tr>
                                    <td class="py-3 px-3 text-center"">{{ $teacher_attendance->id }}</td>
                                    <td class="py-3 px-3 text-center"">
                                        {{ $teacher_attendance->first_name }} {{ $teacher_attendance->last_name }}</td>
                                    <td class="py-3 px-3 text-center">
                                        {{ $teacher_attendance->teacher_attendances->count() }} Day
                                    </td>

                                    <td class="py-2 px-2 text-center">
                                        <a href="{{ route('teacher_attendance_detail', ['id' => $teacher_attendance->id, 'year' => $year, 'month' => $month]) }}"
                                            class="btn btn-success  btn-sm"><i class="fa  fa-solid fa-eye "></i></a>
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
