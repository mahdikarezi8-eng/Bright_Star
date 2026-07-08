<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Classes;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function score_add(){
        $user = auth()->user();
        if ($user && $user->role === 'teacher') {
            $teacher = $user->Teacher;
            $students = [];
            $subjects = $teacher ? ($teacher->subjects ?? collect()) : collect();
            $classes = [];
            if ($teacher) {
                foreach ($subjects as $subject) {
                    $subjectClasses = $subject->classes ?? collect();
                    foreach ($subjectClasses as $class) {
                        if (!in_array($class, $classes)) {
                            $classes[] = $class;
                        }
                        $classStudents = $class->students ?? collect();
                        foreach ($classStudents as $student) {
                            if (!in_array($student, $students)) {
                                $students[] = $student;
                            }
                        }
                    }
                }
                $classes = collect($classes);
                $students = collect($students);
            }
        } else {
            $students = Student::all();
            $subjects = Subject::all();
            $classes = Classe::all();
        }
        return view('Admin.scores.score_add',compact('students','subjects','classes'));
    }

    public function score_save(Request $request){
            $request->validate([
                'student_id' => ['required', 'integer', 'exists:students,id'],
                'subject_id' => ['required', 'integer', 'exists:subjects,id'],
                'exam_year' => ['required', 'integer'],
                'class_id' => ['required', 'integer', 'exists:classes,id'],
                'first_chance' => ['required', 'integer', 'min:0'],
                'second_chance' => ['nullable', 'integer', 'min:0' ],
             ]);

            $score =  new Score();
            $score->student_id = $request->student_id;
            $score->subject_id = $request->subject_id;
            $score->exam_year = $request->exam_year;
            $score->class_id = $request->class_id;
            $score->first_chance = $request->first_chance;
            $score->second_chance = $request->second_chance;
            $score->save();
            return redirect()->route('score_add')->with('success','Score Added Successfully');
        }
        public function score_list(){
            $user = auth()->user();
            if ($user && $user->role === 'teacher') {
                $teacher = $user->Teacher;
                $students = [];
                if ($teacher) {
                    $subjects = $teacher->subjects ?? collect();
                    foreach ($subjects as $subject) {
                        $subjectClasses = $subject->classes ?? collect();
                        foreach ($subjectClasses as $class) {
                            $classStudents = $class->students ?? collect();
                            foreach ($classStudents as $student) {
                                if (!in_array($student, $students)) {
                                    $students[] = $student;
                                }
                            }
                        }
                    }
                    $students = collect($students);
                }
                $studentIds = $students->pluck('id');
                $scores = Score::whereIn('student_id', $studentIds)->get();
            } else {
                $scores = Score::all();
            }
            return view('Admin.scores.score_list',compact('scores'));
            }

        public function score_edit($id){
            $user = auth()->user();
            if ($user && $user->role === 'teacher') {
                $teacher = $user->Teacher;
                $students = [];
                $subjects = $teacher ? ($teacher->subjects ?? collect()) : collect();
                $classes = [];
                if ($teacher) {
                    foreach ($subjects as $subject) {
                        $subjectClasses = $subject->classes ?? collect();
                        foreach ($subjectClasses as $class) {
                            if (!in_array($class, $classes)) {
                                $classes[] = $class;
                            }
                            $classStudents = $class->students ?? collect();
                            foreach ($classStudents as $student) {
                                if (!in_array($student, $students)) {
                                    $students[] = $student;
                                }
                            }
                        }
                    }
                    $classes = collect($classes);
                    $students = collect($students);
                }
            } else {
                $students = Student::all();
                $subjects = Subject::all();
                $classes = Classe::all();
            }
            $score = Score::find($id);
            return view('Admin.scores.score_edit',compact('score','students','subjects','classes'));
        }
        public function score_update(Request $request,$id){
            $request->validate([
                'student_id' => ['required', 'integer', 'exists:students,id'],
                'subject_id' => ['required', 'integer', 'exists:subjects,id'],
                'exam_year' => ['required', 'integer'],
                'class_id' => ['required', 'integer', 'exists:classes,id'],
                'first_chance' => ['required', 'integer', 'min:0'],
                'second_chance' => ['nullable', 'integer', 'min:0' ],
             ]);
            $score = Score::find($id);
            $score->student_id = $request->student_id;
            $score->subject_id = $request->subject_id;
            $score->exam_year = $request->exam_year;
            $score->class_id = $request->class_id;
            $score->first_chance = $request->first_chance;
            $score->second_chance = $request->second_chance;
            $score->save();
            return redirect()->route('score_list')->with('success','Score Updated Successfully');
        }

        public function score_delete($id){
            $score = Score::find($id);
            $score->delete();
            return redirect()->route('score_list')->with('success','Score Deleted Successfully');
        }
        
}