@extends('Admin.master')
@section('content')
    <div class="card mt-3 ml-3 mr-3">
        <div class="card-body">
            <h4 class="card-title">Add New subject to <span>{{ $class->class_name }}</span> class</h4>
            <form class="form-sample" action="{{ route('assign_subject_to_class_save') }}" method="post">
                @csrf
                <p class="card-description text-success">
                    Personal info
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <input type="hidden" name="class_id" value="{{ $class->id }}">
                            <label class="col-sm-2 col-form-label">Subjects</label>
                            <div class="col-sm-9">
                                <select class="form-control" multiple name="subject_id[]">
                                    @foreach ($subjects as $subject)
                                        <option class="p-1 text-dark" value="{{ $subject->id }}"
                                            @if ($class->subjects->pluck('id')->contains($subject->id)) selected @endif>
                                            {{ $subject->subject_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('subject_id')
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
