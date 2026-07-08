@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title">All Subjects list</h4>
                    <a href="{{ route('subject_add') }}" class ="btn btn-primary btn-sm">Add New Subject</a>
                </div>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover mt-3">
                        <thead>
                            <tr>
                                <th class="py-2 px-2">Subject Name</th>
                                <th class="py-2 px-2">Authore</th>
                                <th class="py-2 px-2">Detail</th>
                                <th class="py-2 px-2">Update</th>
                                <th class="py-2 px-2">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $subject)
                                <tr>
                                    <td class="py-2 px-2">{{ $subject->subject_name }}</td>
                                    <td class="py-2 px-2">{{ $subject->authore }}</td>
                                    <td class="py-2 px-2">
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light" href="{{ route('subject_detail', $subject->id) }}"><span
                                                    class="fa-solid fa-eye"></span></a>
                                        </button>
                                    </td>
                                    <td class="py-2 px-2">
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light" href="{{ route('subject_edit', $subject->id) }}"><span
                                                    class="fa-solid fa-pen-to-square"></span></a>
                                        </button>
                                    </td>
                                    <td class="py-2 px-2">
                                        <form method="post" action="{{ route('subject_delete', $subject->id) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                        </form>
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
