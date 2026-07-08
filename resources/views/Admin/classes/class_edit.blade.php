@extends('Admin.master')

@section('content')
    <div class="container-fluid mt-3">

        <div class="card shadow-sm">
            <div class="card-body">

                <h4 class="card-title mb-4">Add New Class</h4>

                <form action="{{ route('class_update', $class->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        {{-- Name --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Calss Name</label>
                            <input type="text" value="{{ $class->class_name }}" class="form-control" name="class_name"
                                value="{{ old('class_name'), }}">
                            @error('class_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- feess --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Fees</label>
                            <input type="text" value="{{ $class->fees }}" class="form-control"  name="fees" value="{{ old('fees') }}">
                            @error('fees')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Image</label>
                            <input type="file" value="{{ $class->image }}" class="form-control" name="image">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Capacity --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label">Capacity</label>
                            <input type="number" value="{{ $class->capacity }}" class="form-control" name="capacity">
                            @error('capacity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="5">{{ old('description') }}{{ $class->description }}</textarea>
                            @error('description')
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
