<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function role_list()
    {
        $roles = Role::all();
        return view('Admin.roles.role_list', compact('roles'));
    }


    public function role_add()
    {
        return view('Admin.roles.role_add');
    }


    public function role_save(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string']

        ]);
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        return redirect()->route('role_list')->with('success', 'Role Inserted Successfully!');
    }



    public function role_edit($id)
    {
        $role = Role::find($id);
        return view('Admin.roles.role_edit', compact('role'));
    }

    public function role_update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string']

        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        return redirect()->route('role_list')->with('success', 'Role Updated Succesfully!');
    }


    public function role_delete($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('role_list')->with('success', 'Role Deleted Succesfully!');
    }



    // role in permission managment

    public function role_to_permission_list()
    {
        $roles = Role::all();
        return view('Admin.role_manage.role_to_permission_list', compact('roles'));
    }

    public function add_role_in_permission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_group = User::getPermissionGroup();
        return view('Admin.role_manage.add_role_in_permission', compact('roles', 'permissions', 'permission_group'));
    }


    public function role_to_permission_save(Request $request)
    {

        $request->validate([
            'role_id' => ['required', 'integer'],
            'permission' => ['required', 'array']
        ]);

        $data = array();
        $permissions = $request->permission;
        foreach ($permissions as $permission) {
            $data['role_id']  = $request->role_id;
            $data['permission_id'] = $permission;
            DB::table('role_has_permissions')->insert($data);
        }
        return redirect()->route('role_list')->with('success', 'Permission Added to Role!');
    }


    public function role_to_permission_edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_group = User::getPermissionGroup();
        return view('Admin.role_manage.role_to_permission_edit', compact('role', 'permissions', 'permission_group'));
    }



    public  function role_to_permission_update(Request $request, $id)
    {
        $role = Role::find($id);
        $permissions = $request->permission;
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        return redirect()->route('role_to_permission_list')->with('success', 'Role to Permission Updated!');
    }

    public function role_to_permission_delete($id)
    {
        $role = Role::find($id);
        if (!is_null($role)) {
            $role->delete();
        }
        return redirect()->back()->with('success', 'Role To Permission Deleted!');
    }
}
