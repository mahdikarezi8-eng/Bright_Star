@extends('Admin.master')
@section('content')
    <div class="content-wrapper mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title d-inline">Employee Salary list</h4>
                @php
                    $month = request('month', date('n'));
                    $year = request('year', date('Y'));
                @endphp
                <form method="GET" action="{{ route('employee_salary_payment') }}" class="mt-5">
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
                <div class="table-responsive mt-3">
                    <hr>
                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Position</th>
                                <th>Gross Salary</th>
                                <th>Pyable Salay</th>
                                <th>Pay Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="py-3 px-2">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                    <td class="py-3 px-2">{{ $employee->position }}</td>
                                    <td class="py-3 px-2">{{ $employee->gross_salary }} AFG</td>

                                    <td class="py-3 px-2">
                                        @if ($employee->employee_salary->first() && $employee->employee_salary->first()->net_salary)
                                            {{ $employee->employee_salary->first()->net_salary }}
                                            AFG
                                        @else
                                            <span class="text-danger hover-underline">
                                                Not Calculated
                                            </span>
                                        @endif
                                    </td>
                                    @php
                                        $salary = $employee->employee_salary->first();
                                    @endphp
                                    <td class="py-2 px-2">



                                        @if (!empty($salary->pay_date))
                                            <span class="text-success">Paided Before</span>
                                        @elseif (!empty($salary->net_salary) && is_null($salary->pay_date))
                                            <a href="{{ route('employee_salary_pay', ['id' => $employee->id, 'year' => $year, 'month' => $month]) }}"
                                                class="text-primary hover-underline">
                                                Payable
                                            </a>
                                        @else
                                            <span class="text-danger hover-underline">NOn-Payable</span>
                                        @endif


                                        {{-- @if ($salary && ($salary->pay_date !== null || $salary->net_salary !== null))
                                            <a href="{{ route('employee_salary_pay', ['id' => $employee->id, 'year' => $year, 'month' => $month]) }}"
                                                class="text-success hover-underline">Payable</a>
                                        @elseif(!empty($salary->pay_date))
                                            <span class="text-danger hover-underline">پرداخت شده قبلا</span>
                                        @else
                                            <span class="text-danger hover-underline">Non-Payable</span>
                                        @endif --}}






                                        {{-- @if ($employee->employee_salary->first() && $employee->employee_salary->first()->pay_date)
                                            <span class="text-success hover-underline">
                                                Paided
                                            </span>
                                        @else
                                            <a href="" class="text-primary hover-underline">
                                                NO Paided
                                            </a>
                                        @endif --}}
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
