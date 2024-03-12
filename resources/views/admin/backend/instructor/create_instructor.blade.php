@extends('admin.admin_dashboard')

@section('body')
    <style>
        .large-checkbox{
            transform: scale(1.5);
        }
    </style>
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
                        <li class="breadcrumb-item active" aria-current="page">Create Instructor</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">

            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card-body">
            <form action="{{ route('admin.instructor.store') }}" method="post" class="row">
                @csrf
                <div class="input-box col-lg-6 mb-3">
                    <label class="label-text">Name</label>
                    <div class="form-group">
                        <input class="form-control  @error('name') is-invalid @enderror" type="text" name="name" placeholder="e.g. Alex">
                        <span class="la la-user input-icon"></span>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6 mb-3">
                    <label class="label-text">User Name</label>
                    <div class="form-group">
                        <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" placeholder="e.g. Alex">
                        <span class="la la-user input-icon"></span>
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12 mb-3">
                    <label class="label-text">Phone Number</label>
                    <div class="form-group">
                        <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="e.g. +88 0123456789">
                        <span class="la la-phone input-icon"></span>
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6 mb-3">
                    <label class="label-text">Email Address</label>
                    <div class="form-group">
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="e.g. Alex">
                        <span class="la la-user input-icon"></span>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6 mb-3">
                    <label class="label-text">Password</label>
                    <div class="form-group">
                        <input class="form-control " type="password" name="password" placeholder="e.g. Alex">
                        <span class="la la-password input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12 mb-3">
                    <label class="label-text">Address</label>
                    <div class="form-group">
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" name="" id="" cols="30" rows="10" style="width: 100%;"></textarea>
                        <span class="la la-address-book input-icon"></span>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="btn-box col-lg-12 mt-3">
                    <button class="btn btn-primary" type="submit">Add Instructor <i class="la la-arrow-right icon ml-1"></i></button>
                </div><!-- end btn-box -->
            </form>
        </div><!-- end card-body -->
    </div>
@endsection
