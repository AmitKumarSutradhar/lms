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
                        <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.category') }}" class="btn btn-primary px-5">Add Course</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Course</h5>
                <form id="myForm" action="{{ route('store.course') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Course Name</label>
                        <input type="text" name="course_name" class="form-control" id="" placeholder="Category Name">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Course Title</label>
                        <input type="text" name="course_title" class="form-control" id="" placeholder="Category Name">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input2" class="form-label">Course Thumbnail</label>
                        <input class="form-control" type="file" id="image" name="course_image">
                        <img id="showImage"  src="{{ (!empty($profileData->photo) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg')) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="90" height="90">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Course Intro Video</label>
                        <input type="file" name="video" class="form-control" id="" placeholder="Intro Video" accept="video/mp4, video/webm">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Course Category Name</label>
                        <select name="category_id" class="form-select" id="">
                            <option selected="" disabled>-- Select Category --</option>
                            @foreach($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Course Sub Category Name</label>
                        <select name="subcategory_id" class="form-select" id="">
                            <option selected="" disabled>-- Select Category First --</option>
                        </select>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Course Certificate Available</label>
                        <select name="certificate" class="form-select" id="">
                            <option selected="" disabled>-- Select Option --</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Course Level</label>
                        <select name="label" class="form-select" id="">
                            <option selected="" disabled>-- Select Option --</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advance">Advance</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Course Selling Price</label>
                        <input type="text" name="selling_price" class="form-control" id="" placeholder="Category Name">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Course Discount Price</label>
                        <input type="text" name="discount_price" class="form-control" id="" placeholder="Category Name">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Duration</label>
                        <input type="text" name="duration" class="form-control" id="" placeholder="Course Resources">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Course Resources</label>
                        <input type="text" name="resources" class="form-control" id="" placeholder="Course Resources">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Course Prerequisites</label>
                        <textarea name="prerequisites" class="form-control" id="" cols="20" rows="10" style="width: 100%;"></textarea>
                    </div>


                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Course Description</label>
                        <textarea name="description" class="form-control" id="" cols="20" rows="10" style="width: 100%;"></textarea>
                    </div>

                    <h2>Course Goals</h2>
                    <!--   Goal Option  -->
                    <div class="row add_item">
                        <div class="col-md-10">
                            <div class="mb-3">
                                <label for="goals" class="form-label"> Goals </label>
                                <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals ">
                            </div>
                        </div>
                        <div class="form-group col-md-2" style="padding-top: 30px;">
                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                        </div>
                    </div> <!---end row-->
                    <!--   End Goal Option  -->

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bestseller" value="1" id="">
                                <label class="form-check-label" for="flexCheckDefault">Best Seller</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" value="1" id="">
                                <label class="form-check-label" for="flexCheckDefault">Featured</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="highestrated" value="1" id="">
                                <label class="form-check-label" for="flexCheckDefault">Highest Rated</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Add Course</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--========== Start of add multiple class with ajax ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">


                        <div class="form-group col-md-6">
                            <label for="goals">Goals</label>
                            <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Goals  ">
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!----For Section-------->
    <script type="text/javascript">
        $(document).ready(function(){
            var counter = 0;
            $(document).on("click",".addeventmore",function(){
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click",".removeeventmore",function(event){
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->

    <script type="text/javascript">

        $(document).ready(function(){
            $('select[name="category_id"]').on('change', function(){
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/"+category_id,
                        type: "GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="subcategory_id"]').html('');
                            var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });

    </script>


    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    course_name: {
                        required : true,
                    },
                    course_title: {
                        required : true,
                    },

                },
                messages :{
                    course_name: {
                        required : 'Please Enter Course Name',
                    },
                    course_title: {
                        required : 'Please enter course title',
                    },


                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
    </script>

@endsection
