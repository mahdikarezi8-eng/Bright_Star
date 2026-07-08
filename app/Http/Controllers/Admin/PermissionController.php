<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function permission_list(){
        // $permissions = Permission::all()->groupBy('group_name');
        $permissions = Permission::orderBy('group_name')
        ->orderBy('id', 'asc')
        ->get()
        ->groupBy('group_name');
        return view('Admin.permissions.permission_list',compact('permissions'));
    }

    public function permission_add(){
        return view('Admin.permissions.permission_add');
    }


    public function permission_save(Request $request){
            $request->validate([
                    'name'=>['required','string','max:255'],
                    'group_name' =>['nullable','string']
            ]);

            $permission = new Permission();
            $permission->name = $request->name;
            $permission->group_name = $request->group_name;
            $permission->save();
            return redirect()->route('permission_list')->with('success','Permisson Inserted Successfully!');

    }

    public function permission_edit($id){
        $permission = Permission::find($id);
        return view('Admin.permissions.permission_edit',compact('permission'));
    }

    public function permission_update(Request $request ,$id){
        $request->validate([
                    'name'=>['required','string','max:255'],
                    'group_name' =>['nullable','string']
            ]);
            $permission = Permission::find($id);
            $permission->name = $request->name;
            $permission->group_name = $request->group_name;
            $permission->save();
            return redirect()->route('permission_list')->with('success','Permission Updated Successfuly!');

    }


    public function permission_delete($id){
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission_list')->with('success','Permission Deleted Succesfully!');
    }


}
