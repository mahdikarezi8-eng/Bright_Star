<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class EmployeeController extends Controller
{
    public function employee_add(Request $request)
    {
        
        return view('Admin.employees.employee_add');
    }
    public function employee_save(Request $request)
    {
        $request->validate([
            'user_id'           => ['nullable', 'integer'],
            'first_name'        => ['required', 'string', 'max:255'],
            'last_name'         => ['required', 'string', 'max:255'],
            'fname'             => ['required', 'string', 'max:255'],
            'gender'           => ['required', 'boolean'],
            'birth_year'       => ['required', 'integer', 'max:' . date('Y')],
            'image'            => ['required', 'image'],
            'nic'              => ['required', 'string'],
            'phone'            => ['required', 'string', 'unique:employees,phone'],
            'email'            => ['required', 'string', 'unique:employees,email'],
            'address'          => ['required', 'string', 'max:255'],
            'province'         => ['required', 'string', 'max:255'],
            'position'         => ['required', 'string', 'max:255'],
            'salary'           => ['required', 'integer', 'min:0'],
            'reg_date'         => ['required', 'date'],
        ]);

        // Create user account if user_id is not provided
        if (!$request->user_id) {
            $user = new User();
            $user->name = $request->first_name;
            $user->email = $request->email;
            $user->password = Hash::make('password123');
            $user->role = 'staff';
            $user->save();
            $userId = $user->id;
        } else {
            $userId = $request->user_id;
        }

        $employee = new Employee();
        $employee->user_id = $userId;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->father_name = $request->fname;
        $employee->gender = $request->gender;
        $employee->birth_year = $request->birth_year;
        $employee->nic = $request->nic;
        $employee->phone  = $request->phone;
        $employee->email = $request->email;
        $employee->curent_address = $request->address;
        $employee->province = $request->province;
        $employee->position = $request->position;
        $employee->gross_salary = $request->salary;
        $employee->reg_date = $request->reg_date;
        $image = $request->image;
        $image_name = time() . "_" . $image->getClientOriginalName();
        $request->image->move('images/employee/', $image_name);
        $employee->image = $image_name;
        $employee->save();
        return redirect()->route('employee_list')->with('success', 'Employee inserted Successfully!s');
    }

    public function employee_list()
    {
        $employees = Employee::paginate(10);
        return view('Admin.employees.employee_list', compact("employees"));
    }


    public function employee_detail($id)
    {
        $employee = Employee::find($id);
        return view('Admin.employees.employee_detail', compact('employee'));
    }






    public function employee_edit($id)
    {
        $users = User::all();
        $employee = Employee::find($id);
        return view('Admin.employees.employee_edit', compact('employee', 'users'));
    }
    public function employee_update(Request $request, $id)
    {
        $employee  = Employee::find($id);
        $request->validate([
            'user_id'           => ['nullable', 'integer'],
            'first_name'        => ['required', 'string', 'max:255'],
            'last_name'         => ['required', 'string', 'max:255'],
            'fname'             => ['required', 'string', 'max:255'],
            'gender'           => ['required', 'boolean'],
            'birth_year'       => ['required', 'integer', 'max:' . date('Y')],
            'nic'              => ['required', 'string'],
            'phone'            => ['required', 'string', Rule::unique('employees')->ignore($employee->id)],
            'email'            => ['required', 'string', Rule::unique('employees')->ignore($employee->id)],
            'address'          => ['required', 'string', 'max:255'],
            'province'         => ['required', 'string', 'max:255'],
            'position'         => ['required', 'string', 'max:255'],
            'salary'           => ['required', 'integer', 'min:0'],
            'reg_date'         => ['required', 'date'],
        ]);
        if (!is_null($request->image)) {
            $request->validate([
                'image' => ['required', 'image'],
            ]);
        }
        $employee->user_id = $request->user_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->father_name = $request->fname;
        $employee->gender = $request->gender;
        $employee->birth_year = $request->birth_year;
        $employee->nic = $request->nic;
        $employee->phone  = $request->phone;
        $employee->email = $request->email;
        $employee->curent_address = $request->address;
        $employee->province = $request->province;
        $employee->position = $request->position;
        $employee->gross_salary = $request->salary;
        $employee->reg_date = $request->reg_date;

        $image = $request->image;
        if ($image) {

            if ($employee->image && file_exists(public_path('images/employee/' . $employee->image))) {
                unlink(public_path('images/employee/' . $employee->image));
            }
            $image_name = time() . "_" . $image->getClientOriginalName();
            $request->image->move('images/employee/', $image_name);
            $employee->image = $image_name;
        }
        $employee->save();
        return redirect()->route('employee_list')->with('success', 'Employee Updated Successfully!');
    }

    public function  employee_delete($id)
    {
        $employee = Employee::findOrFail($id);

        $image_path = public_path('images/employee/') . $employee->image;

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $employee->delete();
        return redirect()->route('employee_list')->with('success', 'Employee Deleted Successfully!');
    }
}
