<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Harishdurga\LaravelQuiz\Models\Question;
use Harishdurga\LaravelQuiz\Models\QuestionOption;
use Harishdurga\LaravelQuiz\Models\Quiz;
use Harishdurga\LaravelQuiz\Models\QuizAttempt;
use Harishdurga\LaravelQuiz\Models\QuizAttemptAnswer;
use Harishdurga\LaravelQuiz\Models\QuizAuthor;
use Harishdurga\LaravelQuiz\Models\QuizQuestion;
use Harishdurga\LaravelQuiz\Tests\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function SaveQuiz(Request $request){
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
        $quizQuestion = Question::where('quiz_id',$id)->get();
        return view('instructor.courses.quiz.view_quiz',[
            'quiz' => $quiz,
            'questions' => $quizQuestion,
            ]);
    }

    public function AddQuestion(Request $request){
        $quizId = $request->quiz_id;

        Question::create([
            'name' => $request->name,
            'question_type_id' => 1,
            'quiz_id' => $request->quiz_id,
            'is_active' => 0,
        ]);


        $notification = array(
            'message' => 'Question added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function QuestionAssignMark(Request $request){

        QuizQuestion::create([
            'quiz_id' => $request->quiz_id,
            'question_id' => $request->question_id,
            'marks' => $request->marks,
            'order' => 2,
        ]);

        Question::find($request->question_id)->update([
            'is_active' => 1,
        ]);

        $notification = array(
            'message' => 'Mark added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function SaveQuestionAnswerOption(Request $request){
        QuestionOption::create([
            'question_id' => $request->question_id,
            'name' => $request->name,
            'is_correct' => $request->is_correct,
        ]);

        $notification = array(
            'message' => 'Option added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function TakeQuizTestView(Request $request, $course_id, $section_id){
        $userId = Auth::user()->id;
        $quizAuthor = QuizAuthor::find($userId);

        if ($quizAuthor == NULL){
            QuizAuthor::create([
                'quiz_id' => $request->quiz_id,
                'author_id' => $userId,
                'author_type' =>'student',
            ]);
        }

        $quiz = Quiz::where('course_id',$course_id)->where('section_id',$section_id)->first();
        $quizQuestions = QuizQuestion::where('quiz_id',$quiz->id)->get();

        return view('frontend.my-course.quiz-test.index',compact('course_id','section_id','quiz','quizQuestions'));

    }

    public function TakeQuizTestAttempt(Request $request){
        $userId = Auth::user()->id;
        $quizAuthor = QuizAuthor::find($userId);

        $courseId = $request->course_id;
        $sectionId = $request->section_id;

        if ($quizAuthor == NULL){
            QuizAuthor::create([
                'quiz_id' => $request->quiz_id,
                'author_id' => $userId,
                'author_type' =>'student',
            ]);
        }

        $participant = QuizAuthor::where('author_id',$userId)->first();

        $quizAttemptCheck = QuizAttempt::where('participant_id',$participant->id)->where('quiz_id',$request->quiz_id)
            ->where('course_id',$courseId)->where('section_id',$sectionId)->first();

        if ($quizAttemptCheck == NULL){
            QuizAttempt::create([
                'quiz_id' => $request->quiz_id,
                'course_id' => $request->course_id,
                'section_id' => $request->course_id,
                'participant_id' => $participant->id,
                'participant_type' => get_class($participant)
            ]);
        }

        $quizAttempt = $quizAttemptCheck->first();

        $question_ids = $request->get('question_id_');

        $item = [];
        foreach($question_ids as $key=>$question_id) {
            $quiz_question_id = $key;
            foreach($question_id as $option){
//                print_r($option.'</br>');
                QuizAttemptAnswer::create(
                    [
                        'quiz_attempt_id' => $quizAttempt->id,
                        'quiz_question_id' => $quiz_question_id,
                        'question_option_id' => $option,
                    ]
                );
            }
        }

        $notification = array(
            'message' => 'Quiz submitted Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

    public function QuizResultViewInfo(Request $request, QuizAttempt $quizAttempt){
        $quizId = $request->quiz_id;
        $courseId = $request->course_id;
        $sectionId = $request->section_id;

        $userId = Auth::user()->id;
        $quiz = Quiz::where('course_id',$courseId)->where('section_id',$sectionId)->first();
        $quizAuthor = QuizAuthor::find($userId);
        $participant = QuizAuthor::where('author_id',$userId)->first();

//        $quizAttempt = QuizAttempt::where('quiz_id',$quizId)
//                                    ->where('participant_id',$participant->id)
//            ->where('course_id',$courseId)->where('section_id',$sectionId)->first();
        $quizAttemptCheck = $quizAttempt->where('quiz_id',$quizId)
                                    ->where('participant_id',$participant->id)
                                    ->where('course_id',$courseId)
                                    ->where('section_id',$sectionId)->first();

//        return $quizAttempt->id;
        $quizAttemptAnswers = QuizAttemptAnswer::where('quiz_attempt_id',$quizAttemptCheck->id)->get();
//        return $quizAttemptAnswers;
//        $quizAttemptScore = $quizAttemptCheck->calculate_score();
//        return $quizAttemptScore;
        return view('frontend.my-course.quiz-test.result',compact('courseId','sectionId','quiz', 'userId','quizAttemptAnswers'));
//        return view('frontend.my-course.quiz-test.result',compact('courseId','sectionId','quiz', 'userId','quizAttemptAnswers','quizAttemptScore'));
    }

}
