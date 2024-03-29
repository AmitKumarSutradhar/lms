@extends('admin.admin_dashboard')

@section('body')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            {{--            <div class="breadcrumb-title pe-3">Category</div>--}}
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Blog Post</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.blog.post.add') }}" class="btn btn-primary px-5">Update Blog Post</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Category</h5>
                <form id="myForm" action="{{ route('blog.post.update') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $post->id }}">

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Category Name</label>
                        <select name="blog_categories_id" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select menu</option>
                            @foreach($blogCat as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $post->blog_categories_id ? 'selected' : '' }}>{{ $item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Post Title</label>
                        <input type="text" name="post_title" class="form-control" id="input1" value="{{ $post->post_title }}">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Description</label>
{{--                        <textarea name="long_description" class="form-control" id="myeditorinstance" cols="10" rows="10" style="width: 100%;">{!! $post->long_description !!}</textarea>--}}
                        <textarea name="long_description" id="" cols="10" rows="10" style="width: 100%;">{{ $post->long_description }}</textarea>
                    </div>

                    <div class="col-md-12 form-group">
                        <div class="mb-3">
                            <label class="form-label">Tags</label>
                            <input type="text" class="form-control visually-hidden" data-role="tagsinput" name="post_tags" value="{{ $post->post_tags }}">
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input2" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="post_image">
                        <img id="showImage"  src="{{ asset($post->post_image) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Submit Post</button>
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
