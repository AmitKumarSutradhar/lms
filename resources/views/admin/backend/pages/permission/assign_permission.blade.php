@extends('admin.admin_dashboard')

@section('body')
    <style>
        .form-check-label{
            text-transform: capitalize;
        }
    </style>
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
                        <li class="breadcrumb-item active" aria-current="page">Assign Permission for role</li>
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
                <h5 class="mb-4">Assign Permission</h5>
                <form id="myForm" action="{{ route('assign.permission.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12 form-group">
                        <label for="input39" class="form-label">Role Name</label>
                        <select name="role_id" class="form-select" id="input39">
                            <option selected=""  disabled>-- Select Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckMain">
                        <label class="form-check-label" for="flexCheckMain">Permission All </label>
                    </div>

                    <hr>

                    @foreach($permission_groups as $group)
                        <div class="row px-0 mx-0">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">{{ $group->group_name }}</label>
                                </div>
                            </div>

                            <div class="col-md-9">
                                @php
                                    $permissions = \App\Models\User::getPermissionByGroupName($group->group_name);
                                @endphp

                                @foreach($permissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="CheckDefault{{ $permission->id }}">
                                        <label class="form-check-label" for="CheckDefault{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Add Permission</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#flexCheckMain').click(function(){
            if ($(this).is(':checked')) {
                $('input[ type=checkbox]').prop('checked',true)
            }else{
                $('input[ type=checkbox]').prop('checked',false)
            }
        });
    </script>

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
