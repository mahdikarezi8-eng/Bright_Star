@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h4 class="card-title mb-2 mb-md-0">
                        Score List
                    </h4>

                </div>
                <div class="table-responsive">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    Student Name
                                </th>
                                <th class="text-center">
                                    Subject
                                </th>
                                <th class="text-center">
                                    First Chance
                                </th>
                                <th class="text-center">
                                    Second Chance
                                </th>
                                <th class="text-center">
                                    Result
                                </th>
                                <th class="text-center">
                                    Certificat
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
                            @foreach ($scores as $score)
                                <tr>
                                    <td class="py-2 px-2 text-center"">
                                        {{ $score->student->first_name }} {{ $score->student->last_name }}
                                    </td>
                                    <td class="py-2 px-2 text-center"">
                                        {{ $score->subject->subject_name }}
                                    </td>
                                    <td class="py-2 px-2 text-center"">
                                        {{ $score->first_chance }}
                                    </td>
                                    <td class="py-2 px-2 text-center"">
                                        {{ $score->second_chance }}
                                    </td>
                                    <td class="py-2 px-2 text-center"">
                                        @if ($score->first_chance >= 55)
                                            <span class="text-success">Success</span>
                                        @elseif ($score->second_chance >= 55)
                                            <span class="text-success hover-underline fs-6">Success</span>
                                        @else
                                            <span class="text-danger hover-underline fs-6">Failed</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <a href="{{ route('certificat_add', $score->student->id) }}"
                                            class="btn btn-info  btn-sm"><i class="fa-solid fa-certificate"></i></a>
                                    </td>
                                    <td class="py-2 px-2 text-center">

                                        <a href="{{ route('score_edit', $score->id) }}" class="btn btn-success  btn-sm"><i
                                                class="fa  fa-solid fa-edit "></i></a>
                                    </td>
                                    <td class="py-2 px-2 text-center">
                                        <a href="{{ route('score_delete', $score->id) }}"
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
