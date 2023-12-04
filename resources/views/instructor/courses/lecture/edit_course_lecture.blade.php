@extends('instructor.instructor_dashboard')

@section('body')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            {{--            <div class="breadcrumb-title pe-3">Category</div>--}}
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Lecture</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.course.lecture',['id' => $courseLecture->course_id]) }}" class="btn btn-primary px-5">Back to Course</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Category</h5>
                <form id="myForm" action="{{ route('update.course.lecture') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $courseLecture->id }}">
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Lecture Title</label>
                        <input type="text" name="lecture_title" class="form-control" id="input1" value="{{ $courseLecture->lecture_title }}" placeholder="Category Name">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Video URL</label>
                        <input type="text" name="url" class="form-control" id="input1" value="{{ $courseLecture->url }}" placeholder="Category Name">
                    </div>


                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Video URL</label>
                        <textarea name="lec_content" id=""class="form-control" style="width: 100%;">{{ $courseLecture->content }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Update Lecture</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
