<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use App\Imports\PermissionImport;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function AllRoles(){
        $roles = Role::all();
        return view('admin.backend.pages.roles.all_roles',compact('roles'));
    }

    public function AddRoles(){
        return view('admin.backend.pages.roles.add_roles');
    }

    public function StoreRoles(Request $request){
        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message'           => 'Role created successfully.',
            'alert-type'        => 'success',
        );

        return redirect()->route('all.role')->with($notification);
    }

    public function EditRole($id){
        $role = Role::find($id);
        return view('admin.backend.pages.roles.edit_role',compact('role'));
    }

    public function UpdateRole(Request $request){
        $roleId = $request->id;
        Role::find($roleId)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message'           => 'Role created successfully.',
            'alert-type'        => 'success',
        );

        return redirect()->route('all.role')->with($notification);
    }

    public function DeleteRole($id){
        Role::find($id)->delete();


        $notification = array(
            'message'           => 'Role deleted successfully.',
            'alert-type'        => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function RoleByPermission(){
        $roles = Role::all();
        return view('admin.backend.pages.roles.role_by_permission',compact('roles'));
    }

}
