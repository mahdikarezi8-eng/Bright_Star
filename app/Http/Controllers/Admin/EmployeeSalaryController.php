<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeSalary;
use Carbon\Carbon;

class EmployeeSalaryController extends Controller
{
    public function employee_salary_list(Request $request)
    {
        $year  = $request->year ?? date('Y');
        $month = $request->month ?? date('m');
        $employees = Employee::select(
            'employees.id',
            'employees.first_name',
            'employees.last_name',
            'employees.position',
            'employees.gross_salary'
        )
            ->selectSub(function ($query) use ($year, $month) {
                $query->from('employee_salary')
                    ->select('net_salary')
                    ->whereColumn('employee_salary.employee_id', 'employees.id')
                    ->where('employee_salary.salary_year', $year)
                    ->where('employee_salary.salary_month', $month)
                    ->latest()
                    ->limit(1);
            }, 'net_salary')
            ->get();
        return view('Admin.employees.employee_salary.employee_salary_list', compact('employees'));
    }

    public function employee_salary_count(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $month = $request->month ?? date('n');
        $year  = $request->year ?? date('Y');

        $absent_days = EmployeeAttendance::where('employee_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->count();

        $days_in_month = Carbon::create($year, $month)->daysInMonth;
        $daily_salary = $employee->gross_salary / $days_in_month;
        $absent_amount = round($daily_salary * $absent_days);
        $net_salary = round($employee->gross_salary - $absent_amount, 0);
        return view('Admin.employees.employee_salary.employee_salary_count', compact('employee', 'absent_days', 'absent_amount', 'net_salary'));
    }



    public function employee_salary_save(Request $request, $id)
    {

        $request->validate([
            'salary_year' => ['required', 'integer', 'min:2000', 'max:2100'],
            'salary_month' => ['required', 'integer', 'min:1', 'max:12'],
            'absent_amount' => ['required', 'numeric', 'min:0'],
            'pay_date'      => ['nullable', 'date'],
            'net_salary'    => ['required', 'numeric', 'min:0'],
        ]);

        $employee_salary  = new EmployeeSalary();
        $employee_salary->employee_id = $id;
        $employee_salary->salary_year = $request->salary_year;
        $employee_salary->salary_month = $request->salary_month;
        $employee_salary->absent_amount = $request->absent_amount;
        $employee_salary->pay_date = $request->pay_date;
        $employee_salary->net_salary = $request->net_salary;
        $employee_salary->save();
        return redirect()->route('employee_salary_list')->with('success', 'Employee Salary Counted Successfully');
    }

    public function employee_salary_delete($id, $year, $month)
    {
        EmployeeSalary::where('employee_id', $id)
            ->where('salary_year', $year)
            ->where('salary_month', $month)
            ->delete();
        return redirect()->route('employee_salary_list')->with('success', 'Employee Salary Deleted Successfully');
    }
    // Employee salary payment
    public function employee_salary_payment(Request $request)
    {
        $year  = $request->year ?? date('Y');
        $month = $request->month ?? date('m');
        $employees = Employee::with(['employee_salary' => function ($query) use ($year, $month) {
            $query->where('salary_year', $year)
                ->where('salary_month', $month);
        }])->get();

        // return $employees;

        return view('Admin.employees.employee_salary.employee_salary_payment', compact('employees'));
    }


    public function employee_salary_pay($id, $year, $month)
    {

        EmployeeSalary::where('employee_id', $id)
            ->where('salary_year', $year)
            ->where('salary_month', $month)
            ->update([
                'pay_date' => date('Y-m-d')
            ]);

        return redirect()->route('employee_salary_payment', ['id' => $id, 'year' => $year, 'month' => $month])->with('success', 'Employee Salary Paid Successfully');
    }
}
