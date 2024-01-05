<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function AdminAllCoupons(){
        $coupon = Coupon::latest()->get();
        return view('admin.backend.coupon.coupon_all',compact('coupon'));
    }

    public function AdminAddCoupons(){
        return view('admin.backend.coupon.add_coupon');
    }

    public function AdminStoreCoupon(Request $request){
        Coupon::insert([
           'coupon_name' => strtoupper($request->coupon_name),
           'coupon_discount' => $request->coupon_discount,
           'coupon_validity' => $request->coupon_validity,
            'created_at'=> Carbon::now()
        ]);

        $notification = array(
            'message' => 'Coupon Created Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.all.coupon')->with($notification);
    }

    public function AdminEditCoupon($id){
        $coupon = Coupon::find($id);
        return view('admin.backend.coupon.edit_coupon',compact('coupon'));
    }

    public function AdminUpdateCoupon(Request $request){
        $coupon_id = $request->id;

        Coupon::find($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at'=> Carbon::now()
        ]);

        $notification = array(
            'message' => 'Coupon Info Updated Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.all.coupon')->with($notification);
    }

    public function AdminDeleteCoupon($id){
        Coupon::find($id)->delete();

        $notification = array(
            'message' => 'Coupon Delete Successfully.',
            'alert-type' => 'warning',
        );

        return redirect()->back()->with($notification);
    }

//    Instructor Cupons
    public function InstructorAllCoupons(){
        $id = Auth::user()->id;
        $coupon = Coupon::where('instructor_id',$id)->latest()->get();
        return view('instructor.coupon.coupon_all',compact('coupon'));
    }

    public function InstructorAddCoupons(){
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id',$id)->get();
        return view('instructor.coupon.coupon_add',compact('courses'));
    }

    public function InstructorStoreCoupons(Request $request){
        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'instructor_id' => Auth::user()->id,
            'course_id' => $request->course_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('instructor.all.coupon')->with($notification);
    }

    public function InstructorEditCoupons($id){
        $coupon = Coupon::find($id);
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id',$id)->get();
        return view('instructor.coupon.coupon_edit',compact('coupon','courses'));
    }

    public function InstructorUpdateCoupons(Request $request){
        Coupon::find($request->coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'instructor_id' => Auth::user()->id,
            'course_id' => $request->course_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('instructor.all.coupon')->with($notification);
    }

    public function InstructorDeleteCoupons($id){
        Coupon::find($id)->delete();

        $notification = array(
            'message' => 'Coupon Delete Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

}
