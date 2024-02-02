<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function AllPermission()
    {
        $permissions = Permission::all();
        return view('admin.backend.pages.permission.all_permission',compact('permissions'));
    }

    public function AddPermission()
    {
        return view('admin.backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request)
    {
//        return $request;
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);


        $notification = array(
            'message'           => 'Permission created successfully.',
            'alert-type'        => 'success',
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id)
    {
        $permission = Permission::find($id);
        return view('admin.backend.pages.permission.edit_permission',compact('permission'));
    }

    public function UpdatePermission(Request $request)
    {
        $permission_id = $request->id;
        Permission::find($permission_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message'           => 'Permission updated successfully.',
            'alert-type'        => 'success',
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id){
        Permission::find($id)->delete();

        $notification = array(
            'message'           => 'Permission updated successfully.',
            'alert-type'        => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function ImportPermission(){
        return view('admin.backend.pages.permission.import_permission');
    }

    public function ExportPermission(){
        return Excel::download(new PermissionExport,'allpermission.xlsx');
    }

    public function ImportPermissionFile(Request $request){
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message'           => 'Permission imported successfully.',
            'alert-type'        => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function AssignPermission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('admin.backend.pages.permission.assign_permission',compact('roles','permissions','permission_groups'));
    }

    public function StoreAssignPermission(Request $request){
        $data = [];
        $permissions = $request->permission;

        foreach($permissions as  $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message'           => 'Permission assign successfully.',
            'alert-type'        => 'success',
        );

        return redirect()->route('role.assigned.permission')->with($notification);
    }

    public function EditPermissionAssignedRole($id){
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('admin.backend.pages.permission.edit_assign_permission',compact('role','permissions','permission_groups'));
    }


    public function UpdatePermissionAssigned(Request $request, $id){
        $role = Role::find($id);
        $permissions = [];
        $role_permissions = $request->input('permission');

//        if (!empty($permissions)){
            foreach ($role_permissions as $key => $val) {
                $permissions[intval($val)] = intval($val);
            }
//          dd($permissions, $request->permission);
            $role->syncPermissions($permissions);
//        }

        $notification = array(
            'message'           => 'Permission assign update successfully.',
            'alert-type'        => 'success',
        );

        return redirect()->route('role.assigned.permission')->with($notification);
    }

    public function DeletePermissionAssignedRole(){
        $roles = Role::all();
        return view('admin.backend.pages.roles.role_by_permission',compact('roles'));
    }
}
