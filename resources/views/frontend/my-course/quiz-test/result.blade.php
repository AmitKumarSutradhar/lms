<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-content-center">
        <div class=""></div>
        <h1 class="text-center mb-4">{{ $quiz->name }}</h1>
        <div class="">
{{--            <h4>Total Score: {{ $quizAttemptScore . '/' .$quiz->total_marks }}</h4>--}}
        </div>
    </div>


    <div>
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

    <!-- Questions -->
        @foreach($quizAttemptAnswers as $quizAttemptAnswer)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Question {{ $loop->iteration }}: {{ $quizAttemptAnswer->quiz_question->question->name  }}?</h5>


{{--                    <p>{{ $quizAttemptAnswer->quiz_question->marks  }}</p>--}}

                    @php
                        $quizQuestionOptions = \Harishdurga\LaravelQuiz\Models\QuestionOption::where('question_id', $quizAttemptAnswer->quiz_question->question->id)->get();

                    @endphp

                    @foreach($quizQuestionOptions as $quizQuestionOption)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_id_[{{$quizAttemptAnswer->quiz_question->question->id}}][]" id="q1Option{{ $quizQuestionOption->id }}" value="{{ $quizQuestionOption->id }}" {{ $quizAttemptAnswer->question_option_id == $quizQuestionOption->id ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="q1Option{{ $quizQuestionOption->id }}">
                                {{ $quizQuestionOption->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>



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
