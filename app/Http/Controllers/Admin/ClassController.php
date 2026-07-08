<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class ClassController extends Controller
{
    public function class_add()
    {
        return view('admin.classes.class_add');
    }

    public function class_save(Request $request)
    {
     $request->validate([
    'class_name'   => ['required', 'string', 'max:255'],
    'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    'description'  => ['nullable', 'string'],
    'capacity'     => ['required', 'integer', 'min:1'],
    'fees'         => ['required', 'integer', 'min:0'],
   ]);
        $class = new Classe();
        $class->class_name = $request->class_name;
        $class->description = $request->description;
        $class->capacity = $request->capacity;
        $class->fees = $request->fees;
        $image = $request->image;
        $image_name = time() . "_" . $image->getClientOriginalName();
        $request->image->move('images/class/', $image_name);
        $class->image = $image_name;
        $class->save();
        return redirect()->route('class_list')->with('success','Class Inserted Succesfully!');
    }


    public function class_list()
    {
        $user = auth()->user();
        if ($user && $user->role === 'teacher') {
            $teacher = $user->Teacher;
            $classes = [];
            if ($teacher) {
                $subjects = $teacher->subjects ?? collect();
                foreach ($subjects as $subject) {
                    $subjectClasses = $subject->classes ?? collect();
                    foreach ($subjectClasses as $class) {
                        if (!in_array($class, $classes)) {
                            $classes[] = $class;
                        }
                    }
                }
                $classes = collect($classes);
            } else {
                $classes = collect();
            }
        } else {
            $classes = Classe::all();
        }
        return view('Admin.classes.class_list', compact('classes'));
    }

    public function class_edit($id)
    {
        $class = Classe::find($id);
        return view('Admin.classes.class_edit', compact('class'));
    }

    public function class_update(Request $request ,$id){
        $class = Classe::find($id);
        $request->validate([
                'class_name'   => ['required', 'string', 'max:255'],
                'description'  => ['nullable', 'string'],
                'capacity'     => ['required', 'integer', 'min:1'],
                'fees'         => ['required', 'integer', 'min:0'],
        ]); 
         if ($request->hasFile('image')) {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // delete old image
        if ($class->image && file_exists(public_path('images/class/' . $class->image))) {
            unlink(public_path('images/class/' . $class->image));
        }

        // upload new image
        $image = $request->file('image');
        $image_name = time() . "_" . $image->getClientOriginalName();
        $image->move(public_path('images/class'), $image_name);
        $class->image = $image_name;
    }
    $class->class_name = $request->class_name;
    $class->description = $request->description;
    $class->capacity = $request->capacity;
    $class->fees = $request->fees;
    $class->save();
    return redirect()->route('class_list')
        ->with('success', 'Class Updated Successfully!');
    }

    public function class_delete($id)
    {
         $class = Classe::findOrFail($id);

        $image_path = public_path('images/class/') . $class->image;

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $class->delete();
        return redirect()->route('class_list')->with('success', 'Class Deleted Successfully!');
    }

    //assign subject to classes
    public function assign_subject_to_class($id)
    {
        $class = Classe::find($id);
        $subjects = Subject::all();
        return view('Admin.classes.assign_subject', compact('class', 'subjects'));
    }

    public function assign_subject_to_class_save(Request $request)
    {

        $data = $request->validate([
            'class_id' => 'required|integer',
            'subject_id' => 'required|array',
            'subject_id.*' => ['numeric'],
        ]);

        $class = Classe::findOrFail($data['class_id']);
        $class->subjects()->sync($data['subject_id']);
        return redirect()->route('class_list');
    }


    //class student list
    public function class_student_list($id)
    {

        $class = Classe::with('students')->findOrFail($id);
        return view('Admin.classes.class_student_list', compact('class'));
    }

    //class detail

    // public function class_detail($id)
    // {
    //     $class = Classe::with('subjects')->findOrFail($id);
    //     return view('Admin.classes.class_detail', compact('class'));
    // }

    public function class_detail($id)
    {
        $class = Classe::with(['students', 'subjects'])->findOrFail($id);

        return view('Admin.classes.class_detail', compact('class'));
    }

    public function class_subject_delete($class_id,$subject_id)
{
    $class = Classe::findOrFail($class_id);

    $class->subjects()->detach($subject_id);

    return redirect()->route('class_detail',$class_id)
        ->with('success', 'Assigned Subject deleted successfully!');
}


}
