<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;
use App\Models\Blog\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use voku\helper\ASCII;

class HomeBlogController extends Controller
{

    public function addBlogPost()
    {
        $blogCategory = BlogPostCategory::latest()->get();
        $blogPost = BlogPost::latest()->get();
        return view('frontend.blog.blog_list' , compact('blogPost' , 'blogCategory'));
    } // End Method


    // Blog Post Details
    public function blogPostDetails($id)
    {
        $blogCategory = BlogPostCategory::latest()->get();
        $blogPost = BlogPost::findOrFail($id);
        return view('frontend.blog.post_details', compact('blogPost', 'blogCategory'));
    } // End Method

    // Blog Post Category
    public function homeBlogCatPost($category_id)
    {
        $blogCategory = BlogPostCategory::latest()->get();
        $blogPost = BlogPost::where('category_id', $category_id)->orderBy('id','DESC')->get();
        return view('frontend.blog.blog_cat_list', compact('blogCategory', 'blogPost'));
    } // End Method


    // Blog comment store
    public function blogPostCommentStore(Request $request, $post_id)
    {
        $request->validate([
            'title' => 'required',
            'comment' => 'required',

        ]);

        //dd($request->all());

        PostComment::insert([
            'post_id' => $post_id,
            'user_id' => auth()->user()->id,
            'email' => auth()->user()->email,
            'title' => $request->title,
            'comment' => $request->comment,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Comment submitted successfully and under Review ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    } // End Method


}
