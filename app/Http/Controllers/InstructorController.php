<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    public function InstructorLogin(){
        return view('instructor.instructor_login');
    }

    public function InstructorDetails($id){
        $instructor = User::find($id);
        $course = Course::where('instructor_id',$id)->get();
        return view('frontend.instructor.instructor_details',compact('instructor','course'));
    }

    public function InstructorDashboard(){
        return view('instructor.index');
    }

    public function InstructorProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('instructor.instructor_profile_view',compact('profileData'));
    }

    public function InstructorProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/instructor_images/'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/instructor_images'),$fileName);
            $data['photo'] = $fileName;
        }

        $data->save();

        $notification = array(
            'message' => 'Instructor Profile Updated Success',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function InstructorChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('instructor.instructor_change_password',compact('profileData'));
    }

    public function InstructorUpdatePassword(Request $request){
        //      Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Does Not Match!',
                'alert-type' => 'error',
            );

            return back()->with($notification);
        }

//      Update the new Pasword
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully.',
            'alert-type' => 'error',
        );
        return back()->with($notification);
    }

    public function InstructorLogOut(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }
}
