<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Orderconfirm;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\OrderComplete;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

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
                    'alert-type' => 'errors',
                );

                return redirect()->to('/')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Please login/register',
                'alert-type' => 'errors',
            );

            return redirect()->route('login')->with($notification);
        }
    }

    public function Payment(Request $request){
        $user = User::where('role','instructor')->get();
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        $data = array();
        $data['name']               = $request->name;
        $data['email']              = $request->email;
        $data['phone']              = $request->phone;
        $data['address']            = $request->address;
        $data['course_title']       = $request->course_title;
        $cartTotal                  = Cart::total();
        $carts                      = Cart::content();



        if ($request->cash_delivery == 'stripe'){
            return view('frontend.payment.stripe',compact('data','cartTotal','carts'));
        }
        elseif ($request->cash_delivery == 'handcash')
        {
            //Crate a new payment record
            $data                   = new Payment();
            $data->name             = $request->name;
            $data->email            = $request->email;
            $data->phone            = $request->phone;
            $data->address          = $request->address;
            $data->cash_delivery    = $request->cash_delivery;
            $data->total_amount     = $total_amount;
            $data->payment_type     = 'Direct Payment';

            $data->invoice_no       = 'EOS'.mt_rand(10000000,99999999);
            $data->order_date       = Carbon::now()->format('d F Y');
            $data->order_month      = Carbon::now()->format('F');
            $data->order_year       =  Carbon::now()->format('Y');
            $data->status           = 'pending';
            $data->created_at       =  Carbon::now();
            $data->save();

            foreach ($request->course_title as $key => $course_title){
                $existingOrder = Order::where('user_id',Auth::user()->id)->where('course_id',$request->course_id[$key])->first();

                if ($existingOrder){
                    $notification = array(
                        'message'       => 'You have already enrolled in this course',
                        'alert-type'    => 'errors',
                    );

                    return redirect()->back()->with($notification);
                }

                $order                  = new Order();
                $order->payment_id      = $data->id;
                $order->user_id         = Auth::user()->id;
                $order->course_id       = $request->course_id[$key];
                $order->instructor_id   = $request->instructor_id[$key];
                $order->course_title    = $course_title;
                $order->price           = $request->price[$key];
                $order->save();

            }

            $request->session()->forget('cart');
            $paymentId = $data->id;

            //Start Send Email to Student
            $sendmail = Payment::find($paymentId);
            $data = [
                'invoice_no'            => $sendmail->invoice_no,
                'amount'                => $total_amount,
                'name'                  => $sendmail->name,
                'email'                 => $sendmail->email,
            ];

            //Mail::to($request->email)->send(new Orderconfirm($data));
            //End Send Email to Student

            //Send notification
            Notification::send($user, new OrderComplete($request->name));

            $notification = array(
                'message'           => 'Cash payment submitted successfully',
                'alert-type'        => 'success',
            );

            return redirect()->route('index')->with($notification);
        }


    }

    public function StripeOrder(Request $request){
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        Stripe::setApiKey('sk_test_51OSwefJ26NhBL2PCzzsKJ6Fg8agKO26PSO7n7nqDTapkoVzIRGAXSZuJ3pKc0PT9XVceVshpwg9VH1iZEx6Ke1gQ00xBLOBmD1');
        $token  = $_POST['stripeToken'];

        $charge = Charge::create([
            'amount'        => $total_amount * 100,
            'currency'      => 'usd',
            'description'   => 'LMS',
            'source'        => $token,
            'metadata'      => [
                'order_id'     => '3434'
            ],
        ]);

        $order_id = Payment::insertGetId([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'total_amount'  => $request->total_amount,
            'payment_type'  => 'Stripe',
            'invoice_no'    => 'EOS'.mt_rand(10000000,99999999),
            'order_date'   => Carbon::now()->format('d F Y'),
            'order_month'   => Carbon::now()->format('F'),
            'order_year'   =>  Carbon::now()->format('Y'),
            'status'        => 'pending',
            'created_at'    =>  Carbon::now(),
        ]);

        $carts = Cart::content();
        foreach ($carts as $cart){
            Order::insert([
                'payment_id' => $order_id,
                'user_id' => Auth::user()->id,
                'course_id' => $cart->id,
                'instructor_id' => $cart->options->instructor,
                'course_title' => $cart->options->name,
                'price' => $cart->price,
            ]);
        }

        if (Session::has('coupon')){
            Session::forget('coupon');
        }
        Cart::destroy();

        $notification = array(
            'message'           => 'Stripe payment submitted successfully',
            'alert-type'        => 'success',
        );

        return redirect()->route('index')->with($notification);
    }
}
