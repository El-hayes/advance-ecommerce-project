<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class AllUserController extends Controller
{

    public function myOrders(){

        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('frontend.user.orders.orders_view', compact('orders'));

    } // End Method

    public function orderDetails($user_id)
    {
        $order = Order::where('id', $user_id)->where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id', 'desc')->get();

        return view('frontend.user.orders.order_details', compact('order', 'orderItems'));

    } // End Method


    public function invoiceDownload($order_id)
    {
        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id', 'desc')->get();

        //return view('frontend.user.orders.order_invoice');

        $pdf = Pdf::loadView('frontend.user.orders.order_invoice',
            compact('order', 'orderItems'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    } // End Method


    // return order reason method
    public function returnOrder(Request $request, $order_id)
    {
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1
            ]);

        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);

    } // End Method


    // return orders list
    public function returnOrderList()
    {
        $orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', 'NULL')->orderBy('id','DESC')->get();

        return view('frontend.user.orders.return_order_list_view', compact('orders'));

    } // End Method



    // Cancel orders list
    public function cancelOrders()
    {
        $orders = Order::where('user_id', Auth::id())->where('status', 'cancel')->orderBy('id','DESC')->get();

        return view('frontend.user.orders.cancel_order_view', compact('orders'));

    } // End Method


    // Order Tracking
    public function  orderTracking(Request $request)
    {
        $invoice = $request->code;

        $track = Order::where('invoice_no', $invoice)->first();

        // print_r($track);

        if ($track)
        {
            return view('frontend.tracking.track_order', compact('track'));
        } else
        {
            $notification = array(
                'message' => 'Invalid Order Code',
                'alert-type' => 'error'
            );
            return redirect()->route('my.orders')->with($notification);
        }

    } // End Method



}
