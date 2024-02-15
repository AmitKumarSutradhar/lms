@extends('instructor.instructor_dashboard')

@section('body')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Quiz</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
{{--                        <li class="breadcrumb-item active" aria-current="page">Edit Lecture</li>--}}
                    </ol>
                </nav>
            </div>
{{--            <div class="ms-auto">--}}
{{--                <div class="btn-group">--}}
{{--                    <a href="{{ route('add.course.lecture',['id' => $courseLecture->course_id]) }}" class="btn btn-primary px-5">Back to Course</a>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Question</h5>
                <form id="myForm" action="{{ route('add.quiz.question') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Question</label>
                        <input type="text" name="name" class="form-control" id="input1"  placeholder="Question">
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Add Question</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">All Question</h5>
                <hr>
                <div class="row g-3">
                    @foreach($questions as $key => $question)
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center justify-content-between gap-3">
                                <div class="">
                                    <h5>
                                        <span>{{ $loop->iteration }}</span> . {{ $question->name }} .
                                        <span class="badge badge-pill bg-success text-white">{{ $question->is_active == 1 ? 'Active' : 'Assign mark to active' }}</span>
                                    </h5>

                                </div>

                                <div class="">
                                    <!--Assign mark to question modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignmark{{$question->id}}">Assign Mark</button>

                                    <!--Add option to question modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOption{{$question->id}}">Add Option</button>
                                </div>

                                <!-- Add option to questionModal -->
                                <div class="modal fade" id="assignmark{{$question->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Assign mark to{{ $question->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="{{ route('quiz.question.assign.mark') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                                                @csrf

                                                <div class="modal-body">
                                                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                                    <div class="col-md-10 mx-auto mb-2">
                                                        <label for="input1" class="form-label">Mark</label>
                                                        <input type="text" name="marks" class="form-control" id=""  placeholder="Question mark">
                                                    </div>
{{--                                                    <div class="col-md-10 mx-auto">--}}
{{--                                                        <label for="" class="form-label">Order</label>--}}
{{--                                                        <select name="is_correct" class="form-select" id="">--}}
{{--                                                            <option selected disabled> -- Select Option -- </option>--}}
{{--                                                            <option value="1">True</option>--}}
{{--                                                            <option value="0">False</option>--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Add Option</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>


                                <!-- Add option to questionModal -->
                                <div class="modal fade" id="addOption{{$question->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add question to{{ $question->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="{{ route('quiz.answer.option.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                                    <div class="col-md-10 mx-auto mb-2">
                                                        <label for="input1" class="form-label">Option title</label>
                                                        <input type="text" name="name" class="form-control" id=""  placeholder="Option title">
                                                    </div>
                                                    <div class="col-md-10 mx-auto">
                                                        <label for="" class="form-label">Answer</label>
                                                        <select name="is_correct" class="form-select" id="">
                                                            <option selected disabled> -- Select Option -- </option>
                                                            <option value="1">True</option>
                                                            <option value="0">False</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Add Option</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            @php
                                $quizQuestionOptions = \Harishdurga\LaravelQuiz\Models\QuestionOption::where('question_id',$question->id)->get();
                            @endphp

                            <div class="ms-5">
                                @foreach($quizQuestionOptions as $quizQuestionOption)
                                    <p><span>{{ $loop->iteration }}</span> . {{ $quizQuestionOption->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

@endsection


