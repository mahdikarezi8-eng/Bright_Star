@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title ">About List</h4>
                    <a href="{{ route('about_add') }}" class ="btn btn-primary btn-sm">Add About</a>
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
                                    Title
                                </th>
                                <th>Description</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abouts as $about)
                                <tr>
                                    <td class="py-2 px-2">
                                        <img src="images/about/{{ $about->image }}" alt="image">
                                    </td>

                                    <td class="py-2 px-2">{{ $about->title }}</td>
                                    {{-- <td class="py-2 px-2">{{ $about->description }}</td> --}}
                                    <td class="py-2 px-2">
                                        <div class="description-box" style="cursor: pointer" data-bs-toggle="tooltip"
                                            title="{{ $about->description }}">
                                            {{ $about->description }}
                                        </div>
                                    </td>
                                    <td class="py-2 px-2">
                                        <button class="btn btn-success btn-sm">
                                            <a class="text-light" href="{{ route('about_edit', $about->id) }}"><span
                                                    class="fa-solid fa-pen-to-square"></span></a>
                                        </button>
                                    </td>
                                    <td class="py-2 px-2">
                                        <a href="{{ route('about_delete', $about->id) }}"
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
