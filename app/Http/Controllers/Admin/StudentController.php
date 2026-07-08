<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{

    public function student_add()
    {
        $classes = Classe::all();
        return view('Admin.students.student_add', compact('classes'));
    }


    public function student_save(Request $request)
    {
        $request->validate([
            'class_id'            => ['required'],
            'first_name'             => ['required', 'string', 'max:255'],
            'last_name'              => ['required', 'string', 'max:255'],
            'father_name'            => ['required', 'string', 'max:255'],
            'gender'                => ['required', 'boolean'],
            'birth_year'            => ['required', 'integer', 'max:' . date('Y')],
            'image'                 => ['required', 'image', 'mimes:jpg,jpeg,png',],
            'curent_address'         => ['required', 'string', 'max:255'],
            'phone'                 => ['required', 'unique:students,phone'],
            'email'                 => ['nullable', 'email', 'unique:students,email'],
            'nic'                   => ['required', 'string', 'max:255'],
        ]);

        $student = new Student();
        $student->class_id = $request->class_id;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->father_name = $request->father_name;
        $student->gender = $request->gender;
        $student->birth_year = $request->birth_year;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->curent_address = $request->curent_address;
        $student->nic = $request->nic;
        $image = $request->image;
        $image_name = time() . "_" . $image->getClientOriginalName();
        $request->image->move('images/students/', $image_name);
        $student->image = $image_name;
        $student->save();
        return redirect()->route('student_list')->with('success', 'Student Inserted Successfully!');
    }


    public function student_list()
    {
        $students = Student::all();
        return view('Admin.students.student_list', compact('students'));
    }



    public function student_detail($id)
    {
        $student = Student::find($id);
        return view('Admin.students.student_detail', compact('student'));
    }




    public function student_edit($id)
    {
        $classes = Classe::all();
        $student = Student::find($id);
        return view('Admin.students.student_edit', compact('student', 'classes'));
    }

    public function student_update(Request $request, $id)
    {
        $student  = Student::find($id);
        $request->validate([
            'class_id'               => ['required'],
            'first_name'             => ['required', 'string', 'max:255'],
            'last_name'              => ['required', 'string', 'max:255'],
            'father_name'            => ['required', 'string', 'max:255'],
            'gender'                 => ['required', 'boolean'],
            'birth_year'             => ['required', 'integer', 'max:' . date('Y')],
            'curent_address'         => ['required', 'string', 'max:255'],
            'phone'                  => ['required', 'string', Rule::unique('students')->ignore($student->id)],
            'email'                  => ['required', 'string', Rule::unique('students')->ignore($student->id)],
            'nic'                    => ['required', 'string', 'max:255'],
        ]);

        if (!is_null($request->image)) {
            $request->validate([
                'image'   => ['required', 'image', 'mimes:jpg,jpeg,png']
            ]);
        }
        $student->class_id = $request->class_id;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->father_name = $request->father_name;
        $student->gender = $request->gender;
        $student->birth_year = $request->birth_year;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->curent_address = $request->curent_address;
        $student->nic = $request->nic;

        $image = $request->image;
        if ($image) {

            if ($student->image && file_exists(public_path('images/students/' . $student->image))) {
                unlink(public_path('images/students/' . $student->image));
            }
            $image_name = time() . "_" . $image->getClientOriginalName();
            $request->image->move('images/students/', $image_name);
            $student->image = $image_name;
        }
        $student->save();
        return redirect()->route('student_list')->with('success', 'Student Updated Successfully!');
    }


    public function student_delete($id)
    {
        $student = Student::find($id);

        $image_path = public_path('images/students/') . $student->image;

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $student->delete();
        return redirect()->route('student_list')->with('success', 'Student Deleted Successfully!');
    }
}
