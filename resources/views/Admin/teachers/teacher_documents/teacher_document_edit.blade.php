@extends('Admin.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">Edite Teacher Document</h4>
            <form class="form-sample" action="{{ route('teacher_document_update', $document->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Document Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $document->document_name }}" class="form-control"
                                    name="name">
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
                                    name="file">
                            </div>
                        </div>
                    </div>
                    @error('file')
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
                            <label class="col-sm-3 col-form-label">Teacher</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="teacher_id">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }}
                                            {{ $teacher->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('teacher_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
        </div>
    </div>
@endsection
