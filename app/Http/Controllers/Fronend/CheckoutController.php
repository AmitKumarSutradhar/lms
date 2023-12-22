<?php

namespace App\Http\Controllers\Fronend;

use App\Http\Controllers\Controller;
use App\Mail\Orderconfirm;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function CheckoutCreate(){
        if (Auth::check()){
            if (Cart::total() > 0){
                $carts = Cart::content();
                $cartTotal = Cart::total();
                $cartQty = Cart::count();


                return view('frontend.checkout.checkout_view',compact('carts','cartTotal','cartQty'));
            } else {
                $notification = array(
                    'message' => 'Your Cart is empty',
                    'alert-type' => 'error',
                );

                return redirect()->to('/')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Please login/register',
                'alert-type' => 'error',
            );

            return redirect()->route('login')->with($notification);
        }
    }

    public function Payment(Request $request){
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

//        Crate a new payment record

        $data = new Payment();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->cash_delivery= $request->cash_delivery;
        $data->total_amount = $total_amount;
        $data->payment_type = 'Direct Payment';

        $data->invoice_no = 'EOS'.mt_rand(10000000,99999999);
        $data->order_date = Carbon::now()->format('d F Y');
        $data->order_month = Carbon::now()->format('F');
        $data->order_year =  Carbon::now()->format('Y');
        $data->status = 'pending';
        $data->created_at =  Carbon::now();
        $data->save();

        foreach ($request->course_title as $key => $course_title){
            $existingOrder = Order::where('user_id',Auth::user()->id)->where('course_id',$request->course_id[$key])->first();

            if ($existingOrder){
                $notification = array(
                    'message' => 'You have already enrolled in this course',
                    'alert-type' => 'error',
                );

                return redirect()->back()->with($notification);
            }

            $order = new Order();
            $order->payment_id = Auth::user()->id;
            $order->user_id = $data->id;
            $order->course_id = $request->course_id[$key];
            $order->instructor_id = $request->instructor_id[$key];
            $order->course_title = $course_title;
            $order->price = $request->price[$key];
            $order->save();

        }

        $request->session()->forget('cart');
        $paymentId = $data->id;

//        Start Send Email to Student
        $sendmail = Payment::find($paymentId);
        $data = [
            'invoice_no' => $sendmail->invoice_no,
            'amount' => $total_amount,
            'name' => $sendmail->name,
            'email' => $sendmail->email,
        ];

        Mail::to($request->email)->send(new Orderconfirm($data));
//        End Send Email to Student

        if ($request->cash_delivery == 'stripe'){
            echo "Stripe";
        } else {
            $notification = array(
                'message' => 'Cash payment submitted successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('index')->with($notification);
        }


    }
}
