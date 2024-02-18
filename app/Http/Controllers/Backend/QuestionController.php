<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\UserQuestion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Illuminate\Database\Eloquent\Casts\get;

class QuestionController extends Controller
{
    public function UserQuestion(Request $request){
        UserQuestion::insert([
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

    public function InstructorAllQuestion(){
        $id = Auth::user()->id;
        $question = UserQuestion::where('instructor_id',$id)->where('parent_id',null)->orderBy('id','DESC')->get();
        return view('instructor.question.all_question',compact('question'));
    }

    public function QuestionDetails($id){
        $question = UserQuestion::find($id);
        $reply = UserQuestion::where('parent_id',$id)->orderBy('id','asc')->get();
        return view('instructor.question.question_details',compact('question','reply'));
    }

    public function InstructorReply(Request $request){
        UserQuestion::insert([
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
            'instructor_id' => $request->instructor_id,
            'parent_id' => $request->qid,
            'question' => $request->question,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Message Send Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('instructor.all-question')->with($notification);
    }
}
