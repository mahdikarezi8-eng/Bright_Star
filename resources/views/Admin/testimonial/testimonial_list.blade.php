@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title ">Testimonial List</h4>
                    <a href="{{ route('testimonial_add') }}" class ="btn btn-primary btn-sm">Add Testimonial</a>
                </div>

                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>Position</th>
                                <th>Message</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <td class="py-2 px-2">
                                        <img src="images/testimonial/{{ $testimonial->image }}" alt="image">
                                    </td>

                                    <td class="py-2 px-2">{{ $testimonial->name }}</td>
                                    <td class="py-2 px-2">{{ $testimonial->position }}</td>
                                    <td class="py-2 px-2">
                                        <div class="description-box" style="cursor: pointer" data-bs-toggle="tooltip"
                                            title="{{ $testimonial->message }}">
                                            {{ $testimonial->message }}
                                        </div>
                                    </td>

                                    <td class="py-2 px-2">
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light"
                                                href="{{ route('testimonial_edit', $testimonial->id) }}"><span
                                                    class="fa-solid fa-pen-to-square"></span></a>
                                        </button>
                                    </td>
                                    <td class="py-2 px-2">
                                        <a href="{{ route('testimonial_delete', $testimonial->id) }}"
                                            class="btn btn-danger btn-sm delete">
                                            <i class="fa-solid fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
