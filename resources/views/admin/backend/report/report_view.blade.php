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
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.category') }}" class="btn btn-primary px-5">Report</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4">
                        <form id="searchByDate" action="{{ route('search.by.date') }}" method="post" class="row g-3">
                            @csrf
                            <div class="col-md-12 form-group">
                                <label for="searchbydateinp" class="form-label">Search by date</label>
                                <input type="date" name="date" class="form-control" id="searchbydateinp" placeholder="Coupon Name">
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-sm btn-primary ">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form action="{{ route('search.by.month') }}" method="post" class="row g-3">
                            @csrf
                            <div class="col-md-12 form-group">
                                <label for="searchbymonth" class="form-label">Search by month</label>
                                <select name="month" id="searchbymonth" class="form-select mb-3">
                                    <option value="January" >January</option>
                                    <option value="February" >February</option>
                                    <option value="March" >March</option>
                                    <option value="April" >April</option>
                                    <option value="May" >May</option>
                                    <option value="June" >June</option>
                                    <option value="July" >July</option>
                                    <option value="August" >August</option>
                                    <option value="September">September</option>
                                    <option value="October" >October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="searchbydate" class="form-label">Search by year</label>
                                <select name="year_name" id="" class="form-select mb-3">
                                    <option value="2024"> 2024 </option>
                                    <option value="2023"> 2023 </option>
                                    <option value="2022">2022 </option>
                                    <option value="2021">2021 </option>
                                    <option value="2020">2020 </option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-sm btn-primary ">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form id="" action="{{ route('search.by.year') }}" method="post" class="row g-3">
                            @csrf
                            <div class="col-md-12 form-group">
                                <label for="searchbydate" class="form-label">Search by year</label>
                                <select name="year" id="" class="form-select mb-3">
                                    <option value="2024"> 2024 </option>
                                    <option value="2023"> 2023 </option>
                                    <option value="2022">2022 </option>
                                    <option value="2021">2021 </option>
                                    <option value="2020">2020 </option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-sm btn-primary ">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
