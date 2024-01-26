<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Models\BlogPost;


Route::get('/',[UserController::class,'Index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth',  'roles:user', 'verified'])->name('dashboard');
Route::get('/admin/login',[AdminController::class,'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become-instructor',[AdminController::class,'BecomeInstructor'])->name('become.instructor');
Route::post('/instructor/register',[AdminController::class,'InstructorRegister'])->name('instructor.register');

//User Group Middleware
Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'userProfileUpdate'])->name('user.profile.update');
    Route::get('/user/profile/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/change-password', [UserController::class, 'userChangePassword'])->name('user.change.password');
    Route::post('/user/change-update', [UserController::class, 'userUpdatePassword'])->name('user.password.update');

    //    Wishlist All Routes
    Route::get('user/wishlist',[WishListController::class,'AllWishlist'])->name('user.wishlist');
    Route::get('/get-wishlist-course',[WishListController::class,'GetWishListCourse']);
    Route::get('/wishlist-remove/{id}',[WishListController::class,'RemoveWishlist']);


    // My course all Routes
    Route::get('/my-course',[OrderController::class,'MyCourse'])->name('user.my-course');
    Route::get('/course-view/{course_id}',[OrderController::class,'CourseView'])->name('course.view');


    // User Question all Routes
    Route::post('/user-question',[QuestionController::class,'UserQuestion'])->name('user.question');


});

require __DIR__.'/auth.php';


//Admin Group MiddleWare
Route::middleware(['auth','roles:admin'])->group(function (){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change-password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update-password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    //Admin Dashboard All Category Routes
    Route::controller(CategoryController::class)->group(function (){
        Route::get('/all-category','AllCategory')->name('all.category');
        Route::get('/add-category','AddCategory')->name('add.category');
        Route::post('/store-category','StoreCategory')->name('store.category');
        Route::get('/edit-category/{id}','EditCategory')->name('edit.category');
        Route::post('/update-category/{id}','UpdateCategory')->name('update.category');
        Route::get('/delete-category/{id}','DeleteSubCategory')->name('delete.category');
    });

    //Admin Dashboard All Sub Category Routes
    Route::controller(CategoryController::class)->group(function (){
        Route::get('/all-subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add-subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/store-subcategory','StoreSubCategory')->name('store.subcategory');
        Route::get('/edit-subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/update-subcategory','UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete-subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');
    });

    //Admin Dashboard Instructor All Routes
    Route::controller(AdminController::class)->group(function (){
        Route::get('/all-instructor','AllInstructor')->name('all.instructor');
        Route::post('/user-status-update','UpdateUserStatus')->name('update.user.status');
    });

    //Admin Dashboard Routes for all courses in admin panel
    Route::controller(AdminController::class)->group(function (){
        Route::get('/admin/all-courses','AdminAllCourse')->name('admin.all.course');
        Route::post('/update-course-status','UpdateCourseStatus')->name('update.course.status');
        Route::get('/admin/course-details/{id}','AdminCourseDetails')->name('admin.course.details');
    });

    //Admin Dashboard Routes for all coupons in admin panel
    Route::controller(CouponController::class)->group(function (){
        Route::get('/admin/all-coupons','AdminAllCoupons')->name('admin.all.coupon');
        Route::get('/admin/add-coupon','AdminAddCoupons')->name('admin.add.coupon');
        Route::post('/admin/store-coupon','AdminStoreCoupon')->name('admin.store.coupon');
        Route::get('/admin/edit-coupon/{id}','AdminEditCoupon')->name('admin.edit.coupon');
        Route::post('/admin/update-coupon','AdminUpdateCoupon')->name('admin.update.coupon');
        Route::get('/admin/delete-coupon/{id}','AdminDeleteCoupon')->name('admin.delete.coupon');
    });

    //Routes for all courses in admin panel
    Route::controller(SettingController::class)->group(function (){
        Route::get('/smtp-settings','SmtpSettings')->name('smtp.settings');
        Route::post('/smtp-update','SmtpUpdate')->name('smtp.update');
    });

    //Routes for all orders in admin panel
    Route::controller(OrderController::class)->group(function (){
        Route::get('/admin/pending-order','AdminPendingOrder')->name('admin.pending.order');
        Route::get('/admin/confirm-order','AdminConfirmOrder')->name('admin.confirm.order');
        Route::get('/admin/order-details/{id}','AdminOrderDetails')->name('admin.order.details');
        Route::get('/admin/pending-confirm/{id}','PendingToConfirm')->name('pending-confirm');
    });


    //Routes for all reports in admin panel
    Route::controller(ReportController::class)->group(function (){
        Route::get('/report-view','ReportView')->name('report.view');
        Route::post('/search-by-date','SearchByDate')->name('search.by.date');
        Route::post('/search-by-month','SearchByMonth')->name('search.by.month');
        Route::post('/search-by-year','SearchByYear')->name('search.by.year');
    });

    //Routes for all review in admin panel
    Route::controller(ReviewController::class)->group(function (){
        Route::get('/admin/pending-review','AdminPendingReview')->name('admin.pending.review');
        Route::get('/admin/active-review','AdminActiveReview')->name('admin.active.review');
        Route::post('/admin/review-status','AdminReviewStatus')->name('update.review.status');
    });

    //Routes for all user in admin panel
    Route::controller(ActiveUserController::class)->group(function (){
        Route::get('/admin/all-active-user','AdminAllActiveUser')->name('admin.all.user');
        Route::get('/admin/all-active-instructor','AdminAllActiveInstructor')->name('admin.all.instructor');
    });


    //Routes for all blog category in admin panel
    Route::controller(BlogController::class)->group(function (){
        Route::get('/admin/blog-category','AdminAllBlogCategory')->name('admin.blog.category');
        Route::get('/edit/blog-category/{id}','EditBlogCategory');
        Route::post('/admin/blog-category/store','BlogCategoryStore')->name('blog.category.store');
        Route::post('/admin/blog-category/update','BlogCategoryUpdate')->name('blog.category.update');
        Route::get('/admin/blog-category/delete/{id}','BlogCategoryDelete')->name('blog.category.delete');
    });

    //Routes for all blog post in admin panel
    Route::controller(BlogController::class)->group(function (){
        Route::get('/admin/blog-post','AdminAllBlogPost')->name('admin.blog.post');
        Route::get('/admin/blog-post/create','AdminAddBlogPost')->name('admin.blog.post.add');
        Route::post('/admin/blog-post/store','AdminStoreBlogPost')->name('admin.blog.post.store');
        Route::get('/admin/blog-post/edit/{id}','EditBlogPost')->name('blog.post.edit');
        Route::post('/admin/blog-post/update','UpdateBlogPost')->name('blog.post.update');
        Route::post('/admin/blog-post/update','UpdateBlogPost')->name('blog.post.update');
        Route::get('/admin/blog-post/delete/{id}','DeleteBlogPost')->name('blog.post.delete');
    });

}); //End Admin Group Middleware


