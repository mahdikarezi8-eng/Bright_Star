@extends('Admin.master')
@section('content')
    <div class='card mt-3 mr-3 ml-3'>
        <div class="card-body">
            <h4 class="card-title">Edit Income Source</h4>
            <form class="form-sample" action="{{ route('income_source_update', $income_source->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Source Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $income_source->source_name }}" class="form-control"
                                    name="source_name">
                            </div>
                        </div>
                    </div>
                    @error('source_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
            </form>
        </div>
    </div>
@endsection
