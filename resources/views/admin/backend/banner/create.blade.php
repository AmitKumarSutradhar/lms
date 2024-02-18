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
                        <li class="breadcrumb-item active" aria-current="page">Update Site Setting</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    {{--                    <a href="{{ route('add.category') }}" class="btn btn-primary px-5">Site Setting</a>--}}
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Banner Information</h5>
                <form id="myForm" action="{{ route('banner.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
{{--                    <input type="hidden" name="id" value="{{ $site->id }}">--}}
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Banner Title One</label>
                        <input type="text" name="title_one" class="form-control" id="input1">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Banner Title Two</label>
                        <input type="text" name="title_two" class="form-control" id="input1">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Button One Text</label>
                        <input type="text" name="button_one_link" class="form-control" id="input1">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Button One Link</label>
                        <input type="text" name="button_one_text" class="form-control" id="input1">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Button Two Text</label>
                        <input type="text" name="button_two_text" class="form-control" id="input1" >
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Button Two Link</label>
                        <input type="text" name="button_two_link" class="form-control" id="input1" >
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Button Banner Position</label>
                        <select name="position" id="" class="form-select mb-3 @error('position') is-invalid @enderror">
                            <option value="" selected disabled>-- Select Type --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        @error('position')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="input1" class="form-label">Banner Status</label>
                        <select name="is_active" id="" class="form-select mb-3">
                            <option value="" selected disabled>-- Select Type --</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-12 form-group mx-auto">
                        <label for="input2" class="form-label">Banner Type</label>
                        <select name="banner_type" id="" class="form-select mb-3">
                            <option value="" selected disabled>-- Select Type --</option>
                            <option value="1">Header Slider Banner</option>
                            <option value="2">Featured Section Banner</option>
                        </select>
                    </div>

                    <div class="col-md-12 form-group mx-auto">
                        <label for="input2" class="form-label">Banner Photo</label>
                        <input class="form-control" type="file" id="image" name="image_url">
{{--                        <img id="showImage"  src="{{ (!empty($site->logo) ? url($site->logo) : url('upload/no_image.jpg')) }}" alt="Site Logo" class="rounded-circle p-1 bg-primary" width="100">--}}
                        <img id="showImage"  src="{{ (!empty($site->logo) ? url($site->logo) : url('upload/no_image.jpg')) }}" alt="Site Logo" class="p-1 my-3 mx-auto" style="width: 40%; background-size: cover;">
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
