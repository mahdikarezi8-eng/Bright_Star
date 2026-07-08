@extends('Admin.master')
@section('content')
    <div class="card mt-3 mr-3 ml-3">
        <div class="card-body">
            <h4 class="card-title">Edite Student Document</h4>
            <form class="form-sample" action="{{ route('student_document_update', $document->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Document Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $document->document_name }}" class="form-control"
                                    name="document_name">
                            </div>
                        </div>
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Document File</label>
                            <div class="col-sm-9">
                                <input type="file" value="{{ $document->document_file }}" class="form-control"
                                    name="document_file">
                            </div>
                        </div>
                    </div>
                    @error('document_file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Updload Date</label>
                            <div class="col-sm-9">
                                <input type="date" value="{{ $document->upload_date }}" class="form-control"
                                    name="upload_date">
                            </div>
                        </div>
                        @error('upload_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="student_id">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->first_name }}
                                            {{ $student->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('student_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
        </div>
    </div>
@endsection
