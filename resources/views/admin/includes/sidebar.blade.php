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
                <div class="parent-icon"><i class="lni lni-users"></i>
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
                <div class="parent-icon"><i class="lni lni-select"></i>
                </div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                <li> <a href="{{ route('smtp.settings') }}"><i class='bx bx-radio-circle'></i>SMTP Settings</a>
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
                <div class="parent-icon"><i class="bx bx-map-alt"></i>
                </div>
                <div class="menu-title">Maps</div>
            </a>
            <ul>
                <li> <a href="map-google-maps.html"><i class='bx bx-radio-circle'></i>Google Maps</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class='bx bx-radio-circle'></i>Vector Maps</a>
                </li>
            </ul>
        </li>

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
