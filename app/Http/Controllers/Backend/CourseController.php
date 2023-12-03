<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseGoal;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\Constraint\Count;
use function League\Flysystem\move;

class CourseController extends Controller
{
    public function AllCourse(){
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id',$id)->orderBy('id','desc')->get();
        return view('instructor.courses.all_courses',compact('courses'));
    }

    public function AddCourse(){
        $categories = Category::latest()->get();
        return view('instructor.courses.add_courses',compact('categories'));
    }

    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);
    }

    public function StoreCourse(Request $request){
        $request->validate([
            'video' => 'required|mimes:mp4'
        ]);

        $image = $request->file('course_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,246)->save('upload/course/thumbnail/'.$name_gen);
        $save_url = 'upload/course/thumbnail/'.$name_gen;

        $video = $request->file('video');
        $videoName = time().'.'.$video->getClientOriginalExtension();
        $video->move(public_path('upload/course/video/'),$videoName);
        $save_video = 'upload/course/video/'.$videoName;

        $course_id = Course::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'description' => $request->description,
            'video' => $save_video,
            'label' => $request->label,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'certificate' => $request->certificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,
            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,
            'status' => 1,
            'course_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

//        Course Goal Add Form
        $goals = Count($request->course_goals);
        if ( $goals != NULL){
            for ($i=0; $i<$goals; $i++){
                $gcount = new CourseGoal();
                $gcount->course_id = $course_id;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            }
        }

        $notification = array(
            'message' => 'Course Inserted Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('all.course')->with($notification);

    }

    public function EditCourse($id){
        $course = Course::find($id);
        $goals = CourseGoal::where('course_id',$id)->get();
        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        return view('instructor.courses.edit_course',compact('course','goals','categories', 'subCategories'));
    }

    public function UpdateCourse(Request $request){
        $courseId = $request->course_id;

        Course::find($courseId)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'description' => $request->description,

            'label' => $request->label,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'certificate' => $request->certificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,

            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,
        ]);


        $notification = array(
            'message' => 'Course Updated Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('all.course')->with($notification);

    }

    public function UpdateCourseImage(Request $request){
        $course_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('course_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,246)->save('upload/course/thumbnail/'.$name_gen);
        $save_url = 'upload/course/thumbnail/'.$name_gen;

        if ($oldImage){
            unlink($oldImage);
        }

        Course::find($course_id)->update([
            'course_image' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Course Image Updated Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }


    public function UpdateCourseVideo(Request $request){
        $course_id = $request->vid;
        $oldVideo = $request->old_vid;

        $video = $request->file('video');
        $videoName = time().'.'.$video->getClientOriginalExtension();
        $video->move(public_path('upload/course/video/'),$videoName);
        $save_video = 'upload/course/video/'.$videoName;

        if ($oldVideo){
            unlink($oldVideo);
        }

        Course::find($course_id)->update([
            'video' => $save_video,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Course Video Updated Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

    }

    public function UpdateCourseGoal(Request $request){
        $cid = $request->id;

        if ($request->course_goals == NULL){
            return redirect()->back();
        } else{
            //        Course Goal Add Form
            CourseGoal::where('course_id',$cid)->delete();
            $goals = Count($request->course_goals);

            for ($i=0; $i<$goals; $i++){
                $gcount = new CourseGoal();
                $gcount->course_id = $cid;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            }

        }

        $notification = array(
            'message' => 'Course Goal Updated Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteCourse($id){
        $course = Course::find($id);

        unlink($course->course_image);
        unlink($course->video);

        Course::find($id)->delete();

        $goalData = CourseGoal::where('course_id',$id)->get();
        foreach ($goalData as $item){
            $item->goal_name;
            CourseGoal::where('course_id',$id)->delete();
        }
        $notification = array(
            'message' => 'Course Goal Deleted Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function AddCourseLecture($id){
        $course = Course::find($id);
        $section = CourseSection::where('course_id',$id)->latest()->get();

        return view('instructor.courses.section.add_course_lecture',compact('course','section'));
    }

    public function AddCourseSection(Request $request){

        $cid = $request->id;

        CourseSection::insert([
            'course_id' => $cid,
            'section_title' => $request->section_title,
        ]);

        $notification = array(
            'message' => 'Course Section Added Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function SaveLecture(Request $request){
        $lecture = new CourseLecture();
        $lecture->course_id = $request->course_id;
        $lecture->section_id = $request->section_id;
        $lecture->lecture_title = $request->lecture_title;
        $lecture->url = $request->lecture_url;
        $lecture->content = $request->lec_content;
        $lecture->save();


        return response()->json(['success' => 'Lecture Saved Successfully.']);
    }
}
