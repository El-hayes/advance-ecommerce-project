<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

class OrderController extends Controller
{
    public function pendingOrders() {

        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();

        return view('backend.orders.pending_orders', compact('orders'));

    } // End Method


    public function pendingOrdersDetails($order_id)
    {
        $order = Order::where('id', $order_id)->orderBy('id', 'DESC')->first();
        $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('backend.orders.pending_orders_details', compact('order', 'orderItems'));

    }  // End method


    // Confirmed Orders
    public function confirmedOrders()
    {
        $orders = Order::where('status', 'confirm')->orderBy('id', 'DESC')->get();

        return view('backend.orders.confirmed_orders', compact('orders' ));

    }  // End method

    // Processing Orders
    public function processingOrders(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('backend.orders.processing_orders',compact('orders'));

    } // end method


    // Picked Orders
    public function pickedOrders(){
        $orders = Order::where('status','picked')->orderBy('id','DESC')->get();
        return view('backend.orders.picked_orders',compact('orders'));

    } // end method



    // Shipped Orders
    public function shippedOrders(){
        $orders = Order::where('status','shipped')->orderBy('id','DESC')->get();
        return view('backend.orders.shipped_orders',compact('orders'));

    } // end method


    // Delivered Orders
    public function deliveredOrders(){
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
        return view('backend.orders.delivered_orders',compact('orders'));

    } // end method


    // Cancel Orders
    public function cancelOrders(){
        $orders = Order::where('status','cancel')->orderBy('id','DESC')->get();
        return view('backend.orders.cancel_orders',compact('orders'));

    } // end method



    // pending To Confirm Order
    public function pendingToConfirmOrder($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'confirm']);

        $notification = array(
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending-orders')->with($notification);
    } // End Method


    // Confirm To Processing Order
    public function confirmToProcessingOrder($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'processing']);

        $notification = array(
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('confirmed-orders')->with($notification);
    } // End Method

    public function processingToPickedOrder($order_id){

        Order::findOrFail($order_id)->update(['status' => 'picked']);

        $notification = array(
            'message' => 'Order Picked Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('processing-orders')->with($notification);


    } // end method


    public function pickedToShippedOrder($order_id){

        Order::findOrFail($order_id)->update(['status' => 'shipped']);

        $notification = array(
            'message' => 'Order Shipped Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('picked-orders')->with($notification);


    } // end method


    public function shippedToDeliveredOrder($order_id){

        $items = OrderItem::where('order_id', $order_id)->get();


        DB::transaction(function () use ($items) {
            foreach ($items as $item) {
                Product::where('id', $item->product_id)
                    ->where('product_qty', '>=', $item->qty) // safety
                    ->decrement('product_qty', $item->qty);
            }
        });

        Order::findOrFail($order_id)->update(['status' => 'delivered']);

        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('shipped-orders')->with($notification);


    } // end method


    public function deliveredToCancelOrder($order_id){
       Order::findOrFail($order_id)->update(['status' => 'cancel']);

        $notification = array(
            'message' => 'Order Cancelled Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('delivered-orders')->with($notification);

    } // End Method


    // Admin download invoice for confirmed orders
    public function adminInvoiceDownload($order_id)
    {
        $order = Order::where('id', $order_id)->orderBy('id', 'desc')->first();
        $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id', 'desc')->get();


        $pdf = Pdf::loadView('backend.orders.order_invoice',
            compact('order', 'orderItems'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    } // End method



}
