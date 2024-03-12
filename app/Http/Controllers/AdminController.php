<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message'           => 'Logout successfully',
            'alert-type'        => 'success',
        );

        return redirect('/admin/login')->with($notification);
    }

    public function AdminLogin(){
        $notification = array(
            'message'           => 'Login successfully',
            'alert-type'        => 'success',
        );

        return view('admin.admin_login')->with($notification);
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$fileName);
            $data['photo'] = $fileName;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Success',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function AdminChangePassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));

    }

    public function AdminUpdatePassword(Request $request)
    {

//      Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Does Not Match!',
                'alert-type' => 'errors',
            );

            return back()->with($notification);
        }

//      Update the new Pasword
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully.',
            'alert-type' => 'errors',
        );
        return back()->with($notification);
    }

    public function BecomeInstructor(){
        return view('frontend.instructor.reg_instructor');
    }

    public function InstructorRegister(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','unique:users'],
        ]);

        User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'instructor',
            'status' => '0',
        ]);

        $notification = array(
            'message' => 'Instructor Register Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('instructor.login')->with($notification);
    }

    public function AllInstructor(){
        $allInstructor = User::where('role','instructor')->latest()->get();
        return view('admin.backend.instructor.all_instructor',compact('allInstructor'));
    }


    public function AdminInstructorCreate(){
        return view('admin.backend.instructor.create_instructor');
    }

    public function AdminInstructorStore(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','unique:users'],
        ]);

        User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'instructor',
            'status' => '1',
        ]);

        $notification = array(
            'message' => 'Instructor Register Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('all.instructor')->with($notification);
    }

    public function UpdateUserStatus(Request $request){
        $userId = $request->input('user_id');
        $isChecked =  $request->input('is_checked',0);

        $user = User::find($userId);

        if ($user){
            $user->status = $isChecked;
            $user->save();
        }

        return response()->json(['message' => 'User Status Updated Successfully.']);
    }

    public function AdminAllCourse(){
        $course = Course::latest()->get();
        return view('admin.backend.courses.all_course',compact('course'));
    }

    public function UpdateCourseStatus(Request $request){
        $courseId = $request->input('course_id');
        $isChecked =  $request->input('is_checked',0);

        $course = Course::find($courseId);

        if ($course){
            $course->status = $isChecked;
            $course->save();
        }

        return response()->json(['message' => 'Course Status Updated Successfully.']);
    }

    public function AdminCourseDetails($id){
        $course = Course::find($id);
        return view('admin.backend.courses.course_details',compact('course'));

    }

    public function AllAdmin(){
        $allAdmin = User::where('role','admin')->get();
        return view('admin.backend.pages.admin.all_admin',compact('allAdmin'));
    }

    public function AddAdmin(){
        $roles = Role::all();
        return view('admin.backend.pages.admin.add_admin',compact('roles'));
    }

    public function StoreAdmin(Request $request){

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = '1';
        $user->save();


        if ($request->roles){
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'Admin Created Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.all')->with($notification);
    }

    public function AdminRoleEdit($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.backend.pages.admin.edit_admin_role',compact('user','roles'));
    }

    public function AdminRoleUpdate(Request $request, $id){

        $user = User::find($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        if ($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->role = 'admin';
        $user->status = '1';
        $user->save();

    $user->roles()->detach();
        if ($request->roles){
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'Admin Role Updated Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.all')->with($notification);
    }

    public function AdminRoleDelete($id){
        $user = User::find($id);
        if (!is_null($user)){
            $user->delete();
        }

        $notification = array(
            'message' => 'Admin Deleted Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

}
