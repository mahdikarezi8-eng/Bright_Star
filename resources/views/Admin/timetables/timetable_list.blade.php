@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Time Table</h4>
                    <a href="{{ route('timetable_add') }}" class="btn btn-primary btn-sm">
                        Create Timetable
                    </a>
                </div>
                @php
                    $days = [
                        1 => 'Saturday',
                        2 => 'Sunday',
                        3 => 'Monday',
                        4 => 'Tuesday',
                        5 => 'Wednesday',
                        6 => 'Thursday',
                    ];

                    $periods = [1, 2, 3, 4, 5, 6, 7];
                @endphp

                <form method="GET" action="" class="mt-1">
                    <div class="row mb-3">
                        <!-- Class Filter -->
                        <div class="col-md-3">
                            <select name="class_id" class="form-select mt-2">
                                <option disabled selected>Select Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm mt-2">
                                Filter
                            </button>
                        </div>

                    </div>

                </form>


                <div class="table-responsive">
                    <table class="timetable">
                        <thead>
                            <tr>
                                <th>Day</th>
                                @foreach ($periods as $p)
                                    <th>Period {{ $p }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($days as $dayKey => $dayName)
                                <tr>

                                    <td class="day">{{ $dayName }}</td>

                                    @foreach ($periods as $p)
                                        <td>

                                            @if (isset($table[$dayKey][$p]))
                                                @php $tt = $table[$dayKey][$p]; @endphp

                                                <!-- SUBJECT BIG -->
                                                <div class="subject">
                                                    {{ $tt->subject->subject_name }}
                                                </div>

                                                <!-- TEACHER SMALL -->
                                                <div class="teacher text-dark">
                                                    {{ $tt->teacher->first_name }} {{ $tt->teacher->last_name }}
                                                </div>

                                                <!-- actions -->
                                                <div class="actions">

                                                    <a href="{{ route('timetable_edit', $tt->id) }}" class="btn-small edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a href="{{ route('timetable_delete', $tt->id) }}"
                                                        class="btn-small delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <span class="empty">—</span>
                                            @endif
                                        </td>
                                    @endforeach

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>
@endsection