//Instructor Group MiddleWare
Route::middleware(['auth','roles:instructor'])->group(function (){
    Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');
    Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');
    Route::get('/instructor/profile/change-password', [InstructorController::class, 'InstructorChangePassword'])->name('instructor.change.password');
    Route::post('/instructor/profile/update-password', [InstructorController::class, 'InstructorUpdatePassword'])->name('instructor.password.update');
    Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogOut'])->name('instructor.logout');

    Route::controller(CourseController::class)->group(function (){
        Route::get('/all-course','AllCourse')->name('all.course');
        Route::get('/add-course','AddCourse')->name('add.course');
        Route::post('/store-course','StoreCourse')->name('store.course');
        Route::get('/edit-course/{id}','EditCourse')->name('edit.course');
        Route::post('/update-course','UpdateCourse')->name('update.course');
        Route::post('/update-course-image','UpdateCourseImage')->name('update.course.image');
        Route::post('/update-course-video','UpdateCourseVideo')->name('update.course.video');
        Route::post('/update-course-goal','UpdateCourseGoal')->name('update.course.goal');

        Route::get('/delete-course/{id}','DeleteCourse')->name('delete.course');
        Route::get('/subcategory/ajax/{category_id}','GetSubCategory');
    });


    //Course Section and Lecture all routes
    Route::controller(CourseController::class)->group(function (){
        Route::get('/add-course-lecture/{id}','AddCourseLecture')->name('add.course.lecture');
        Route::post('/add-course-section','AddCourseSection')->name('add.course.section');
        Route::post('/delete-course-section/{id}','DeleteCourseSection')->name('delete.section');
        Route::post('/save-lecture','SaveLecture')->name('save.lecture');
        Route::get('/edit-lecture/{id}','EditLecture')->name('edit.lecture');
        Route::post('/update-lecture','UpdateLecture')->name('update.course.lecture');
        Route::get('/delete-lecture/{id}','DeleteLecture')->name('delete.lecture');
    });


    //Instructor all orders routes
    Route::controller(OrderController::class)->group(function (){
        Route::get('/instructor/all-order','InstructorAllOrder')->name('instructor.all.order');
        Route::get('/instructor/order-details/{payment_id}','InstructorOrderDetail')->name('instructor.order.details');
        Route::get('/instructor/order-invoice/{payment_id}','InstructorOrderInvoice')->name('instructor.order.invoice');
    });


    //Instructor all question routes
    Route::controller(QuestionController::class)->group(function (){
        Route::get('/instructor/all-question','InstructorAllQuestion')->name('instructor.all-question');
        Route::get('/instructor/question-details/{id}','QuestionDetails')->name('question.details');
        Route::post('/instructor/reply','InstructorReply')->name('instructor.reply');
    });

    //All coupons routes in instructor panel
    Route::controller(CouponController::class)->group(function (){
        Route::get('/instructor/all-coupons','InstructorAllCoupons')->name('instructor.all.coupon');
        Route::get('/instructor/add-coupons','InstructorAddCoupons')->name('instructor.add.coupon');
        Route::post('/instructor/store-coupon','InstructorStoreCoupons')->name('instructor.store.coupon');
        Route::get('/instructor/edit-coupon/{id}','InstructorEditCoupons')->name('instructor.edit.coupon');
        Route::post('/instructor/update-coupon','InstructorUpdateCoupons')->name('instructor.update.coupon');
        Route::get('/instructor/delete-coupon/{id}','InstructorDeleteCoupons')->name('instructor.delete.coupon');
    });

    //Routes for all review in instructor panel
    Route::controller(ReviewController::class)->group(function (){
        Route::get('/instructor/all-review','InstructorAllReview')->name('instructor.all.review');
    });

});

