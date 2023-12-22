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
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.category') }}" class="btn btn-primary px-5">SMTP Setting</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Edit Category</h5>
                <form id="myForm" action="{{ route('smtp.update') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $smtp->id }}">
                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Mailer</label>
                        <input type="text" name="mailer" class="form-control" id="input1" value="{{ $smtp->mailer }}" placeholder="Category Name">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Host</label>
                        <input type="text" name="host" class="form-control" id="input1" value="{{ $smtp->host }}" placeholder="Category Name">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Port</label>
                        <input type="text" name="port" class="form-control" id="input1" value="{{ $smtp->port }}" placeholder="Category Name">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="input1" value="{{ $smtp->username }}" placeholder="Category Name">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Password</label>
                        <input type="text" name="password" class="form-control" id="input1" value="{{ $smtp->password }}" placeholder="Category Name">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Encryption</label>
                        <input type="text" name="encryption" class="form-control" id="input1" value="{{ $smtp->encryption }}" placeholder="Category Name">
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="input1" class="form-label">Form Address</label>
                        <input type="text" name="from_address" class="form-control" id="input1" value="{{ $smtp->from_address }}" placeholder="Category Name">
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
