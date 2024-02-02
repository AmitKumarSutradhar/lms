<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('/') }}backend/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin Panel</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">UI Elements</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Manage Category</div>
            </a>
            <ul>
                <li> <a href="{{route('all.category')}}"><i class='bx bx-radio-circle'></i>All Category</a>
                </li>
                <li> <a href="{{route('all.subcategory')}}"><i class='bx bx-radio-circle'></i>All Sub-Category</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bxs-graduation"></i>
                </div>
                <div class="menu-title">Instructors</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.instructor') }}"><i class='bx bx-radio-circle'></i>All Instructor</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-write"></i>
                </div>
                <div class="menu-title">Courses</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.course') }}"><i class='bx bx-radio-circle'></i>Manage Courses</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-offer"></i>
                </div>
                <div class="menu-title">Coupons</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.add.coupon') }}"><i class='bx bx-radio-circle'></i>Add Coupons</a>
                </li>
                <li> <a href="{{ route('admin.all.coupon') }}"><i class='bx bx-radio-circle'></i>Manage Coupons</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-cart-full"></i>
                </div>
                <div class="menu-title">Orders</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.pending.order') }}"><i class='bx bx-radio-circle'></i>Pending Orders</a>
                </li>
                <li>
                    <a href="{{ route('admin.confirm.order') }}"><i class='bx bx-radio-circle'></i>Confirmed Orders</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Reports</div>
            </a>
            <ul>
                <li> <a href="{{ route('report.view') }}"><i class='bx bx-radio-circle'></i>Report View</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-revision"></i>
                </div>
                <div class="menu-title">Reviews</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.pending.review') }}"><i class='bx bx-radio-circle'></i>Pending Review</a>
                </li>
                <li> <a href="{{ route('admin.active.review') }}"><i class='bx bx-radio-circle'></i>Active Review</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.user') }}"><i class='bx bx-radio-circle'></i>All User</a>
                </li>
                <li> <a href="{{ route('admin.all.instructor') }}"><i class='bx bx-radio-circle'></i>Instructors</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-link"></i>
                </div>
                <div class="menu-title">Blog</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.blog.category') }}"><i class='bx bx-radio-circle'></i>Blog Category</a>
                </li>
                <li> <a href="{{ route('admin.blog.post') }}"><i class='bx bx-radio-circle'></i>Blog Post</a>
                </li>
            </ul>
        </li>

        @if(Auth::user()->can('site.setting'))
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bxl-dev-to"></i>
                    </div>
                    <div class="menu-title">Settings</div>
                </a>
                <ul>
                    <li> <a href="{{ route('site.settings') }}"><i class='bx bx-radio-circle'></i>Site Settings</a>
                    </li>
                    <li> <a href="{{ route('smtp.settings') }}"><i class='bx bx-radio-circle'></i>SMTP Settings</a>
                    </li>
                </ul>
            </li>
        @endif

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bxs-lock"></i>
                </div>
                <div class="menu-title">Role & Permission</div>
            </a>
            <ul>
                <li><a class="has-arrow" href="javascript:;"><i class='bx bx-radio-circle'></i>Roles</a>
                    <ul>
                        <li> <a href="{{ route('all.role') }}"><i class='bx bx-radio-circle'></i>Manage Role</a></li>
                        <li> <a href="{{ route('add.role') }}"><i class='bx bx-radio-circle'></i>Add Role</a></li>
                        <li> <a href="{{ route('role.assigned.permission') }}"><i class='bx bx-radio-circle'></i>Assigned Permission</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:;"><i class='bx bx-radio-circle'></i>Permission</a>
                    <ul>
                        <li> <a href="{{ route('all.permission') }}"><i class='bx bx-radio-circle'></i>Manage Permission</a></li>
                        <li> <a href="{{ route('add.permission') }}"><i class='bx bx-radio-circle'></i>Add Permission</a></li>
                        <li> <a href="{{ route('assign.permission') }}"><i class='bx bx-radio-circle'></i>Assign Permission</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-user-pin"></i>
                </div>
                <div class="menu-title">Admins</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all') }}"><i class='bx bx-radio-circle'></i>Manage Admin</a></li>
                <li> <a href="{{ route('admin.add') }}"><i class='bx bx-radio-circle'></i>Add Admin</a></li>
            </ul>
        </li>



{{--        <li>--}}
{{--            <a href="https://themeforest.net/user/codervent" target="_blank">--}}
{{--                <div class="parent-icon"><i class="bx bx-support"></i>--}}
{{--                </div>--}}
{{--                <div class="menu-title">Support</div>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
    <!--end navigation-->
</div>
