<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function UserQuestion(Request $request){
        Question::insert([
            'user_id' => Auth::user()->id,
            'course_id' => $request->course_id,
            'instructor_id' => $request->instructor_id,
            'subject' => $request->subject,
            'question' => $request->question,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Message Send Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
