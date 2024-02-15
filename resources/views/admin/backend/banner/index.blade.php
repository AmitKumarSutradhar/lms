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
                        <li class="breadcrumb-item active" aria-current="page">All Banner</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('banner.create') }}" class="btn btn-primary px-3">Add Banner</a>
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
                                <th>Banner Image</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ (!empty($item->image_url) ? url($item->image_url) : url('upload/no_image.jpg')) }}" style="width: 100px;" alt="">
                                </td>
                                <td>{{ $item->title_one }}</td>
                                <td>
                                    @if($item->banner_type == 1)
                                        <span class="">Slider</span>
                                    @else
                                        <span class="">Featured</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->is_active == 1)
                                        <span class="badge badge-pill bg-success">Active</span>
                                    @else
                                        <span class="badge badge-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('banner.edit',$item->id) }}" class="btn btn-info mx-2"><i class="bx bxs-edit"></i></a>
{{--                                    <a href="{{ route('banner.destroy',$item->id) }}" id="delete" class="btn btn-danger"><i class="bx bx-trash"></i></a>--}}
                                    <a href="{{ route('banner.destroy',$item->id) }}"  onclick="event.preventDefault(); document.getElementById('deleteBanner').submit()" id="delete" class="btn btn-danger"><i class="bx bx-trash"></i></a>
                                    <form action="{{  route('banner.destroy',$item->id) }}" method="post" id="deleteBanner">
                                        @method("DELETE")
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl No.</th>
                                <th>Banner Image</th>
                                <th>Title</th>
                                <th>Type</th>
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
