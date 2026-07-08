<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    public function teacher_attendance_add()
    {
        $user = auth()->user();
        if ($user && $user->role === 'teacher') {
            $teacher = $user->Teacher;
            $teachers = $teacher ? collect([$teacher]) : collect();
        } else {
            $teachers = Teacher::all();
        }
        return view('Admin.teachers.teacher_attendance.teacher_attendance_add', compact('teachers'));
    }

    public function teacher_attendance_list(Request $request)
    {
             $Month = $request->month ?? date('m');
             $Year  = $request->year ?? date('Y');

             $user = auth()->user();
             if ($user && $user->role === 'teacher') {
                 $teacher = $user->Teacher;
                 if ($teacher) {
                     $teachers = Teacher::where('id', $teacher->id)
                         ->with(['teacher_attendances' => function ($query) use ($Month, $Year) {
                            $query->whereMonth('absent_date', $Month)
                                ->whereYear('absent_date', $Year);
                        }])->get();
                 } else {
                     $teachers = collect();
                 }
             } else {
                 $teachers = Teacher::with(['teacher_attendances' => function ($query) use ($Month, $Year) {
                    $query->whereMonth('absent_date', $Month)
                        ->whereYear('absent_date', $Year);
                }])->get();
             }
        return view('Admin.teachers.teacher_attendance.teacher_attendance_list',compact('teachers'));
    }



    public function teacher_attendance_save(Request $request)
    {
        $request->validate([
            'teacher_id' => ['required', 'integer'],
            'absent_date' => ['required', 'date'],
            'remark' => ['nullable', 'string'],
        ]);
    
        $teacher_attendace = new TeacherAttendance;
        $teacher_attendace->teacher_id = $request->teacher_id;
        $teacher_attendace->absent_date = $request->absent_date;
        $teacher_attendace->remark = $request->remark;
        $teacher_attendace->save();
        return redirect()->route('teacher_attendance_list')->with('success', 'Teacher Attendance Added Successfully!');

    }


        public function teacher_attendance_detail($id , $year, $month)
        {
            $attendances = TeacherAttendance::where('teacher_id',$id)
                            ->whereYear('absent_date',$year)
                            ->whereMonth('absent_date',$month)
                            ->get();       

        return view('Admin.teachers.teacher_attendance.teacher_attendance_detail', compact('attendances'));
        }




    public function teacher_attendance_edite(Request $request,$id,$year,$month,$day){
        $teachers = Teacher::all();
        $attendance  = TeacherAttendance::where('teacher_id', $id)
            ->where('absent_year', $year)
            ->where('absent_month', $month)
            ->where('absent_day', $day)
            ->first();
        return view('Admin.teachers.teacher_attendance.teacher_attendance_edite', compact('teachers','attendance'));
    }


    public function teacher_attendance_delete($id){
        $attendance = TeacherAttendance::findOrFail($id);
        $attendance->delete();
         return redirect()->route('teacher_attendance_list')->with('success','Teacher Attendance Deleted Successfully');
 
        
    }

    
}
