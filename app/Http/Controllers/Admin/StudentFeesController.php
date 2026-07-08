<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentFees;
use Illuminate\Http\Request;

class StudentFeesController extends Controller
{
    public function student_fees_list(){
        $fees= StudentFees::all();
        return view('Admin.students.student_fees.student_fees_list',compact('fees'));
    }
        
    

    public function student_fees_add(){
        $students= Student::all();
        return view('Admin.students.student_fees.student_fees_add',compact('students'));
    }    


        public function studentInfo($id)
        {
            $student = Student::with('class')->find($id);

            if (!$student) {
                return response()->json([
                    'fee' => 0,
                    'class_name' => ''
                ]);
            }

            return response()->json([
                'fee' => $student->class->fees ?? 0,
                'class_name' => $student->class->class_name ?? ''
            ]);
        }







    public function student_fees_save(Request $request){
            $request->validate([
            'student_id'   => 'required|exists:students,id',
            'fees_year'    => 'required|integer|min:2000|max:2100',
            'fees_month'   => 'required|integer|min:1|max:12',
            'fees_amount'  => 'required|numeric|min:0',
            'fees_date'    => 'required|date',
        ]);
        
        $fees = new StudentFees();
        $fees->student_id = $request->student_id;
        $fees->fees_year = $request->fees_year;
        $fees->fees_month = $request->fees_month;
        $fees->fees_amount = $request->fees_amount;
        $fees->fees_date = $request->fees_date;
        $fees->save();
        return redirect()->route('student_fees_list')->with('success', 'Fees added successfully');
    }


    public function student_fees_delete($id,$year,$month){
        StudentFees::where('student_id', $id)->where('fees_year', $year)->where('fees_month', $month)->delete();    
        return redirect()->route('student_fees_list')->with('success','Fees Deleted Successfully');
    }


   

}
