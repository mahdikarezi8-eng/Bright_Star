@extends('Admin.master')
@section('content')
    <div class='card mt-3 mr-3 ml-3'>
        <div class="card-body">
            <h4 class="card-title">Add Income</h4>
            <form class="form-sample mt-3" action="{{ route('income_save') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Income Source</label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" name="source_id">
                                    <option selected disabled>Select Source</option>
                                    @foreach ($sources as $source)
                                        <option value="{{ $source->id }}">
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
                            <label class="col-sm-3 col-form-label">Income Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="income_amount">
                            </div>
                            @error('income_amount')
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
                                <input type="date" class="form-control" name="income_date">
                            </div>
                            @error('income_date')
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
