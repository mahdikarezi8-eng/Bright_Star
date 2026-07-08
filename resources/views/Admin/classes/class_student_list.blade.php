@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-inline">The <span class="text-success">{{ $class->class_name }} Class </span> Students
                    List</h4>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    First Name
                                </th>
                                <th>F/Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($class->students as $student)
                                <tr>
                                    <td class="py-2 px-2"><img src="/images/students/{{ $student->image }}" alt="image">
                                    </td>
                                    <td class="py-2 px-2">{{ $student->first_name }}</td>
                                    <td class="py-2 px-2">{{ $student->last_name }}</td>
                                    <td class="py-2 px-2">{{ $student->father_name }}</td>
                                    <td class="py-2 px-2">{{ $student->email }}</td>
                                    {{-- <td>
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light" href="{{ route('class_edit', $class->id) }}"><span
                                                    class="fa-solid fa-pen-to-square"></span></a>
                                        </button>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('class_delete', $class->id) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
