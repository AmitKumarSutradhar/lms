<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function AddToWishList(Request $request, $course_id){
        if (Auth::check()){
            $exists = Wishlist::where('user_id',Auth::id())->where('course_id',$course_id)->first();

            if (!$exists){
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'course_id' => $course_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully added on your wishlist.']);
            } else {
                return response()->json(['error' => 'This product has already in your wishlist.'] );
            }
        } else {
            return response()->json(['error' => 'Please login or register for add to wishlist'] );
        }
    }

    public function AllWishlist(){
        return view('frontend.wishlist.all_wishlist');
    }

    public function GetWishListCourse(){
        $wishlist = Wishlist::with('course')->where('user_id',Auth::id())->latest()->get();
        $wishQty = Wishlist::count();
        return response()->json([
            'wishlist' => $wishlist,
            'wishQty' => $wishQty,
        ]);
    }
}
