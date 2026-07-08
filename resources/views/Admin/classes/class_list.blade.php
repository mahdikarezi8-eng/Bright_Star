@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title ">All Class List</h4>
                    <a href="{{ route('class_add') }}" class ="btn btn-primary btn-sm">Create new
                        Class</a>
                </div>

                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Image
                                </th>

                                <th>
                                    Class Name
                                </th>
                                <th>
                                    Fees
                                </th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $class)
                                <tr>
                                    <td class="py-2 px-2 "><img src="images/class/{{ $class->image }}" alt="image">
                                    </td>
                                    <td class="py-2 px-2">{{ $class->class_name }}</td>
                                    <td class="py-2 px-2">{{ $class->fees }} AFG</td>
                                    <td class="py-2 px-2">
                                        <button class="btn btn-primary btn-sm">
                                            <a class="text-dark" href="{{ route('class_detail', $class->id) }}"><span
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
