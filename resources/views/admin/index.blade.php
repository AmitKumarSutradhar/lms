@php
  $orders = \App\Models\Order::all();
  $student = \App\Models\User::where('role','user')->get();
@endphp
@extends('admin.admin_dashboard')

@section('body')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Orders</p>
                                <h4 class="my-1 text-info">{{ $orders->count() }}</h4>
                                <p class="mb-0 font-13">+2.5% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Revenue</p>
                                <h4 class="my-1 text-danger">${{ $orders->sum('price') }}</h4>
                                <p class="mb-0 font-13">+5.4% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Bounce Rate</p>
                                <h4 class="my-1 text-success">34.6%</h4>
                                <p class="mb-0 font-13">-4.5% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Learners</p>
                                <h4 class="my-1 text-warning">{{ $student->count() }}</h4>
                                <p class="mb-0 font-13">+8.4% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

{{--        <div class="row">--}}
{{--            <div class="col-12 col-lg-12 d-flex">--}}
{{--                <div class="card radius-10 w-100">--}}
{{--                    <div class="card-header">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div>--}}
{{--                                <h6 class="mb-0">Sales Overview</h6>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown ms-auto">--}}
{{--                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu">--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Action</a>--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <hr class="dropdown-divider">--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">--}}
{{--                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #14abef"></i>Sales</span>--}}
{{--                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Visits</span>--}}
{{--                        </div>--}}
{{--                        <div class="chart-container-1">--}}
{{--                            <canvas id="chart1"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">--}}
{{--                        <div class="col">--}}
{{--                            <div class="p-3">--}}
{{--                                <h5 class="mb-0">24.15M</h5>--}}
{{--                                <small class="mb-0">Overall Visitor <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="p-3">--}}
{{--                                <h5 class="mb-0">12:38</h5>--}}
{{--                                <small class="mb-0">Visitor Duration <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="p-3">--}}
{{--                                <h5 class="mb-0">639.82</h5>--}}
{{--                                <small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div><!--end row-->--}}

        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Recent Orders</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>Course</th>
                            <th>Photo</th>
                            <th>Order ID</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->course_title }}</td>
                                    <td><img src="{{ asset(!empty($order->course->photo) ? url($order->course->photo) : url('upload/no_image.jpg')) }}" class="product-img-2" alt="product img"></td>
{{--                                    <td><img src="{{ asset('/') }}backend/assets/images/products/01.png" class="product-img-2" alt="product img"></td>--}}
                                    <td>#9405822</td>
                                    <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
                                    <td>${{ $order->price }}.00</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td>
{{--                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>--}}
{{--                                    <td>--}}
{{--                                        <div class="progress" style="height: 6px;">--}}
{{--                                            <div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
@endsection
