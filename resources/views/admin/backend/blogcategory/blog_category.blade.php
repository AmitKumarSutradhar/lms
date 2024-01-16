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
                        <li class="breadcrumb-item active" aria-current="page">All Blog Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogCategory">Add Blog Category</button>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->category_name }}</td>
                                <td>{{ $item->category_slug }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editBlogCategory" id="{{ $item->id }}" onclick="editBlogCategory(this.id)"><i class="bx bxs-edit"></i></button>
                                    <a href="{{ route('blog.category.delete',$item->id) }}" id="delete" class="btn btn-danger"><i class="bx bxs-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl No.</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addBlogCategory" tabindex="-1" aria-labelledby="addBlogCategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Blog Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('blog.category.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                            <div class="col-md-12 form-group">
                                <label for="input1" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="input1" placeholder="Blog Category Name">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Blog Category</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Edit Blog Category Modal -->
    <div class="modal fade" id="editBlogCategory" tabindex="-1" aria-labelledby="addBlogCategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Blog Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('blog.category.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="editCategoryId" id="editCategoryId">
                    <div class="modal-body">
                            <div class="col-md-12 form-group">
                                <label for="input1" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="editCategory" placeholder="Blog Category Name">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function editBlogCategory(id) {
            $.ajax({
                type: 'GET',
                url: '/edit/blog-category/'+id,
                dataType : 'json',

                success:function(data) {
                    // console.log(data);
                    $('#editCategory').val(data.category_name);
                    $('#editCategoryId').val(data.id);
                }
            })
        }
    </script>
@endsection
