<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use App\Models\TeacherSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TeacherSalaryController extends Controller
{
    public function teacher_salary_list(){
        $year = request('year',date('Y'));
        $month = request('month',date('m'));
        $user = auth()->user();
        if ($user && $user->role === 'teacher') {
            $teacher = $user->Teacher;
            if ($teacher) {
                $teachers = Teacher::where('id', $teacher->id)
                    ->with(['teacher_salaries' => function ($query) use($year,$month) {
                        $query->where('salary_year', $year)
                            ->where('salary_month',$month);
                    }])->get();
            } else {
                $teachers = collect();
            }
        } else {
            $teachers = Teacher::with(['teacher_salaries' => function ($query) use($year,$month) {
                $query->where('salary_year', $year)
                    ->where('salary_month',$month);
            }])->get();
        }

        return view('Admin.teachers.teacher_salary.teacher_salary_list',compact('teachers'));
    }

    public function teacher_salary_count(Request $request,$id){
        
        $teacher =Teacher::findOrFail($id);
        $month = $request->month ?? date('n');
        $year  = $request->year ?? date('Y');


        $absent_days = TeacherAttendance::where('teacher_id', $id)
            ->whereYear('absent_date', $year)
            ->whereMonth('absent_date', $month)
            ->count();


        $days_in_month = Carbon::create($year, $month)->daysInMonth;

        $daily_salary = $teacher->gross_salary / $days_in_month;

        $absent_amount = round($daily_salary * $absent_days);
    
        $net_salary = round($teacher->gross_salary - $absent_amount , 0);

        return view('Admin.teachers.teacher_salary.teacher_salary_count',compact('teacher','absent_days','absent_amount','net_salary'));

     
    }


    public function teacher_salary_save(Request $request,$id){
   

    $request->validate([
        'salary_year' => ['required', 'integer', 'min:2000', 'max:2100'],
        'salary_month' => ['required', 'integer', 'between:1,12'],
        'absent_amount' => ['nullable', 'integer', 'min:0'],
        'bonus' => ['nullable', 'integer', 'min:0'],
        'net_salary' => ['required', 'integer', 'min:0'],
        'pay_date' => ['nullable', 'date'],
    ]);

    $teacher_salary  = new TeacherSalary();
    $teacher_salary->teacher_id = $id;
    $teacher_salary->salary_year = $request->salary_year;
    $teacher_salary->salary_month = $request->salary_month; 
    $teacher_salary->absent_amount = $request->absent_amount;
    $teacher_salary->bonus = $request->bonus;
    $teacher_salary->net_salary = $request->net_salary;
    $teacher_salary->pay_date = $request->pay_date;
    $teacher_salary->save();
    return redirect()->route('teacher_salary_list')->with('success','Teacher Salary Counted Successfully');

    
    }

    public function teacher_salary_delete($id,$year,$month){
        TeacherSalary::where('teacher_id', $id)
            ->where('salary_year', $year)
            ->where('salary_month', $month)
            ->delete();
        return redirect()->route('teacher_salary_list')->with('success','Teacher Salary Deleted Successfully');
    }




    //teacher Salary payment

        public function teacher_salary_payment(Request $request){

             $year  = $request->year ?? date('Y');
              $month = $request->month ?? date('m');
              $user = auth()->user();
              if ($user && $user->role === 'teacher') {
                  $teacher = $user->Teacher;
                  if ($teacher) {
                      $teachers = Teacher::where('id', $teacher->id)
                          ->with(['teacher_salaries' => function ($query) use ($year, $month) {
                            $query->where('salary_year', $year)
                            ->where('salary_month', $month);
                          }])->get();
                  } else {
                      $teachers = collect();
                  }
              } else {
                  $teachers = Teacher::with(['teacher_salaries' => function ($query) use ($year, $month) {
                    $query->where('salary_year', $year)
                    ->where('salary_month', $month);
                  }])->get();
              }

            return view('Admin.teachers.teacher_salary.teacher_salary_payment',compact('teachers'));
        }


        public function teacher_salary_pay( $id, $year, $month){
    
            TeacherSalary::where('teacher_id', $id)
            ->where('salary_year', $year)
            ->where('salary_month', $month)
            ->update([
                'pay_date'=>date('Y-m-d')
            ]);
            
           return redirect()->route('teacher_salary_payment',['id'=>$id,'year'=>$year,'month'=>$month])->with('success','Teacher Salary Paid Successfully');
    
    
        }

}
