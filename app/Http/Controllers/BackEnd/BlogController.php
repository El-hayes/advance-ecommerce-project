<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use App\Models\Blog\PostComment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BlogController extends Controller
{

    // Blog Category function
    public function blogCategory()
    {
        $blogCategory = BlogPostCategory::orderBy('id', 'desc')->get();

        return view('backend.blog.category.view_blog_category', compact('blogCategory'));
    } // End Method


    // blogCategoryStore

    public function blogCategoryStore(Request $request)
    {
        $request->validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_ar' => 'required',
        ], [
            'blog_category_name_en.required' => 'Blog Category Name En Required',
            'blog_category_name_ar.required' => 'Blog Category Name Ar Required',
        ]);

        BlogPostCategory::insert([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_ar' => $request->blog_category_name_ar,
            'blog_category_slug_en' => strtolower(str_replace(' ' , '-' , $request->blog_category_name_en)),
            'blog_category_slug_ar' => str_replace(' ' , '-' , $request->blog_category_name_ar),
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.category')->with($notification);


    } // End Method



    // blogCategoryEdit
    public function blogCategoryEdit($id)
    {
        $blogCategory = BlogPostCategory::findOrFail($id);
        return view('backend.blog.category.edit_blog_category', compact('blogCategory'));


    } // End Method


    //blogCategoryUpdate
    public function blogCategoryUpdate(Request $request, $id)
    {
        $request->validate([
            'blog_category_name_en' => 'required',
            'blog_category_name_ar' => 'required',
        ], [
            'blog_category_name_en.required' => 'Blog Category Name En Required',
            'blog_category_name_ar.required' => 'Blog Category Name Ar Required',
        ]);

        BlogPostCategory::findOrFail($id)->update([
            'blog_category_name_en' => $request->blog_category_name_en,
            'blog_category_name_ar' => $request->blog_category_name_ar,
            'blog_category_slug_en' => strtolower(str_replace(' ' , '-' , $request->blog_category_name_en)),
            'blog_category_slug_ar' => str_replace(' ' , '-' , $request->blog_category_name_ar),
        ]);

        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('blog.category')->with($notification);


    } // End Method



    // Blog Category Delete
    public function blogCategoryDelete($id)
    {
        BlogPostCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.category')->with($notification);

    } // End Method



    ///////////////////////////// Blog Post ALL Methods //////////////


    public function postView()
    {
        $blogposts = BlogPost::latest()->get();
        return view('backend.blog.post.view_post', compact('blogposts'));
    } // enf method

    public function addBlogPost()
    {
        $blogPostCategory = BlogPostCategory::latest()->get();
        return view('backend.blog.post.add_blog_post', compact('blogPostCategory'));
    } // End Method


    public function blogPostStore(Request $request)
    {
        $request->validate([
            'post_title_en' => 'required',
            'post_title_ar' => 'required',
            'category_id' => 'required',
            'post_image' => 'required',
            'post_details_en' => 'required',
            'post_details_ar' => 'required',
        ],
        [
            'post_title_en.required' => 'Input Post Title English Name',
            'post_title_ar.required' => 'Input Post Title Arabic Name',
        ]);

        // post image handel
        $image = $request->file('post_image');
        $gen_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $manager->read($image)->resize(780,433)->save(public_path('upload/post/' . $gen_name));
        $save_url = 'upload/post/' . $gen_name;

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title_en' => $request->post_title_en,
            'post_title_ar' => $request->post_title_ar,
            'post_slug_en' => strtolower(str_replace(' ' , '-', $request->post_title_en)),
            'post_slug_ar' => str_replace(' ' , '-', $request->post_title_ar),
            'post_image' => $save_url,
            'post_details_en' => $request->post_details_en,
            'post_details_ar' => $request->post_details_ar,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('post.view')->with($notification);


    } // End Method


    public function blogPostEdit($id)
    {
        $blogPostCategory = BlogPostCategory::latest()->get();
        $blogPost = BlogPost::findOrFail($id);
        return view('backend.blog.post.edit_blog_post', compact('blogPost', 'blogPostCategory'));
    } // End Method


    public function blogPostUpdate(Request $request , $id)
    {
        $request->validate([
            'post_title_en' => 'required',
            'post_title_ar' => 'required',
            'category_id' => 'required',
            'post_details_en' => 'required',
            'post_details_ar' => 'required',
        ],
            [
                'post_title_en.required' => 'Input Post Title English Name',
                'post_title_ar.required' => 'Input Post Title Arabic Name',
            ]);




        if ($request->file('post_image'))
        {
            $postImg = BlogPost::findOrFail($id)->post_image;
            @unlink(public_path($postImg));

            // post image handel
            $image = $request->file('post_image');
            $gen_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $manager->read($image)->resize(780,433)->save(public_path('upload/post/' . $gen_name));
            $save_url = 'upload/post/' . $gen_name;

            BlogPost::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'post_title_en' => $request->post_title_en,
                'post_title_ar' => $request->post_title_ar,
                'post_slug_en' => strtolower(str_replace(' ' , '-', $request->post_title_en)),
                'post_slug_ar' => str_replace(' ' , '-', $request->post_title_ar),
                'post_image' => $save_url,
                'post_details_en' => $request->post_details_en,
                'post_details_ar' => $request->post_details_ar,
                'created_at' => Carbon::now()
            ]);

        } else
        {
            BlogPost::findOrFail($id)->update([
                'category_id' => $request->category_id,
                'post_title_en' => $request->post_title_en,
                'post_title_ar' => $request->post_title_ar,
                'post_slug_en' => strtolower(str_replace(' ' , '-', $request->post_title_en)),
                'post_slug_ar' => str_replace(' ' , '-', $request->post_title_ar),
                'post_details_en' => $request->post_details_en,
                'post_details_ar' => $request->post_details_ar,
                'created_at' => Carbon::now()
            ]);
        }



        $notification = array(
            'message' => 'Blog Post Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('post.view')->with($notification);


    } // End function


    public function blogPostDelete($id)
    {
        // remove img from post image folder
        $postImage = BlogPost::findOrFail($id)->post_image;
        @unlink(public_path($postImage));

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('post.view')->with($notification);

    } // End Method



    /////////////////////////////  Post Comments ALL Methods //////////////

    // Admin pending post comments
    public function pendingComment()
    {
        $comments = PostComment::where('status', 0)->latest()->get();
        return view('backend.blog.post.comments.pendingComment', compact('comments'));
    } // End Method



    // Admin publish post comments
    public function publishComment($comment_id)
    {
        PostComment::findOrFail($comment_id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'Comment Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.comment')->with($notification);
    } // End Method



    public function approvedComment()
    {
        $comments = PostComment::where('status', 1)->latest()->get();
        return view('backend.blog.post.comments.approvedComment', compact('comments'));

    } // End Method



    public function deleteComment($comment_id)
    {
        PostComment::findOrFail($comment_id)->delete();

        $notification = array(
            'message' => 'Comment Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('approved.comment')->with($notification);

    } // End Method


}
