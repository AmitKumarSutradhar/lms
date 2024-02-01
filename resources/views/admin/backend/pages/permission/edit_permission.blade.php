@extends('admin.admin_dashboard')

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
                        <li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.permission') }}" class="btn btn-primary px-2"><i class="bx bx-arrow-back"></i>Back</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Edit Permission</h5>
                <form id="myForm" action="{{ route('update.permission') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $permission->id }}">

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Permission Name</label>
                        <input type="text" name="name" value="{{ $permission->name }}" class="form-control" id="input1">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Permission Name</label>
                        <select name="group_name" class="form-select" id="input39">
                            <option selected="" disabled>-- Select Category --</option>
{{--                            @foreach($category as $item)--}}
                                <option value="Category" {{ $permission->group_name == 'Category' ? 'selected' : '' }}>Category</option>
                                <option value="Instructor" {{ $permission->group_name == 'Instructor' ? 'selected' : '' }}>Instructor</option>
                                <option value="Coupon" {{ $permission->group_name == 'Coupon' ? 'selected' : '' }}>Coupon</option>
                                <option value="Settings" {{ $permission->group_name == 'Settings' ? 'selected' : '' }}>Settings</option>
                                <option value="Order" {{ $permission->group_name == 'Order' ? 'selected' : '' }}>Order</option>
                                <option value="Report" {{ $permission->group_name == 'Report' ? 'selected' : '' }}>Report</option>
                                <option value="Review" {{ $permission->group_name == 'Review' ? 'selected' : '' }}>Review</option>
                                <option value="All User" {{ $permission->group_name == 'All User' ? 'selected' : '' }}>All User</option>
                                <option value="Blog" {{ $permission->group_name == 'Blog' ? 'selected' : '' }}>Blog</option>
{{--                            @endforeach--}}
                        </select>
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Update Permission</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    subcategory_name: {
                        required : true,
                    },
                    category_id: {
                        required : true,
                    },

                },
                messages :{
                    subcategory_name: {
                        required : 'Please Enter Sub Category Name',
                    },
                    category_id: {
                        required : 'Please Select Category',
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

@endsection