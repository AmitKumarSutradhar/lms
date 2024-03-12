@php
    $id = Auth::user()->id;
    $instructorId = \App\Models\User::find($id);
    $status = $instructorId->status;
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header py-4">
        <div>
            <img src="{{ asset('/') }}backend/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Instructor Panel</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('instructor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if($status === '1')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-book'></i>
                </div>
                <div class="menu-title">My Courses</div>
            </a>
            <ul>


                <li> <a href="{{ route('all.course') }}"><i class='bx bx-radio-circle'></i>All Course</a>
                </li>
                <li> <a href="{{ route('add.course') }}"><i class='bx bx-radio-circle'></i>Add Course</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bxs-cart-add'></i>
                </div>
                <div class="menu-title">Orders</div>
            </a>
            <ul>
                <li> <a href="{{ route('instructor.all.order') }}"><i class='bx bx-radio-circle'></i>All Order</a>
                </li>
            </ul>
        </li>
{{--        <li class="menu-label">Charts & Maps</li>--}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-question-mark"></i>
                </div>
                <div class="menu-title">Student Questions</div>
            </a>
            <ul>
                <li> <a href="{{ route('instructor.all-question') }}"><i class='bx bx-radio-circle'></i>All Questions</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bxs-coupon"></i>
                </div>
                <div class="menu-title">Coupons</div>
            </a>
            <ul>
                <li> <a href="{{ route('instructor.all.coupon') }}"><i class='bx bx-radio-circle'></i>All Coupons</a>
                </li>
                <li> <a href="{{ route('instructor.add.coupon') }}"><i class='bx bx-radio-circle'></i>Add Coupon</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bxs-report"></i>
                </div>
                <div class="menu-title">Reviews</div>
            </a>
            <ul>
                <li> <a href="{{ route('instructor.all.review') }}"><i class='bx bx-radio-circle'></i>All Reviews</a>
                </li>
            </ul>
        </li>
        @else

        @endif

        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
