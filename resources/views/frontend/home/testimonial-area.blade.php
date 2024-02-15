@php
    $reviews = \App\Models\Review::where('status',1)->latest()->limit(5)->get();
@endphp
<section class="testimonial-area section-padding">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">Testimonials</h5>
            <h2 class="section__title">Student's Feedback</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
    </div><!-- end container -->
    <div class="container-fluid">
        <div class="testimonial-carousel owl-action-styled">
            <div class="card card-item">
                <div class="card-body">
                    <div class="media media-card align-items-center pb-3">
                        <div class="media-img avatar-md">
                            <img src="{{ asset('/') }}frontend/images/small-avatar-1.jpg" alt="Testimonial avatar" class="rounded-full">
                        </div>
                        <div class="media-body">
                            <h5>Kevin Martin</h5>
                            <div class="d-flex align-items-center pt-1">
                                <span class="lh-18 pr-2">Student</span>
                                <div class="review-stars">
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                </div>
                            </div>
                        </div>
                    </div><!-- end media -->
                    <p class="card-text">
                        My children and I LOVE Aduca! The courses are fantastic and the
                        instructors are so fun and knowledgeable.
                        I only wish we found it sooner.
                    </p>
                </div><!-- end card-body -->
            </div><!-- end card -->
            <div class="card card-item">
                <div class="card-body">
                    <div class="media media-card align-items-center pb-3">
                        <div class="media-img avatar-md">
                            <img src="{{ asset('/') }}frontend/images/small-avatar-2.jpg" alt="Testimonial avatar" class="rounded-full">
                        </div>
                        <div class="media-body">
                            <h5>Oliver Beddows</h5>
                            <div class="d-flex align-items-center pt-1">
                                <span class="lh-18 pr-2">Student</span>
                                <div class="review-stars">
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                </div>
                            </div>
                        </div>
                    </div><!-- end media -->
                    <p class="card-text">
                        No matter what you want to learn, you’ll find an
                        amazing selection of courses here.
                        The instructors are so knowledgable while
                        being fun and interesting. Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Ad blanditiis consectetur
                    </p>
                </div><!-- end card-body -->
            </div><!-- end card -->
            <div class="card card-item">
                <div class="card-body">
                    <div class="media media-card align-items-center pb-3">
                        <div class="media-img avatar-md">
                            <img src="{{ asset('/') }}frontend/images/small-avatar-3.jpg" alt="Testimonial avatar" class="rounded-full">
                        </div>
                        <div class="media-body">
                            <h5>Jackob Hallac</h5>
                            <div class="d-flex align-items-center pt-1">
                                <span class="lh-18 pr-2">Student</span>
                                <div class="review-stars">
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                </div>
                            </div>
                        </div>
                    </div><!-- end media -->
                    <p class="card-text">
                        I really recommend this site to all my friends and anyone who’s willing to
                        learn real skills. This platform gives
                        you the opportunity to learn from experts at a convenient time.
                    </p>
                </div><!-- end card-body -->
            </div><!-- end card -->
            <div class="card card-item">
                <div class="card-body">
                    <div class="media media-card align-items-center pb-3">
                        <div class="media-img avatar-md">
                            <img src="{{ asset('/') }}frontend/images/small-avatar-4.jpg" alt="Testimonial avatar" class="rounded-full">
                        </div>
                        <div class="media-body">
                            <h5>Lubic Duble</h5>
                            <div class="d-flex align-items-center pt-1">
                                <span class="lh-18 pr-2">Student</span>
                                <div class="review-stars">
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                </div>
                            </div>
                        </div>
                    </div><!-- end media -->
                    <p class="card-text">
                        Thank you Aduca! You've renewed my passion for
                        learning and my dream of becoming a web developer.
                    </p>
                </div><!-- end card-body -->
            </div><!-- end card -->
            @foreach($reviews as $item)
                <div class="card card-item">
                    <div class="card-body">
                        <div class="media media-card align-items-center pb-3">
                            <div class="media-img avatar-md">
                                <img src="{{ (!empty($item->user->photo) ? url('upload/user_images/'.$item->user->photo) : url('upload/no_image.jpg')) }}" alt="Testimonial avatar" class="rounded-full">
                            </div>
                            <div class="media-body">
                                <h5>{{ $item->user->name }}</h5>
                                <div class="d-flex align-items-center pt-1">
                                    <span class="lh-18 pr-2">Student</span>
                                    <div class="review-stars">
                                        @if($item->rating == 0)
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif($item->rating == 1)
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
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
                                </div>
                            </div>
                        </div><!-- end media -->
                        <p class="card-text">
                            {{ $item->comment }}
                        </p>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            @endforeach
        </div><!-- end testimonial-carousel -->
    </div><!-- container-fluid -->
</section>
