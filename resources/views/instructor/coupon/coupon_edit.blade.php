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
                        <li class="breadcrumb-item active" aria-current="page">Edit Coupon</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('instructor.add.coupon') }}" class="btn btn-primary px-5">Edit Coupon</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Category</h5>
                <form id="myForm" action="{{ route('instructor.update.coupon') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="coupon_id" value="{{ $coupon->id }}">

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Coupon Name</label>
                        <input type="text" name="coupon_name" class="form-control" id="input1" value="{{ $coupon->coupon_name }}">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="input2" class="form-label">Coupon Discount</label>
                        <input class="form-control" type="text" name="coupon_discount" value="{{ $coupon->coupon_discount }}">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="input2" class="form-label">Courses</label>
                        <select name="course_id" id="" class="form-select mb-3">
                            <option value="" selected>Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $coupon->course_id ? 'selected' : ''}}>{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="input2" class="form-label">Coupon Validity</label>
                        <input class="form-control" type="date" name="coupon_validity" value="{{ $coupon->coupon_validity }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Coupon</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection