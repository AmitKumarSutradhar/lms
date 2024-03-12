@extends('frontend.dashboard.user_dashboard')
@section('body')
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp
    <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
        <div class="media media-card align-items-center">
            <div class="media-img media--img media-img-md rounded-full">
                <img src="{{ (!empty($profileData->photo) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg')) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
            </div>
            <div class="media-body">
                <h2 class="section__title fs-30">Howdy, {{ $profileData->name  }}</h2>
                <div class="rating-wrap d-flex align-items-center pt-2">
                    <div class="review-stars">
                        <span class="rating-number">4.4</span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star-o"></span>
                    </div>
                    <span class="rating-total pl-1">({{ $reviews->count() }})</span>
                </div><!-- end rating-wrap -->
            </div><!-- end media-body -->
        </div><!-- end media -->
    </div><!-- end breadcrumb-content -->
    <div class="section-block mb-5"></div>
    <div class="dashboard-heading mb-5">
        <h3 class="fs-22 font-weight-semi-bold">Reviews</h3>
    </div>
    <div class="row">
        @foreach($reviews as $item)
            <div class="col-lg-6 responsive-column-half">
            <div class="card card-item dashboard-info-card">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-element flex-shrink-0 bg-1 text-white">
                        <img src="{{ $item->course->course_image }}" alt="" class="rounded--pill" style=" width: 80px; height: 80px">
                    </div>
                    <div class="pl-4">
                        <h5 class="card-title pt-2">{{ Str::limit($item->course->course_title, 60) }}</h5>
                        <div class="review-stars">
                            @if($item->rating == NULL)
                                <span class="la la-star-0"></span>
                                <span class="la la-star-0"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                            @elseif($item->rating == 1)
                                <span class="la la-star"></span>
                                <span class="la la-star-0"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                            @elseif($item->rating == 2)
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                            @elseif($item->rating == 3)
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                            @elseif($item->rating == 4)
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star-o"></span>
                            @elseif($item->rating == 5)
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                            @endif
                        </div>
                        <p class="text-gray">{{ $item->comment }}</p>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col-lg-4 -->
        @endforeach
    </div><!-- end row -->
@endsection
