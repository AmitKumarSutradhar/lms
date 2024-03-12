@extends('instructor.instructor_dashboard')

@section('body')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Order Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <h3>Payment Details</h3>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <th><b>Info</b></th>
                                    <th><b>Description</b></th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $payment->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $payment->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $payment->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $payment->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Type</td>
                                        <td>{{ $payment->cash_delivery }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <th><b>Info</b></th>
                                    <th><b>Description</b></th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td>${{ $payment->total_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Type</td>
                                        <td>{{ $payment->payment_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Invoice No</td>
                                        <td>{{ $payment->invoice_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Date</td>
                                        <td>{{ $payment->order_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Status</td>
                                        <td>
                                            @if($payment->status == 'pending')
                                                <a href="{{ route('pending-confirm',$payment->id) }}" class="btn btn-block btn-success" id="confirm">Confirm Order</a>
                                            @elseif($payment->status == 'confirm')
                                                <a href="javascript:" class="btn btn-sm btn-success">Confirmed</a>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3">
                                    <div class="table-responsive">
                                        <table class="table" style="font-weight: 600;">
                                            <tbody>
                                            <tr>
                                                <td class="col-md-1">
                                                    <label for="">Image</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <label for="">Course Name</label>
                                                </td>
{{--                                                <td class="col-md-2">--}}
{{--                                                    <label for="">Category</label>--}}
{{--                                                </td>--}}
                                                <td class="col-md-2">
                                                    <label for="">Instructor</label>
                                                </td>
                                                <td class="col-md-2">
                                                    <label for="">Price</label>
                                                </td>
                                            </tr>

                                            @php
                                                $totalPrice = 0;
                                            @endphp

                                            @foreach($orderItem as $item)
                                                <tr>
                                                    <td class="col-md-1">
                                                        <label><img src="{{ asset($item->course->course_image) }}" alt="" style="width: 50px;height: 50px;"></label>
                                                    </td>
                                                    <td class="col-md-1">
                                                        <label>{{ $item->course->course_name }}</label>
                                                    </td>
{{--                                                    <td class="col-md-1">--}}
{{--                                                        <label>{{ $item->category->category_name }}</label>--}}
{{--                                                    </td>--}}
                                                    <td class="col-md-1">
                                                        <label>{{ $item->instructor->name }}</label>
                                                    </td>
                                                    <td class="col-md-1">
                                                        <label>{{ $item->price }}</label>
                                                    </td>
                                                </tr>

                                                @php
                                                    $totalPrice += $item->price;
                                                @endphp
                                            @endforeach

                                            <tr>
                                                <td colspan="4"></td>
                                                <td class="col-md-3">
                                                    <strong>Total Price : {{ $totalPrice }} </strong>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
