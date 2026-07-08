@extends('Admin.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title d-inline">All Employee Document list</h4>
            @if (Auth::user()->can('employee_document_add'))
                <a href="{{ route('emp_document_add') }}" class ="btn btn-primary btn-sm float-right">Create new document</a>
            @endif
            <div class="table-responsive">
                <hr>
                <table id="data" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>
                                Document Name
                            </th>ٰ
                            <th>
                                File
                            </th>
                            <th>
                                Upload Date
                            </th>
                            @if (Auth::user()->can('employee_document_edit'))
                                <th>Update</th>
                            @endif
                            @if (Auth::user()->can('employee_document_delete'))
                                <th>Delete</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td class="py-2 px-2">{{ $document->employee->first_name }}</td>
                                <td class="py-2 px-2">{{ $document->employee->last_name }}</td>
                                <td class="py-2 px-2">{{ $document->document_name }}</td>
                                <td class="py-2 px-2">
                                    <a href=" {{ route('emp_file_download', $document->document_file) }}"><i
                                            style="font-size: 20px;" class="fa fa-download text-primary"></i></a>
                                </td>
                                <td class="py-2 px-2">{{ $document->upload_date }}</td>
                                @if (Auth::user()->can('employee_document_edit'))
                                    <td class="py-2 px-2">
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light"
                                                href="{{ route('emp_document_edit', $document->id) }}"><span
                                                    class="fa-solid fa-pen-to-square"></span></a>
                                        </button>
                                    </td>
                                @endif
                                @if (Auth::user()->can('employee_document_delete'))
                                    <td class="py-2 px-2">
                                        <a href="{{ route('emp_document_delete', $document->id) }}"
                                            class="btn btn-danger btn-sm delete">
                                            <i class="fa-solid fa-trash">
                                            </i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
