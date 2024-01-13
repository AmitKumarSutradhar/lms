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
                        <li class="breadcrumb-item active" aria-current="page">All Instructor</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
{{--                    <a href="{{ route('add.category') }}" class="btn btn-primary px-5">Add Category</a>--}}
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
                            <th>User Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($instructor as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ (!empty($item->photo) ? url('upload/instructor_images/'.$item->photo) : url('upload/no_image.jpg')) }}" style="width: 80px;" alt="">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    @if($item->UserOnline())
                                        <span class="badge badge-pill bg-success">Active</span>
                                    @else
                                        <span class="badge badge-pill bg-danger">{{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('edit.category',$item->id) }}" class="btn btn-info"><i class="bx bxs-edit"></i></a>
                                    <a href="{{ route('delete.category',$item->id) }}" id="delete" class="btn btn-danger"><i class="bx bx-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl No.</th>
                            <th>User Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
