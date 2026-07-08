<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    

public function emp_attendance_list(Request $request)
{
        $currentMonth = $request->month ?? date('m');
        $currentYear  = $request->year ?? date('Y');
        $employees = Employee::with(['employee_attendances' => function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('attendance_date', $currentMonth)
                ->whereYear('attendance_date', $currentYear);
        }])->get();
        return view('Admin.employees.employee_attendance.emp_attendance_list',compact('employees'));
}

// Add Infromation in Employee Attendacne table.
public function emp_attendance_add()
{
    $employees = Employee::all();
    return view('Admin.employees.employee_attendance.emp_attendance_add',compact('employees'));

}
// save data in the employee attendance table
public function emp_attendance_save (Request $request){
        $request ->validate([
            'employee_id' => ['required', 'integer'],
            'attendance_date' => ['required', 'date'],
            'remark' => ['nullable', 'string'],
        ]);

        $emp_attendance = new EmployeeAttendance();
        $emp_attendance->employee_id = $request->employee_id;
        $emp_attendance->attendance_date = $request->attendance_date;
        $emp_attendance->remark = $request->remark;
        $emp_attendance->save();
        return redirect()->route('emp_attendance_list')->with('success','Employee Attendance Added Successfully');
       
}


public function emp_attendance_detail($id,$year,$month){
    $attendances = EmployeeAttendance::where('employee_id', $id)->whereYear('attendance_date', $year)->whereMonth('attendance_date', $month)->get();
    return view('Admin.employees.employee_attendance.emp_attendance_detail',compact('attendances'));
}

public function emp_attendance_delete($id){
    $emp_attendance = EmployeeAttendance::findOrFail($id);
    $emp_attendance->delete();
    return redirect()->route('emp_attendance_list',$id)->with('success','Employee Attendance Deleted Successfully');
}







}