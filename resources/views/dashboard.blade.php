{{-- @extends('Admin.master')
@section('content')
    @include('Admin.layout.content')
@endsection --}}


@extends('Admin.master')

@section('content')
    @php

        use App\Models\Student;
        use App\Models\Teacher;
        use App\Models\Employee;
        use App\Models\StudentFees;
        use App\Models\Income;
        use App\Models\Outcome;
        use App\Models\TeacherSalary;
        use App\Models\EmployeeSalary;

        // Count Data
        $students = Student::count();
        $teachers = Teacher::count();
        $staffs = Employee::count();

        // Arrays
        $monthlyIncome = [];
        $monthlyExpense = [];

        // Current Year
        $year = date('Y');
        for ($i = 1; $i <= 12; $i++) {
            // student fees
            $studentFees = StudentFees::join('students', 'student_fees.student_id', '=', 'students.id')
                ->join('classes', 'students.class_id', '=', 'classes.id')
                ->whereMonth('student_fees.fees_date', $i)
                ->whereYear('student_fees.fees_date', $year)
                ->sum('classes.fees');
            // other income
            $otherIncome = Income::whereMonth('created_at', $i)->whereYear('created_at', $year)->sum('income_amount');
            // total income
            $monthlyIncome[] = $studentFees + $otherIncome;
            // teacher salary
            $teacherSalary = TeacherSalary::whereMonth('pay_date', $i)->whereYear('pay_date', $year)->sum('net_salary');
            // staff salary
            $staffSalary = EmployeeSalary::whereMonth('pay_date', $i)->whereYear('pay_date', $year)->sum('net_salary');
            // other expense
            $otherExpense = Outcome::whereMonth('created_at', $i)
                ->whereYear('created_at', $year)
                ->sum('outcome_amount');
            // total expense
            $monthlyExpense[] = $teacherSalary + $staffSalary + $otherExpense;
        }

        // Totals
        $totalIncome = array_sum($monthlyIncome);
        $totalExpense = array_sum($monthlyExpense);

    @endphp

    <style>
        .dashboard-card {
            background: #fafafa;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
            position: relative;
            overflow: hidden;
            height: 100px;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .dashboard-card .icon {
            width: 65px;
            height: 65px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .dashboard-card .content h6 {
            font-size: 1px;
            color: #777;
            margin-bottom: 8px;
        }

        .dashboard-card .content h3 {
            font-size: 30px;
            font-weight: 700;
            color: #111;
        }

        .purple {
            background: rgba(115, 103, 240, 0.15);
            color: #7367f0;
        }

        .success {
            background: rgba(40, 199, 111, 0.15);
            color: #28c76f;
        }

        .primary {
            background: rgba(0, 123, 255, 0.15);
            color: #007bff;
        }

        .orange {
            background: rgba(255, 159, 67, 0.15);
            color: #ff9f43;
        }

        .finance-card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
        }

        .finance-card:hover {
            transform: translateY(-4px);
        }

        .finance-card h5 {
            font-size: 17px;
            color: #666;
            margin-bottom: 15px;
        }

        .finance-card h2 {
            font-size: 35px;
            font-weight: 700;
        }

        .chart-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
        }

        .chart-card:hover {
            transform: translateY(-4px);
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #222;
        }

        .chart canvas {
            width: 100% !important;
            height: 380px !important;
        }

        .title h2 {
            font-size: 28px;
            font-weight: 700;
            color: #111;
        }

        @media(max-width:768px) {

            .dashboard-card,
            .finance-card,
            .chart-card {
                padding: 20px;
            }

            .dashboard-card .content h3 {
                font-size: 20px;
            }

            .finance-card h2 {
                font-size: 20px;
            }
        }
    </style>

    <section class="section">

        <div class="container-fluid">

            <!-- Title -->
            <div class="title-wrapper pt-30 mb-4" style="margin-top:-8px;">
                <div class="row align-items-center">

                    <div class="col-md-6">
                        <div class="title">
                            <h2>Dashboard</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Statistics -->
            <div class="row" style="margin-top:-34px;">
                <!-- Students -->
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="dashboard-card mb-30">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="d-flex align-items-center">

                                <div class="icon purple me-3">
                                    <i class="fa fa-users"></i>
                                </div>

                                <div class="content" style="margin-top:-20px;">
                                    <h5 style="font-size: 16px; font-weight:bold">All Students</h5>
                                    <h5 style="font-size: 10px; font-weight:bold" class="mb-0">
                                        {{ $students }} students
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Teachers -->
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="dashboard-card mb-30">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="d-flex align-items-center">

                                <div class="icon success me-3">
                                    <i class="fa fa-chalkboard-user"></i>
                                </div>

                                <div class="content" style="margin-top:-20px;">
                                    <h5 class="mb-1" style="font-size: 16px; font-weight:bold" class="mb-1">All Teachers
                                    </h5>
                                    <h5 style="font-size: 10px; font-weight:bold" class="mb-0">
                                        {{ $teachers }} teacher
                                    </h5>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Staff -->
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="dashboard-card mb-30">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="d-flex align-items-center">

                                <div class="icon primary me-3">
                                    <i class="fa fa-user"></i>
                                </div>

                                <div class="content" style="margin-top: -20px;">
                                    <h5 class="mb-1" style="font-size: 16px; font-weight:bold" class="mb-1">All
                                        Employees</h5>
                                    <h3 style="font-size: 10px; font-weight:bold" class="mb-0">
                                        {{ $staffs }} employees
                                    </h3>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Finance -->
            <div class="row">

                <!-- Income -->
                <div class="col-lg-6">
                    <div class="finance-card mb-30">

                        <h5 style="font-size: 18px; font-weight:bold">Total Income</h5>

                        <h3 style="font-size: 18px; font-weight:bold" class="text-success">
                            {{ number_format($totalIncome) }} AFG
                        </h3>

                    </div>
                </div>

                <!-- Expense -->
                <div class="col-lg-6">
                    <div class="finance-card mb-30">

                        <h5 style="font-size: 18px; font-weight:bold">Total Expense</h5>

                        <h2 style="font-size: 18px; font-weight:bold" class="text-danger">
                            {{ number_format($totalExpense) }} AFG
                        </h2>

                    </div>
                </div>

            </div>

            <!-- Charts -->
            <div class="row">

                <!-- Income Chart -->
                <div class="col-lg-6">

                    <div class="chart-card mb-30">

                        <h5 style="font-size: 14px; font-weight:bold" class="chart-title">
                            Monthly Income
                        </h5>

                        <div class="chart">
                            <canvas id="incomeChart"></canvas>
                        </div>

                    </div>

                </div>

                <!-- Expense Chart -->
                <div class="col-lg-6">

                    <div class="chart-card mb-30">

                        <h5 style="font-size: 14px; font-weight:bold" class="chart-title">
                            Monthly Expense
                        </h5>

                        <div class="chart">
                            <canvas id="expenseChart"></canvas>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        /*
                                                                        |--------------------------------------------------------------------------
                                                                        | Income Chart
                                                                        |--------------------------------------------------------------------------
                                                                        */

        const incomeCtx =
            document.getElementById('incomeChart');

        new Chart(incomeCtx, {

            type: 'line',

            data: {

                labels: [
                    'Jan', 'Feb', 'Mar', 'Apr',
                    'May', 'Jun', 'Jul', 'Aug',
                    'Sep', 'Oct', 'Nov', 'Dec'
                ],

                datasets: [{

                    label: 'Income',

                    data: @json($monthlyIncome),

                    borderWidth: 3,

                    tension: 0.4,

                    fill: true

                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }

        });

        /*
        |--------------------------------------------------------------------------
        | Expense Chart
        |--------------------------------------------------------------------------
        */

        const expenseCtx =
            document.getElementById('expenseChart');

        new Chart(expenseCtx, {

            type: 'bar',

            data: {

                labels: [
                    'Jan', 'Feb', 'Mar', 'Apr',
                    'May', 'Jun', 'Jul', 'Aug',
                    'Sep', 'Oct', 'Nov', 'Dec'
                ],

                datasets: [{

                    label: 'Expense',

                    data: @json($monthlyExpense),

                    borderWidth: 1

                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }

        });
    </script>
@endsection
