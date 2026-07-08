@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title mb-2 mb-md-0">
                        Income Source List
                    </h4>
                    <div class="d-flex gap-2 flex-wrap">

                        <a href="{{ route('income_list') }}" class="btn btn-info btn-sm fw-bold">
                            <i class="fa fa-solid fa-arrow-left"></i>
                            Back
                        </a>
                        <a href="{{ route('income_source_add') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-solid fa-eye"></i>
                            Add Source
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    Id
                                </th>
                                <th class="text-center">
                                    Source Name
                                </th>
                                <th class="text-center">
                                    Update
                                </th>
                                <th class="text-center">
                                    Delete
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($income_sources as $income_source)
                                <tr>
                                    <td class="py-3 px-3 text-center"">{{ $income_source->id }}</td>
                                    <td class="py-3 px-3 text-center"">
                                        {{ $income_source->source_name }}
                                    <td class="py-3 px-3 text-center">
                                        <a href="{{ route('income_source_edit', $income_source->id) }}"
                                            class="btn btn-success  btn-sm"><i class="fa  fa-solid fa-edit "></i></a>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <a href="{{ route('income_source_delete', $income_source->id) }}"
                                            class="btn btn-danger btn-sm delete"><i class="fa  fa-solid fa-trash "></i></a>
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
