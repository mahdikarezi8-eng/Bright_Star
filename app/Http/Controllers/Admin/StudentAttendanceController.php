<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    public function student_attendance_list(Request $request)
    {
          $month = $request->month ?? date('m');
          $year  = $request->year ?? date('Y');
          $students = Student::with(['student_attendances' => function ($query) use ($month, $year) {
            $query->whereMonth('absent_date', $month)
                ->whereYear('absent_date', $year);
        }])->get();
        return view('Admin.students.student_attendance.student_attendance_list',compact('students'));
    }




    public function student_attendance_add(){
        $students = Student::all();
        return view('Admin.students.student_attendance.student_attendance_add',compact('students'));

    }

    public function student_attendance_save(Request $request){

      
        $request->validate([
                'student_id'         =>['required','integer'],
                'absent_date'    =>['required','date'],
                'absent_type'        =>['nullable','string'],
        ]);

        $student_attendance = new StudentAttendance();
        $student_attendance->student_id = $request->student_id;
        $student_attendance->absent_date = $request->absent_date;
        $student_attendance->absent_type = $request->absent_type;
        $student_attendance->save();
        return redirect()->route('student_attendance_list')->with('success','Student Attendance Inserted Successfully');   
    }


    public function student_attendance_detail($id,$year,$month){
        $student_attendances = StudentAttendance::where('student_id', $id)
        ->whereYear('absent_date',$year)
        ->whereMonth('absent_date',$month)
        ->get();
        return view('Admin.students.student_attendance.student_attendance_detail',compact('student_attendances'));
    }

    public function student_attendance_delete($id,$year,$month){
        StudentAttendance::where('student_id', $id)
        ->whereYear('absent_date',$year)
        ->whereMonth('absent_date',$month)
        ->delete();
        return redirect()->route('student_attendance_list')->with('success','Student Attendance Deleted Successfully');

    }
   

    


}


