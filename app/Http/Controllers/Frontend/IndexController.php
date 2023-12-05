<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseGoal;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function CourseDetails($id, $slug){
        $course = Course::find($id);
        $goals = CourseGoal::where('course_id',$id)->orderBy('id','DESC')->get();

        $ins_id = $course->instructor_id;
        $instructorCourses = Course::where('instructor_id',$ins_id)->orderBy('id','DESC')->get();

        $categories = Category::latest()->get();

        $cat_id = $course->category_id;
        $relatedCourses = Course::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.course.course_details',compact('course','goals','instructorCourses','categories','relatedCourses'));
    }

    public function CategoryCourse($id, $slug){
        $courses = Course::where('category_id',$id)->where('status',1)->get();
        $category = Category::where('id',$id)->first();
        $categories = Category::latest()->get();
        return view('frontend.category.category_all',compact('courses','category','categories'));
    }
}
