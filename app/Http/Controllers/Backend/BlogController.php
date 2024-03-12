<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function AdminAllBlogCategory(){
        $category = BlogCategory::latest()->get();
        return view('admin.backend.blogcategory.blog_category',compact('category'));
    }

    public function BlogCategoryStore(Request $request){
       BlogCategory::insert([
           'category_name' => $request->category_name,
           'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
       ]);

        $notification = array(
            'message' => 'Category Added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function EditBlogCategory($id){
        $categories = BlogCategory::find($id);
        return response()->json($categories);
    }

    public function BlogCategoryUpdate(Request $request){
        $category_id = $request->editCategoryId;

        BlogCategory::find($category_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function BlogCategoryDelete($id){

        BlogCategory::find($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }


//    Admin All Blog Post
    public function AdminAllBlogPost(){
        $post = BlogPost::latest()->get();
        return view('admin.backend.post.all_post',compact('post'));
    }


    public function AdminAddBlogPost(){
        $blogCategory = BlogCategory::latest()->get();
        return view('admin.backend.post.add_post',compact('blogCategory'));
    }

    public function AdminStoreBlogPost(Request $request){
        $postimage = $request->file('post_image');
        $post_name_gen = hexdec(uniqid()).'.'.$postimage->getClientOriginalExtension();
        Image::make($postimage)->resize(370,247)->save('upload/post/'.$post_name_gen);
        $save_url = 'upload/post/'.$post_name_gen;

        BlogPost::insert([
            'blog_categories_id' => $request->blog_categories_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'long_description' => $request->long_description,
            'post_tags' => $request->post_tags,
            'created_at' => Carbon::now(),
            'post_image' => $save_url
        ]);

        $notification = array(
            'message' => 'Category Added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.blog.post')->with($notification);
    }

    public function EditBlogPost($id){
        $post = BlogPost::find($id);
        $blogCat = BlogCategory::latest()->get();
        return view('admin.backend.post.edit_post',compact('post','blogCat'));
    }

    public function UpdateBlogPost(Request $request){
        $post_id = $request->id;

        if ($request->file('post_image')){
            $postimage = $request->file('post_image');
            $post_name_gen = hexdec(uniqid()).'.'.$postimage->getClientOriginalExtension();
            Image::make($postimage)->resize(370,247)->save('upload/post/'.$post_name_gen);
            $save_url = 'upload/post/'.$post_name_gen;

            BlogPost::find($post_id)->update([
                'blog_categories_id' => $request->blog_categories_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_description' => $request->long_description,
                'post_tags' => $request->post_tags,
                'created_at' => Carbon::now(),
                'post_image' => $save_url
            ]);

            $notification = array(
                'message' => 'Blog post updated Successfully.',
                'alert-type' => 'success',
            );

            return redirect()->route('admin.blog.post')->with($notification);
        }else{
            BlogPost::find($post_id)->update([
                'blog_categories_id' => $request->blog_categories_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_description' => $request->long_description,
                'post_tags' => $request->post_tags,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Blog post updated Successfully.',
                'alert-type' => 'success',
            );

            return redirect()->route('admin.blog.post')->with($notification);
        }
    }


    public function DeleteBlogPost($id){
        $item = BlogPost::find($id);
        $img = $item->post_image;
        unlink($img);

        BlogPost::find($id)->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function BlogDetails($slug){
        $blog = BlogPost::where('post_slug',$slug)->first();
//        if ($blog->post_tags == NULL){
            $tags = $blog->post_tags;
            $tags_all = explode(',', $tags);
//        } else{
//            $tags_all = 'no tags';
//        }

        $bcategory = BlogCategory::latest()->limit(3)->get();
        $post = BlogPost::latest()->get();
        return view('frontend.blog.blog_details',compact('blog','tags_all','bcategory','post'));
    }

    public function BlogCategory($id){
        $blogs = BlogPost::where('blog_categories_id',$id)->get();
        $breadCat = BlogCategory::where('id',$id)->first();
        $bcategory = BlogCategory::latest()->limit(3)->get();
        $post = BlogPost::latest()->get();
        return view('frontend.blog.blog_cat_list',compact('blogs','breadCat','bcategory','post'));
    }

    public function AllBlog(){
        $blogs = BlogPost::latest()->paginate(2);
        $bcategory = BlogCategory::latest()->limit(3)->get();
        $post = BlogPost::latest()->get();
        return view('frontend.blog.blog_list',compact('blogs','bcategory','post'));
    }

}
