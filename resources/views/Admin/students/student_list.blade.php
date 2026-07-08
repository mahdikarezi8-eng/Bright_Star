@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-inline"> All Students list</h4>
                <div class="table-responsive">
                    <hr>
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
                                <th>Class</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td class="py-1 px-2 ">
                                        <img
                                            src="{{ !empty($student->image) && file_exists(public_path('images/students/' . $student->image))
                                                ? asset('images/students/' . $student->image)
                                                : asset('images/no_image.jpg') }}">
                                    </td>

                                    <td class="py-2 px-2">{{ $student->first_name }}</td>
                                    <td class="py-2 px-2">{{ $student->last_name }}</td>
                                    <td class="py-2 px-2">{{ $student->phone }}</td>
                                    <td class="py-2 px-2">{{ $student->class->class_name }}</td>
                                    <td class="py-2 px-2">
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light" href="{{ route('student_detail', $student->id) }}"><span
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
