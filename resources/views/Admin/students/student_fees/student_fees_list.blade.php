@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title mb-2 mb-md-0">
                        Student Fees List
                    </h4>
                    <a href="{{ route('student_fees_add') }}" class="btn btn-primary btn-sm">
                        Add Fess
                    </a>
                </div>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Student
                                </th>ٰ

                                <th>
                                    F/Name
                                </th>
                                <th>
                                    class
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>Pay Date</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fees as $fee)
                                <tr>
                                    <td class="py-2 px-2">{{ $fee->student->first_name }} {{ $fee->student->last_name }}
                                    </td>
                                    <td class="py-2 px-2">{{ $fee->student->father_name }}</td>
                                    <td class="py-2 px-2">{{ $fee->student->class->class_name }}</td>
                                    <td class="py-2 px-2">{{ $fee->student->class->fees }} AFG</td>
                                    <td class="py-2 px-2">{{ $fee->fees_date }}</td>

                                    <td class="py-2 px-2">
                                        <button class="btn btn-danger btn-sm">
                                            <a class="text-light"
                                                href="{{ route('student_fees_delete', ['id' => $fee->student->id, 'year' => $fee->fees_year, 'month' => $fee->fees_month]) }}"><span
                                                    class="fa-solid fa-trash"></span></a>
                                        </button>
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
