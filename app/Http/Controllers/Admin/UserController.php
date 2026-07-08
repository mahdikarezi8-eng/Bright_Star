<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function emp_user_list()
    {
        $users = User::where('role', 'staff')->get();
        return view('Admin.user_manage.emp_user_list', compact('users'));
    }

    public function emp_user_add()
    {
        $roles = Role::all();
        return view('Admin.user_manage.emp_user_add', compact('roles'));
    }


    public function emp_user_save(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'role' => ['required', 'exists:roles,name']
        ]);
        // return $request->all();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->role) {
            $user->assignRole($request->role);
        }
        return redirect()->route('emp_user_list')->with('success', 'User Added To Employee!');
    }


    public function emp_user_edit($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        return view('Admin.user_manage.emp_user_edit', compact('roles', 'user'));
    }
    public function emp_user_update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed'],
            'role' => ['required', 'exists:roles,name']
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->syncRoles([$request->role]);
        return redirect()->route('emp_user_list')->with('success', 'User Updated Successfully!');
    }



    public function emp_user_delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully!');
    }

    // user mangment for teachers

    public function teacher_user_list()
    {
        $users = User::where('role', 'teacher')->get();
        return view('Admin.user_manage.teacher_user_list', compact('users'));
    }
    public function teacher_user_add()
    {
        $roles = Role::all();
        return view('Admin.user_manage.teacher_user_add', compact('roles'));
    }
    public function teacher_user_save(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'role' => ['required', 'exists:roles,name']
        ]);
        // return $request->all();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'teacher';
        $user->save();
        if ($request->role) {
            $user->assignRole($request->role);
        }
        return redirect()->route('teacher_user_list')->with('success', 'User Added To Employee!');
    }


    public function teacher_user_edit($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        return view('Admin.user_manage.teacher_user_edit', compact('roles', 'user'));
    }

    public function teacher_user_update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed'],
            'role' => ['required', 'exists:roles,name']
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'teacher';
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->syncRoles([$request->role]);
        return redirect()->route('teacher_user_list')->with('success', 'User Updated Successfully!');
    }
    public function teacher_user_delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully!');
    }
}