//Route Accessible by Anyone
Route::get('/instructor/login',[InstructorController::class,'InstructorLogin'])->name('instructor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/instructor/{id}',[InstructorController::class,'InstructorDetails'])->name('instructor.details');

Route::get('/course/details/{id}/{slug}',[IndexController::class,'CourseDetails']);
Route::get('/category/{id}/{slug}',[IndexController::class,'CategoryCourse']);
Route::get('/subcategory/{id}/{slug}',[IndexController::class,'SubCategoryCourse']);

Route::post('/add-to-wishlist/{id}',[WishListController::class,'AddToWishList']);
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::post('/buy/data/store/{id}', [CartController::class, 'BuyToCart']);
Route::get('/cart/data/',[CartController::class,'CartData']);

//Get Data From Mini Cart
Route::get('/course/mini/cart/',[CartController::class,'AddMiniCart']);
Route::get('/minicart/course/remove/{rowId}',[CartController::class,'RemoveMiniCart']);

//Coupon All Routes
Route::post('/coupon-apply',[CartController::class,'CouponApply']);
Route::post('/inscoupon-apply',[CartController::class,'InsCouponApply']);
Route::get('/coupon-calculation',[CartController::class,'CouponCalculation']);
Route::get('/coupon-remove',[CartController::class,'CouponRemove']);

//Cart All Routes
Route::controller(CartController::class)->group(function (){
    Route::get('/mycart','MyCart')->name('mycart');
    Route::get('/get-cart-course','GetCartCourse');
    Route::get('/cart-remove/{rowId}','CartRemove');
});

// Checkout All routes
Route::get('/checkout',[CheckoutController::class,'CheckoutCreate'])->name('checkout');
Route::post('/payment',[CheckoutController::class,'Payment'])->name('payment');
Route::post('/stripe-order',[CheckoutController::class,'StripeOrder'])->name('stripe_order');


//Review Routes
Route::post('/store-review',[ReviewController::class,'StoreReview'])->name('store.review');

//Blog Details
Route::get('/blog-details/{slug}',[BlogController::class,'BlogDetails']);

//Blog Category
Route::get('/blog-category/{id}',[BlogController::class,'BlogCategory']);
Route::get('/blogs',[BlogController::class,'AllBlog'])->name('blog.all');


Route::post('/mark-notification-as-read/{notification}',[CartController::class,'MarkAsRead']);

//End Route Accessible by Anyone



