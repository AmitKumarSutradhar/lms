@extends('admin.admin_dashboard')

@section('body')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Roles by permission</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    {{--                    <a href="{{ route('import.permission') }}" class="btn btn-inverse-warning">Import</a>--}}
                    {{--                    <a href="{{ route('export.permission') }}" class="btn btn-inverse-primary mx-3">Export</a>--}}
                    <a href="{{ route('assign.permission') }}" class="btn btn-primary">Assign permission to role</a>
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
                            <th>Roles Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @foreach($item->permissions as $perm)
                                       @if($perm->name)
                                            <span class="badge bg-success">{{ $perm->name }}</span>
                                        @else
                                            <span class="badge bg-success">N/A</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('edit.assigned.permission',$item->id) }}" class="btn btn-info"><i class="bx bxs-edit"></i></a>
                                    <a href="{{ route('delete.assigned.permission',$item->id) }}" id="delete" class="btn btn-danger"><i class="bx bxs-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl No.</th>
                            <th>Roles Name</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection