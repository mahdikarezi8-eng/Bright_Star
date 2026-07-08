<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function teacher_add()
    {

        return view('Admin.teachers.teacher_add');
    }
    public function teacher_save(Request $request)
    {

        $request->validate([
            'user_id'                => ['nullable', 'integer'],
            'first_name'             => ['required', 'string', 'max:255'],
            'last_name'              => ['required', 'string', 'max:255'],
            'father_name'            => ['required', 'string', 'max:255'],
            'gender'                 => ['required', 'boolean'],
            'birth_year'             => ['required', 'integer', 'digits:4', 'max:' . date('Y')],
            'image'                 => ['required', 'image', 'mimes:jpg,jpeg,png',],
            'phone'                 => ['required', 'unique:teachers,phone'],
            'email'                 => ['nullable', 'email', 'unique:teachers,email'],
            'curent_address'        => ['required', 'string', 'max:255'],
            'education_degree'      => ['required', 'string', 'max:255'],
            'education_university'  => ['required', 'string', 'max:255'],
            'education_year'        => ['required', 'integer', 'max:' . date('Y')],
            'talent_score'          => ['required', 'integer', 'min:0'],
            'gross_salary'          => ['required', 'integer', 'min:0'],
            'food'                  => ['nullable', 'integer', 'min:0'],
            'nic'                   => ['required', 'string', 'max:255'],
            'reg_date'              => ['required', 'date'],
        ]);

        // Create user account if user_id is not provided
        if (!$request->user_id && $request->email) {
            $user = new User();
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make('password123');
            $user->role = 'teacher';
            $user->save();
            $userId = $user->id;
        } else {
            $userId = $request->user_id;
        }

        $teacher = new Teacher();
        $teacher->user_id = $userId;
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->father_name = $request->father_name;
        $teacher->gender = $request->gender;
        $teacher->birth_year = $request->birth_year;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->curent_address = $request->curent_address;
        $teacher->education_degree = $request->education_degree;
        $teacher->education_university = $request->education_university;
        $teacher->education_year = $request->education_year;
        $teacher->talent_score = $request->talent_score;
        $teacher->gross_salary = $request->gross_salary;
        $teacher->food = $request->food;
        $teacher->nic = $request->nic;
        $teacher->reg_date = $request->reg_date;


        $image = $request->image;
        $image_name = time() . "_" . $image->getClientOriginalName();
        $request->image->move('images/teachers/', $image_name);
        $teacher->image = $image_name;
        $teacher->save();
        return redirect()->route('teacher_list')->with('success', 'Teacher Inserted Successfully!');
    }

    public function teacher_list()
    {
        $user = auth()->user();
        if ($user && $user->role === 'teacher') {
            $teacher = $user->Teacher;
            $teachers = $teacher ? collect([$teacher]) : collect();
        } else {
            $teachers = Teacher::all();
        }
        return view('Admin.teachers.teacher_list', compact('teachers'));
    }

    public function teacher_detail($id)
    {
        $user = auth()->user();
        $teacher = Teacher::find($id);
        if ($user && $user->role === 'teacher') {
            if (!$teacher || $teacher->user_id !== $user->id) {
                return redirect()->route('teacher_list')->with('error', 'You can only view your own profile.');
            }
        }
        return view('Admin.teachers.teacher_detail', compact('teacher'));
    }


    public function teacher_edit($id)
    {
        $user = auth()->user();
        $teacher = Teacher::find($id);
        if ($user && $user->role === 'teacher') {
            if (!$teacher || $teacher->user_id !== $user->id) {
                return redirect()->route('teacher_list')->with('error', 'You can only edit your own profile.');
            }
        }
        $users  = User::all();
        return view('Admin.teachers.teacher_edit', compact('teacher', 'users'));
    }

    public function teacher_update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        $request->validate([
            'user_id'           => ['nullable', 'integer'],
            'first_name'        => ['required', 'string', 'max:255'],
            'last_name'         => ['required', 'string', 'max:255'],
            'father_name'       => ['required', 'string', 'max:255'],
            'gender'           => ['required', 'boolean'],
            'birth_year'       => ['required', 'integer', 'max:' . date('Y')],
            'nic'              => ['required', 'string'],
            'email'            => ['required', 'string', Rule::unique('teachers')->ignore($teacher->id)],
            'phone'            => ['required', 'string', Rule::unique('teachers')->ignore($teacher->id)],
            'education_degree'      => ['required', 'string', 'max:255'],
            'education_university'  => ['required', 'string', 'max:255'],
            'education_year'        => ['required', 'integer', 'max:' . date('Y')],
            'talent_score'          => ['required', 'integer', 'min:0'],
            'curent_address'          => ['required', 'string', 'max:255'],
            'gross_salary'           => ['required', 'integer', 'min:0'],
            'food'                  => ['nullable', 'integer', 'min:0'],
            'reg_date'         => ['required', 'date'],
        ]);

        if (!is_null($request->image)) {
            $request->validate([
                'image' => ['required', 'image'],
            ]);
        }
        $teacher->user_id   = $request->user_id;
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->father_name = $request->father_name;
        $teacher->gender = $request->gender;
        $teacher->birth_year = $request->birth_year;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->curent_address = $request->curent_address;
        $teacher->education_degree = $request->education_degree;
        $teacher->education_university = $request->education_university;
        $teacher->education_year = $request->education_year;
        $teacher->talent_score = $request->talent_score;
        $teacher->gross_salary = $request->gross_salary;
        $teacher->food = $request->food;
        $teacher->nic = $request->nic;
        $teacher->reg_date = $request->reg_date;

        $image = $request->image;
        if ($image) {


            if ($teacher->image && file_exists(public_path('images/teachers/' . $teacher->image))) {
                unlink(public_path('images/teachers/' . $teacher->image));
            }
            $image_name = time() . "_" . $image->getClientOriginalName();
            $request->image->move('images/teachers/', $image_name);
            $teacher->image = $image_name;
        }
        $teacher->save();
        return redirect()->route('teacher_list')->with('success', 'Teacher Updated Successfully!');
    }

    public function teacher_delete($id)
    {
        $user = auth()->user();
        $teacher = Teacher::find($id);
        if ($user && $user->role === 'teacher') {
            if (!$teacher || $teacher->user_id !== $user->id) {
                return redirect()->route('teacher_list')->with('error', 'You can only delete your own profile.');
            }
        }
        $image_path = public_path('images/teachers/') . $teacher->image;

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $teacher->delete();
        return redirect()->route('teacher_list')->with('success', 'Teacher Deleted Successfully!');
    }
}
