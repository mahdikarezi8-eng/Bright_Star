@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Teachers list</h4>
                <hr>
                <div class="table-responsive">
                    <table id="data" class="table table-striped table-hover">
                        <thead>
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
                                    Salary
                                </th>ٰ
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td class="py-2 px-2">
                                        <img
                                            src="{{ !empty($teacher->image) && file_exists(public_path('images/teachers/' . $teacher->image))
                                                ? asset('images/teachers/' . $teacher->image)
                                                : asset('images/no_image.jpg') }}">
                                    </td>
                                    <td class="py-2 px-2">{{ $teacher->first_name }}</td>
                                    <td class="py-2 px-2">{{ $teacher->last_name }}</td>
                                    <td class="py-2 px-2">{{ $teacher->phone }}</td>
                                    <td class="py-2 px-2">{{ $teacher->gross_salary }} AFG</td>

                                    <td class="py-2 px-2">
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light" href="{{ route('teacher_detail', $teacher->id) }}"><span
                                                    class="fa-solid fa-eye"></span></a>
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
