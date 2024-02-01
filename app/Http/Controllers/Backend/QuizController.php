<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Harishdurga\LaravelQuiz\Models\Question;
use Harishdurga\LaravelQuiz\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function SaveQuiz(Request $request){
//       return $request;
       Quiz::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'total_marks' =>  $request->total_marks,
            'pass_marks' => $request->pass_marks,
            'max_attempts' => 1,
            'is_published' => 1,
            'course_id' => $request->course_id,
            'section_id' => $request->section_id,
        ]);

        $notification = array(
            'message' => 'Quiz added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }


    public function ViewQuiz($id){
        $quiz = Quiz::find($id);
        return view('instructor.courses.quiz.view_quiz',[
            'quiz' => $quiz,
            ]);
    }

    public function AddQuestion(Request $request){
        Question::create([
            'name' => $request->name,
            'question_type_id' => 1,
        ]);

        $notification = array(
            'message' => 'Question added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
