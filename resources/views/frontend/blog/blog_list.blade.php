@extends('frontend.master')

@section('body')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">All Blog</h2>
                </div>
                <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="index.html">Home</a></li>
                    <li>Blogs</li>
                </ul>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!-- ================================
           START BLOG AREA
    ================================= -->
    <section class="blog-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <div class="row">
                        @foreach($blogs as $item)
                            <div class="col-lg-6">
                                <div class="card card-item">
                                    <div class="card-image">
                                        <a href="blog-single.html" class="d-block">
                                            <img class="card-img-top lazy" src="{{ asset($item->post_image) }}" data-src="images/img8.jpg" alt="Card image cap">
                                        </a>
                                        <div class="course-badge-labels">
                                            <div class="course-badge">{{ $item->created_at->format('M d Y') }}</div>
                                        </div>
                                    </div><!-- end card-image -->
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{  url('blog-details/'.$item->post_slug)  }}">{{ $item->post_title }}</a></h5>
                                        <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                                            <li class="d-flex align-items-center">By<a href="#">Admin</a></li>
                                            <li class="d-flex align-items-center"><a href="#">4 Comments</a></li>
                                            <li class="d-flex align-items-center"><a href="#">130 Likes</a></li>
                                        </ul>
                                        <div class="d-flex justify-content-between align-items-center pt-3">
                                            <a href="{{  url('blog-details/'.$item->post_slug)  }}" class="btn theme-btn theme-btn-sm theme-btn-white">Read More <i class="la la-arrow-right icon ml-1"></i></a>
                                            <div class="share-wrap">
                                                <ul class="social-icons social-icons-styled">
                                                    <li class="mr-0"><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                                    <li class="mr-0"><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                                    <li class="mr-0"><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                                                </ul>
                                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Toggle to expand social icons"><i class="la la-share-alt"></i></div>
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end col-lg-6 -->
                        @endforeach
                    </div><!-- end row -->
                    <div class="text-center pt-3">
                        <nav aria-label="Page navigation example" class="pagination-box">
                            {{ $blogs->links('vendor.pagination.custom') }}

                        </nav>
                        <p class="fs-14 pt-2">Showing 1-10 of 56 results</p>
                    </div>
                </div><!-- end col-lg-8 -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Search Field</h3>
                                <div class="divider"><span></span></div>
                                <form method="post">
                                    <div class="form-group mb-0">
                                        <input class="form-control form--control pl-3" type="text" name="search" placeholder="Search courses">
                                        <span class="la la-search search-icon"></span>
                                    </div>
                                </form>
                            </div>
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Categories</h3>
                                <div class="divider"><span></span></div>
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="catCheckbox" required>
                                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox">
                                        Business<span class="ml-1 text-gray">(12,300)</span>
                                    </label>
                                </div><!-- end custom-control -->
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="catCheckbox2" required>
                                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox2">
                                        UI & UX<span class="ml-1 text-gray">(12,300)</span>
                                    </label>
                                </div><!-- end custom-control -->
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="catCheckbox3" required>
                                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox3">
                                        Animation<span class="ml-1 text-gray">(12,300)</span>
                                    </label>
                                </div><!-- end custom-control -->
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="checkbox" class="custom-control-input" id="catCheckbox4" required>
                                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox4">
                                        Game Design<span class="ml-1 text-gray">(12,300)</span>
                                    </label>
                                </div><!-- end custom-control -->
                                <div class="collapse" id="collapseMore">
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="checkbox" class="custom-control-input" id="catCheckbox5" required>
                                        <label class="custom-control-label custom--control-label text-black" for="catCheckbox5">
                                            Graphic Design<span class="ml-1 text-gray">(12,300)</span>
                                        </label>
                                    </div><!-- end custom-control -->
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="checkbox" class="custom-control-input" id="catCheckbox6" required>
                                        <label class="custom-control-label custom--control-label text-black" for="catCheckbox6">
                                            Typography<span class="ml-1 text-gray">(12,300)</span>
                                        </label>
                                    </div><!-- end custom-control -->
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="checkbox" class="custom-control-input" id="catCheckbox7" required>
                                        <label class="custom-control-label custom--control-label text-black" for="catCheckbox7">
                                            Web Development<span class="ml-1 text-gray">(12,300)</span>
                                        </label>
                                    </div><!-- end custom-control -->
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="checkbox" class="custom-control-input" id="catCheckbox8" required>
                                        <label class="custom-control-label custom--control-label text-black" for="catCheckbox8">
                                            Photography<span class="ml-1 text-gray">(12,300)</span>
                                        </label>
                                    </div><!-- end custom-control -->
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="checkbox" class="custom-control-input" id="catCheckbox9" required>
                                        <label class="custom-control-label custom--control-label text-black" for="catCheckbox9">
                                            Finance<span class="ml-1 text-gray">(12,300)</span>
                                        </label>
                                    </div><!-- end custom-control -->
                                </div><!-- end collapse -->
                                <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse" href="#collapseMore" role="button" aria-expanded="false" aria-controls="collapseMore">
                                    <span class="collapse-btn-hide">Show more<i class="la la-angle-down ml-1 fs-14"></i></span>
                                    <span class="collapse-btn-show">Show less<i class="la la-angle-up ml-1 fs-14"></i></span>
                                </a>
                            </div>
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Categories</h3>
                                <div class="divider"><span></span></div>
                                <ul class="generic-list-item">
                                    @foreach($bcategory as $category)
                                        <li><a href="{{ url('blog-category/'.$category->id) }}">{{ $category->category_name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Recent Posts</h3>
                                <div class="divider"><span></span></div>
                                @foreach($post as $item)
                                    <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                        <a href="{{ url('blog-details/'.$item->post_slug) }}" class="media-img">
                                            <img class="mr-3" src="{{ asset($item->post_image) }}" alt="Related course image">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="fs-15"><a href="{{ url('blog-details/'.$item->post_slug) }}">{{ $item->post_title }}</a></h5>
                                            <span class="d-block lh-18 py-1 fs-14">Admin</span>
                                        </div>
                                    </div><!-- end media -->
                                @endforeach
                                <div class="view-all-course-btn-box">
                                    <a href="blog-no-sidebar.html" class="btn theme-btn w-100">View All Posts <i class="la la-arrow-right icon ml-1"></i></a>
                                </div>
                            </div>
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Sidebar Form</h3>
                                <div class="divider"><span></span></div>
                                <form method="post">
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="text" placeholder="Name">
                                        <span class="la la-user input-icon"></span>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="email" name="email" placeholder="Email">
                                        <span class="la la-envelope input-icon"></span>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control form--control pl-3" name="message" rows="4" placeholder="Write message"></textarea>
                                    </div>
                                    <div class="btn-box">
                                        <button class="btn theme-btn w-100">Contact Author <i class="la la-arrow-right icon ml-1"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Post Tags</h3>
                                <div class="divider"><span></span></div>
                                <ul class="generic-list-item generic-list-item-boxed d-flex flex-wrap fs-15">
                                    <li class="mr-2"><a href="#">Business</a></li>
                                    <li class="mr-2"><a href="#">Event</a></li>
                                    <li class="mr-2"><a href="#">Video</a></li>
                                    <li class="mr-2"><a href="#">Audio</a></li>
                                    <li class="mr-2"><a href="#">Software</a></li>
                                    <li class="mr-2"><a href="#">Conference</a></li>
                                    <li class="mr-2"><a href="#">Marketing</a></li>
                                    <li class="mr-2"><a href="#">Freelance</a></li>
                                    <li class="mr-2"><a href="#">Tips</a></li>
                                    <li class="mr-2"><a href="#">Technology</a></li>
                                    <li class="mr-2"><a href="#">Entrepreneur</a></li>
                                </ul>
                            </div>
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Subscribe</h3>
                                <div class="divider"><span></span></div>
                                <form method="post">
                                    <div class="input-group">
                                        <input class="form-control form--control pl-3" type="email" name="email" placeholder="Enter email address">
                                        <div class="input-group-append">
                                            <button class="btn theme-btn"><i class="la la-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">Connect & Follow</h3>
                                <div class="divider"><span></span></div>
                                <ul class="social-icons social-icons-styled social--icons-styled">
                                    <li><a href="#"><i class="la la-facebook"></i></a></li>
                                    <li><a href="#"><i class="la la-twitter"></i></a></li>
                                    <li><a href="#"><i class="la la-instagram"></i></a></li>
                                    <li><a href="#"><i class="la la-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end sidebar -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end blog-area -->
    <!-- ================================
           START BLOG AREA
    ================================= -->
@endsection
