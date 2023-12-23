@extends('instructor.instructor_dashboard')

@section('body')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
{{--                    <a href="{{ route('add.course') }}" class="btn btn-primary px-5">Add Course</a>--}}
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
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderItem as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->payment->order_date }}</td>
                                <td>{{ $item->payment->invoice_no }}</td>
                                <td>{{ $item->payment->total_amount }}</td>
                                <td>{{ $item->payment->payment_type }}</td>
                                <td><span class="badge bg-success">{{ $item->payment->status }}</span></td>
                                <td>
                                    <a href="{{ route('instructor.order.details',$item->payment->id) }}" class="btn btn-info " title="Edit Course"><i class="lni lni-eye"></i></a>
                                    <a href="{{ route('delete.course',$item->id) }}" id="delete" class="btn btn-danger" title="Delete"><i class="lni lni-download"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl No.</th>
                            <th>Image</th>
                            <th>Course Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
