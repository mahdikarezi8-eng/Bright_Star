@extends('Admin.master')
@section('content')
    <div class="card mt-3 mr-3 ml-3">
        <div class="card-body">
            <h4 class="card-title">Add New Subject</h4>
            <form class="form-sample" action="{{ route('subject_save') }}" method="post">
                @csrf
                <p class="card-description text-success">
                    Personal info
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Subject Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="subject_name">
                            </div>
                        </div>
                    </div>
                    @error('subject_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Authore</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="authore">
                                </div>
                            </div>
                            @error('class_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
            </form>
        </div>
    </div>
@endsection
