@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-inline">Employee Salary Payment</h4>
                @php
                    $month = request('month', date('n'));
                    $year = request('year', date('Y'));
                @endphp
                <form method="GET" action="{{ route('teacher_salary_payment') }}" class="mt-5">
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
                <div class="table-responsive mt-5">
                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Employee Name</th>
                                <th class="text-center">Gross Salary</th>
                                <th class="text-center">Pyable Salay</th>
                                <th class="text-center">Pay Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td class="py-3 px-2 text-center">{{ $teacher->first_name }} {{ $teacher->last_name }}
                                    </td>
                                    <td class="py-3 px-2 text-center">{{ $teacher->gross_salary }} AFG</td>
                                    <td class="py-3 px-2 text-center">
                                        @if ($teacher->teacher_salaries->first() && $teacher->teacher_salaries->first()->net_salary)
                                            {{ $teacher->teacher_salaries->first()->net_salary }}
                                            AFG
                                        @else
                                            <span class="text-danger hover-underline">
                                                Not Calculated
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-2 text-center">
                                        @php
                                            $salary = $teacher->teacher_salaries->first();
                                        @endphp

                                        @if (!empty($salary->pay_date))
                                            <span class="text-success hover-underline">Paided Before</span>
                                        @elseif(!empty($salary->net_salary) && is_null($salary->pay_date))
                                            <a href="{{ route('teacher_salary_pay', [$teacher->id, 'year' => $year, 'month' => $month]) }}"
                                                class="text-success hover-underline">
                                                Payable
                                            </a>
                                        @else
                                            <span class="text-danger hover-underline">Non-Payable</span>
                                        @endif
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
