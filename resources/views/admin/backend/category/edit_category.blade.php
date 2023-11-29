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
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.category') }}" class="btn btn-primary px-5">Edit Category</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Edit Category</h5>
                <form id="myForm" action="{{ route('update.category',$category->id) }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $category->id }}">
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="input1" value="{{ $category->category_name }}" placeholder="Category Name">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="input2" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <img id="showImage"  src="{{ asset($category->image) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110" height="110">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>
                </form>
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
