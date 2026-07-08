@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title ">Contact List</h4>
                    <a href="{{ route('contact_add') }}" class ="btn btn-primary btn-sm">Add About</a>
                </div>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Address
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Phone
                                </th>
                                <th>
                                    FaceBook
                                </th>
                                <th>
                                    Instagram
                                </th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact as $con)
                                <tr>
                                    <td class="py-2 px-2">
                                        {{ $con->office }}
                                    </td>
                                    <td class="py-2 px-2">
                                        {{ $con->email }}
                                    </td>

                                    <td class="py-2 px-2">
                                        {{ $con->phone }}
                                    </td>
                                    <td class="py-2 px-2">
                                        {{ $con->facebook }}
                                    </td>
                                    <td class="py-2 px-2">
                                        {{ $con->instagram }}
                                    </td>
                                    <td class="py-2 px-2">
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light" href="{{ route('contact_edit', $con->id) }}"><span
                                                    class="fa-solid fa-pen-to-square"></span></a>
                                        </button>
                                    </td>
                                    <td class="py-2 px-2">
                                        <a href="{{ route('contact_delete', $con->id) }}"
                                            class="btn btn-danger btn-sm delete">
                                            <i class="fa-solid fa-trash"></i></button>
                                        </a>
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
