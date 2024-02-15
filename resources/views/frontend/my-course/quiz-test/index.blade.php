<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
@php
    $userId = \Illuminate\Support\Facades\Auth::user()->id;
    $participant = \Harishdurga\LaravelQuiz\Models\QuizAuthor::where('author_id',$userId)->first();
    $quizAttemptCheck = \Harishdurga\LaravelQuiz\Models\QuizAttempt::where('participant_id',$participant->id)->where('quiz_id',$quiz->id)->first();
@endphp
<div class="container mt-5">
    <div class="d-flex justify-content-between align-content-center">
        <div class=""></div>
        <h1 class="text-center mb-4">{{ $quiz->name }}</h1>
        <div class="">
            @if(!($quizAttemptCheck == NULL))
                <form action="{{ route('quiz.take.test.attempt.result.info') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $quizQuestions }}">
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                    <input type="hidden" name="course_id" value="{{ $course_id }}">
                    <input type="hidden" name="section_id" value="{{ $section_id }}">
                    <button type="submit"  class="btn btn-primary"  id="" >View Result</button>
                </form>
            @else

            @endif
        </div>
    </div>


    <form action="{{ route('quiz.take.test.attempt') }}" method="POST">
        @csrf

        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
{{--        <input type="hidden" name="quiz_questions[]" value="{{ $quizQuestions }}">--}}

        <!-- Questions -->
        @foreach($quizQuestions as $quizQuestion)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Question {{ $loop->iteration }}: {{ $quizQuestion->question->name }}?</h5>
{{--                    <p class="card-text"></p>--}}
                    @php
                        $quizQuestionOptions = \Harishdurga\LaravelQuiz\Models\QuestionOption::where('question_id',$quizQuestion->question->id)->get();
                    @endphp
                    @foreach($quizQuestionOptions as $quizQuestionOption)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_id_[{{$quizQuestion->id}}][]" id="q1Option{{ $quizQuestionOption->id }}" value="{{ $quizQuestionOption->id }}">
                            <label class="form-check-label" for="q1Option{{ $quizQuestionOption->id }}">
                                {{ $quizQuestionOption->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="text-center">
            <button type="submit" class="btn btn-primary"  id=""  {{ !($quizAttemptCheck == NULL) ? 'disabled' : '' }}>Submit</button>
        </div>
    </form>



    <!-- Add more questions here -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

{{--<script>--}}
{{--    $('#submitBtn').click(function() {--}}
{{--        // Logic to calculate score and display results goes here--}}
{{--        alert('Quiz submitted!'); // Placeholder alert--}}
{{--    });--}}
{{--</script>--}}
</body>
</html>
