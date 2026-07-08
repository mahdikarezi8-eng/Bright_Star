@extends('Admin.master')
@section('content')
    <div class='card mt-3 mr-3 ml-3'>
        <div class="card-body">
            <h4 class="card-title">Edite Outcome</h4>
            <form class="form-sample mt-3" action="{{ route('outcome_update', $outcome->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Outcome Source</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="source_id">
                                    <option selected disabled>Select Source</option>
                                    @foreach ($sources as $source)
                                        <option value="{{ $source->id }}"
                                            {{ $outcome->source_id == $source->id ? 'selected' : '' }}>
                                            {{ $source->source_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('source_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Outcome Amount</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $outcome->outcome_amount }}" class="form-control"
                                    name="outcome_amount">
                            </div>
                            @error('outcome_amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                                <input value="{{ $outcome->outcome_date }}" type="date" class="form-control"
                                    name="outcome_date">
                            </div>
                            @error('outcome_date')
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
