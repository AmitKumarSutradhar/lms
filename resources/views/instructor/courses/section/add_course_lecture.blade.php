@extends('instructor.instructor_dashboard')

@section('body')
    <div class="page-content">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mt-0">{{ $course->course_name }}</h5>
                                <p class="mb-0">{{ $course->course_title }}</p>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Section</button>
                        </div>
                    </div>
                </div>

{{--                Add Section and Lecture --}}
                @foreach($section as $key => $item)
                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body p-4 d-flex justify-content-between">
                                        <h6>{{ $item->section_title }}</h6>
                                        <div class="d-flex justify-content-between align-item-center">
                                            <a class="btn btn-primary" onclick="addLectureDiv({{ $course->id }}, {{ $item->id }}, 'lectureContainer{{ $key }}' )" id="addLectureBtn($key)">Add Lecture</a>
                                            @php
                                                $availableQuiz = \Harishdurga\LaravelQuiz\Models\Quiz::where('course_id',$course->id)->where('section_id',$item->id)->first();
                                            @endphp
                                            @if($availableQuiz)
                                                <span class="mx-1"><a class="btn btn-warning" href="{{ route('view.quiz',$availableQuiz->id) }}" id="addQuizBtn($key)">View Quiz</a></span>
                                            @else
                                                <span class="mx-1"><a class="btn btn-warning" onclick="addQuizDiv({{ $course->id }}, {{ $item->id }}, 'lectureContainer{{ $key }}' )" id="addQuizBtn($key)">Add Quiz</a></span>
                                            @endif
                                            <form action="{{ route('delete.section',['id' => $item->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger px-2 mx-1 ms-auto">Delete Section</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="courseHide" id="lectureContainer{{$key}}">
                                        <div class="container">
                                            @foreach($item->lectures as $lecture)
                                                <div class="lectureDiv mb-3 d-flex align-items-center justify-content-between">
                                                    <div class="">
                                                        <strong>{{ $loop->iteration .'. '.$lecture->lecture_title }}</strong>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a href="{{ route('edit.lecture',['id' => $lecture->id]) }}" class="btn btn-sm btn-primary ">Edit</a>
                                                        <a href="{{ route('delete.lecture',['id' => $lecture->id]) }}" class="btn btn-sm btn-danger mx-3" id="delete">Delete</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
{{--                End Add Section and Lecture --}}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('add.course.section') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <div class="modal-body">
                        <div class="col-md-12 form-group">
                            <label for="" class="form-label">Course Section</label>
                            <input type="text" name="section_title" class="form-control" id="" placeholder="Course Resources">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addLectureDiv(courseId, sectionId, containerId) {
            const lectureContainer = document.getElementById(containerId);
            const newLectureDiv = document.createElement('div');
            newLectureDiv.classList.add('lectureDiv','mb-3');

            newLectureDiv.innerHTML = `
                <div class="container">
                    <h6>Lecture Title</h6>
                    <input type="text" name="" id="" class="form-control" placeholder="Enter Lecture Title">
                    <textarea name="" id="" cols="30" rows="10" class="form-control mt-2" placeholder="Enter Lecture Content"></textarea>

                    <h6>Add Video Url</h6>
                    <input type="text" name="url" id="" class="form-control" placeholder="Enter Lecture Title">

                    <button class="btn btn-primary mt-3" onclick="saveLecture('${courseId}', '${sectionId}', '${containerId}')">Save Lecture</button>
                    <button class="btn btn-primary mt-3" onclick="hideLectureContainer('${containerId}')">Cancel</button>
                </div>
            `;

            lectureContainer.appendChild(newLectureDiv);
        }

        function hideLectureContainer(containerId) {
            const lectureContainer = document.getElementById(containerId);
            lectureContainer.style.display = 'none';
            location.reload();
        }
    </script>

    <script>
        function saveLecture(courseId, sectionId, containerId) {
            const lectureContainer = document.getElementById(containerId);
            const lectureTitle = lectureContainer.querySelector('input[type="text"]').value;
            const lectureContent = lectureContainer.querySelector('textarea').value;
            const lectureUrl = lectureContainer.querySelector('input[name="url"]').value;

            fetch('/save-lecture',{
                method: 'POST',
                headers: {
                    'Content-Type' : 'application/json',
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    course_id: courseId,
                    section_id: sectionId,
                    lecture_title: lectureTitle,
                    lecture_url: lectureUrl,
                    lec_content: lectureContent
                    })
            })
            .then(response => response.json())
            .then(data => {
                // console.log(data)

                lectureContainer.style.display = 'none';
                location.reload();

                // Start Message

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 6000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })

                }else{

                    Toast.fire({
                        type: 'error',
                        title: data.error,
                    })
                }

                // End Message

            })
            .catch(error => {
                console.error(error)
            })
        }
    </script>



{{--    Quiz Adding Functionality--}}

    <script>
        function addQuizDiv(courseId, sectionId, containerId) {
            const quizContainer = document.getElementById(containerId);
            const newQuizDiv = document.createElement('div');
            newQuizDiv.classList.add('quizDiv','mb-3');

            newQuizDiv.innerHTML = `
                <form action="{{ route('save.quiz') }}" method="post" class="container">
                @csrf
                    <h6>Quiz Title</h6>
                    <input type="hidden" name="course_id" value="${courseId}">
                    <input type="hidden" name="section_id" id="" value="${sectionId}">


                    <input type="text" name="name" id="" class="form-control my-1" placeholder="Enter Quiz">
                    <input type="text" name="total_marks" id="" class="form-control my-1" placeholder="Total Marks">
                    <input type="text" name="pass_marks" id="" class="form-control my-1" placeholder="Pass Marks">


<!--                    <button class="btn btn-primary mt-3" onclick="saveQuiz('${courseId}', '${sectionId}', '${containerId}')">Save Quiz</button>-->
                    <button type="submit" class="btn btn-primary mt-3">Save Quiz</button>
                    <button class="btn btn-primary mt-3" onclick="hideQuizContainer('${containerId}')">Cancel</button>
                </form>
            `;

            quizContainer.appendChild(newQuizDiv);
        }

        function hideQuizContainer(containerId) {
            const quizContainer = document.getElementById(containerId);
            quizContainer.style.display = 'none';
            location.reload();
        }
    </script>

@endsection
