<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Egulias\EmailValidator\Warning\ObsoleteDTEXT;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function returnRequest()
    {
        $orders = Order::where('return_order', 1)->orderBy('id', 'desc')->get();
        return view('backend.return_order.return_request' , compact('orders'));
    } // End Function


    public function returnRequestApprove($order_id)
    {

        Order::find($order_id)->update(['return_order' => 2]);

        $notification = array(
            'message' => 'Return Order Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method


    public function returnAllRequest()
    {
       $orders =  Order::where('return_order', 2)->orderBy('id', 'desc')->get();

        return view('backend.return_order.all_return_request',compact('orders'));
    } // End Method


}
