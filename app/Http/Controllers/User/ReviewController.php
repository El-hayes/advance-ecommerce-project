<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class ReviewController extends Controller
{

    public function reviewStore(Request $request, $product_id)
    {

        $request->validate([
            'summary' => 'required',
            'comment' => 'required'
        ]);

        Review::insert([
            'product_id' => $product_id,
            'user_id' => Auth::id(),
            'summary' => $request->summary,
            'rating' => $request->quality,
            'comment' => $request->comment,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Review Will Approve By Admin',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method


    ////  Start admin review functions  ////
    public function pendingReview()
    {
        $reviews = Review::where('status', 0)->orderBy('id', 'Desc')->get();
        return view('backend.review.pending_review', compact('reviews'));
    } // End Method


    public function reviewApprove($id)
    {
        Review::where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Review Approved Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method



    public function publishReview()
    {
        $reviews = Review::where('status', 1)->orderBy('id', 'Desc')->get();
        return view('backend.review.publish_review', compact('reviews'));
    } // End Method


    public function deleteReview($id){

        Review::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Review Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method



}
