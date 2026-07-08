<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    
   public function subject_list(){
      $user = auth()->user();
      if ($user && $user->role === 'teacher') {
          $teacher = $user->Teacher;
          $subjects = $teacher ? ($teacher->subjects ?? collect()) : collect();
      } else {
          $subjects = Subject::all();
      }
      return view('Admin.subjects.subject_list' ,compact('subjects'));
   }

   public function subject_add(){
      return view('Admin.subjects.subject_add');
   }

   public function subject_save(Request $request)
   {
     $data = $request->validate([
         'subject_name' => ['required', 'string', 'max:255'],
         'authore' => ['nullable', 'string', 'max:255'],
    ]);

    $subject = Subject::create($data);
    return redirect()->route('subject_list');
   }


   public function subject_edit($id){
      $subject = Subject::find($id);
      return view('admin.subjects.subject_edit',compact('subject'));
   }


   public function subject_update(Request $request,$id){
      $subject = Subject::find($id);
       $data = $request->validate([
         'subject_name' => ['required', 'string', 'max:255'],
         'authore' => ['nullable', 'string', 'max:255'],
    ]);

    $subject->update($data);
    return redirect()->route('subject_list');
   }

   public function subject_delete($id){
      $subject = Subject::find($id);
      $subject->delete();

      return redirect()->route('subject_list');
   }


   public function subject_detail($id){
      $subject = Subject::with('teachers','students')->findOrFail($id);
      return view('Admin.subjects.subject_detail',compact('subject'));  
      }

   public function add_teacher_to_subject($id){
      $subject = Subject::findOrFail($id);
      $teachers = \App\Models\Teacher::all();
      return view('Admin.subjects.add_teacher_to_subject',compact('subject','teachers'));  
   }

   // public function save_teacher_to_subject(Request $request, $id){
   //    $subject = Subject::findOrFail($id);
   //    $subject->teachers()->attach($request->teacher_id);
   //    return redirect()->route('subject_detail', $id)->with('success', 'Teacher added to subject successfully.');
   // }
   public function save_teacher_to_subject(Request $request, $id)
{
    $request->validate([
        'teacher_ids' => 'required|array',
        'teacher_ids.*' => 'exists:teachers,id',
    ]);

    $subject = Subject::findOrFail($id);

    $subject->teachers()->syncWithoutDetaching(
        $request->teacher_ids
    );

    return redirect()
        ->route('subject_detail', $id)
        ->with('success', 'Teachers assigned successfully.');
}

   public function add_student_to_subject($id){
      $subject = Subject::findOrFail($id);
      $students = \App\Models\Student::all();
      return view('Admin.subjects.add_student_to_subject',compact('subject','students'));  
   }

   // public function save_student_to_subject(Request $request, $id){
   //    $subject = Subject::findOrFail($id);
   //    $subject->students()->attach($request->student_id);
   //    return redirect()->route('subject_detail', $id)->with('success', 'Student added to subject successfully.');
   // }


   public function save_student_to_subject(Request $request, $id)
{
    $request->validate([
        'student_ids' => 'required|array',
        'student_ids.*' => 'exists:students,id',
    ]);

    $subject = Subject::findOrFail($id);

    $subject->students()->syncWithoutDetaching(
        $request->student_ids
    );

    return redirect()
        ->route('subject_detail', $id)
        ->with('success', 'Students assigned successfully.');
}




public function subject_teacher_delete($subject_id, $teacher_id)
{
    $subject = Subject::findOrFail($subject_id);

    $subject->teachers()->detach($teacher_id);
    return redirect()
        ->back()
        ->with('success', 'Teacher removed from subject successfully.');
}
public function subject_student_delete($subject_id, $student_id)
{
    $subject = Subject::findOrFail($subject_id);

    $subject->students()->detach($student_id);

    return redirect()
        ->back()
        ->with('success', 'Student removed from subject successfully.');
}


}
