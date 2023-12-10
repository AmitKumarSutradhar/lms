@extends('admin.admin_dashboard')

@section('body')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Course Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Profilep</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($course->course_image) }}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0">{{ $course->course_name }}</h5>
                            <p class="mb-0">{{ $course->course_title }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td><strong>Category</strong> </td>
                                            <td><strong>:</strong> </td>
                                            <td>{{ $course['category']['category_name'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sub Category</strong> </td>
                                            <td><strong>:</strong> </td>
                                            <td>{{ $course['subcategory']['subcategory_name'] }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Label </strong> </td>
                                            <td><strong>:</strong> </td>
                                            <td>{{ $course->label }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Duration </strong> </td>
                                            <td><strong>:</strong> </td>
                                            <td>{{ $course->duration }} hrs</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Video </strong> </td>
                                            <td><strong>:</strong> </td>
                                            <td>
                                                <video width="300" height="200" controls>
                                                    <source src="{{ asset($course->video) }}" type="video/mp4">
                                                </video>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <td><strong>Resources</strong> </td>
                                        <td><strong>:</strong> </td>
                                        <td>{{ $course->resources }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Selling Price</strong> </td>
                                        <td><strong>:</strong> </td>
                                        <td>{{ $course->selling_price }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Discount Price </strong> </td>
                                        <td><strong>:</strong> </td>
                                        <td>{{ $course->discount_price }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status </strong> </td>
                                        <td><strong>:</strong> </td>
                                        <td>
                                            @if($course->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
