@extends('Admin.master')

@section('content')
    <div class="container-fluid mt-3">

        <div class="card shadow-sm">
            <div class="card-body">

                <h4 class="card-title mb-4">Add New Testimonila</h4>

                <form action="{{ route('testimonial_save') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        {{-- Name --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('class_name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Position --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Position</label>
                            <input type="text" class="form-control" name="position" value="{{ old('fees') }}">
                            @error('fees')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" rows="5">{{ old('description') }}</textarea>
                            @error('message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            Save
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
