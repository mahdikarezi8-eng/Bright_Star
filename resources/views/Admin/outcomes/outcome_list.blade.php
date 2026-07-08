@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title mb-2 mb-md-0">
                        outcome List
                    </h4>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('outcome_source_list') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-solid fa-eye"></i>
                            Outcome Source
                        </a>
                        <a href="{{ route('outcome_add') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>
                            Outcome Add
                        </a>
                    </div>
                </div>
                @php
                    $month = request('month', date('n'));
                    $year = request('year', date('Y'));
                @endphp
                <form method="GET" action="{{ route('outcome_list') }}" class="mt-3">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select name="month" class="form-select border-gray mt-2">
                                <option disabled selected>Select Month</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="year" class="form-select border-gray mt-2">
                                <option disabled selected>Select Year</option>
                                @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-sm btn-primary mt-2">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead class="text-muted">
                            <tr>
                                <th class="text-center">
                                    Id
                                </th>
                                <th class="text-center">
                                    outcome Name
                                </th>

                                <th class="text-center">
                                    outcome Amount
                                </th>
                                <th class="text-center">
                                    outcome Date
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
                            @foreach ($outcomes as $outcome)
                                <tr>
                                    <td class="py-3 px-3 text-center"">{{ $outcome->id }}</td>
                                    <td class="py-3 px-3 text-center"">
                                        {{ $outcome->outcome_source->source_name }}</td>
                                    <td class="py-3 px-3 text-center">
                                        {{ $outcome->outcome_amount }}
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        {{ $outcome->outcome_date }}
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <a href="{{ route('outcome_edit', $outcome->id) }}"
                                            class="btn btn-success btn-sm"><i class="fa  fa-solid fa-edit "></i></a>
                                    </td>

                                    <td class="py-2 px-2 text-center">
                                        <a href="{{ route('outcome_delete', $outcome->id) }}"
                                            class="btn btn-danger  btn-sm delete"><i class="fa  fa-solid fa-trash "></i></a>
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
