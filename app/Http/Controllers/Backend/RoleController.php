<?php

namespace App\Http\Controllers\Backend;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use App\Imports\PermissionImport;

class RoleController extends Controller
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

}
