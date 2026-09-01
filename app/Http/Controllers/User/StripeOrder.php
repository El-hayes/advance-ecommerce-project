<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Cart;
use Auth;
use Carbon\Carbon;

class StripeOrder extends Controller
{
    public function stripeOrder(Request $request){

        if(Session::has('coupon')) {
            $total_amount = round( Session::get('coupon')['total_amount']);
        } else {
            $total_amount = round(Cart::total());
        }

        // Set your secret key. Remember to switch to your live secret key in production.

       // \Stripe\Stripe::setApiKey('sk_test_51SMn7lLlRrDqsxXM4aFYVEo28Sse0fZmrCGfm905SEQs5t1bn1zsKxmWS3zVYsp3bmXtVPViXr2iTLzdh9jvOTze00SHAc7vqf');
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100,
            'currency' => 'EGP',
            'description' => 'Easy Online Store',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        //dd($charge);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => $charge->payment_method,
            'payment_method' => 'stripe',
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);


        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);

        } // End foreach


        // Start Send Email
            $invoice = Order::findOrfail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'amount' => $total_amount,
                'name' => $invoice->name,
                'email' => $invoice->email,
                'payment_method' => $invoice->payment_method,
            ];

            Mail::to($invoice->email)->send(new OrderMail($data));
        // End Send Email


        // Remove session after payment
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        // Empty cart after payment
        Cart::destroy();

        $notification = array(
            'message' => 'Order placed successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);


    } // End Method



}
