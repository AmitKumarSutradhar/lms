<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CourseController;


Route::get('/',[UserController::class,'Index'])->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'userProfileUpdate'])->name('user.profile.update');
    Route::get('/user/profile/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/change-password', [UserController::class, 'userChangePassword'])->name('user.change.password');
    Route::post('/user/change-update', [UserController::class, 'userUpdatePassword'])->name('user.password.update');
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

//    All Category Routes
    Route::controller(CategoryController::class)->group(function (){
        Route::get('/all-category','AllCategory')->name('all.category');
        Route::get('/add-category','AddCategory')->name('add.category');
        Route::post('/store-category','StoreCategory')->name('store.category');
        Route::get('/edit-category/{id}','EditCategory')->name('edit.category');
        Route::post('/update-category/{id}','UpdateCategory')->name('update.category');
        Route::get('/delete-category/{id}','DeleteSubCategory')->name('delete.category');
    });

//    All Sub Category Routes
    Route::controller(CategoryController::class)->group(function (){
        Route::get('/all-subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add-subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/store-subcategory','StoreSubCategory')->name('store.subcategory');
        Route::get('/edit-subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/update-subcategory','UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete-subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');
    });

//    Instructor All Routes
    Route::controller(AdminController::class)->group(function (){
        Route::get('/all-instructor','AllInstructor')->name('all.instructor');
        Route::post('/user-status-update','UpdateUserStatus')->name('update.user.status');
    });
});

Route::get('/admin/login',[AdminController::class,'AdminLogin'])->name('admin.login');
Route::get('/become-instructor',[AdminController::class,'BecomeInstructor'])->name('become.instructor');
Route::post('/instructor/register',[AdminController::class,'InstructorRegister'])->name('instructor.register');

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

});

Route::get('/instructor/login',[InstructorController::class,'InstructorLogin'])->name('instructor.login');
