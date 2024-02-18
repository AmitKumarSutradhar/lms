<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveUserController extends Controller
{
    public function AdminAllActiveUser(){
        $users = User::where('role','user')->latest()->get();
        return view('admin.backend.user.user_all',compact('users'));
    }

    public function AdminAllActiveInstructor(){
        $instructor = User::where('role','instructor')->latest()->get();
        return view('admin.backend.user.instructor_all',compact('instructor'));
    }

    public function AdminBlockUser($id){
        $user = User::find($id);
        $user->status = "0";
        $user->save();
        return redirect()->back()->with('message','User blocked successfully.');
    }

    public function AdminUnblockBlockUser($id){
        $user = User::find($id);
        $user->status = "1";
        $user->save();
        return redirect()->back()->with('message','User unblocked successfully.');
    }

    public function AdminDeleteUser($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('message','User deleted successfully.');
    }

}
