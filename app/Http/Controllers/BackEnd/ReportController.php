<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function reportView()
    {
        return view('backend.report.report_view');
    } // End Method

    // report By Date
    public function reportByDate(Request $request)
    {
       // return $request->all();
        $date = new DateTime($request->date);
        $formated_date = $date->format('d F Y');

        $orders = Order::where('order_date', $formated_date)->latest()->get();
        return view('backend.report.report_show', compact('orders'));

    } // End Method


    // report By Month
    public function reportByMonth(Request $request)
    {
        $orders = Order::where('order_month', $request->month)->where('order_year',$request->year_name)->latest()->get();
        return view('backend.report.report_show', compact('orders'));
    } // End method


    // Report By Year
    public function reportByYear(Request $request)
    {
        $orders = Order::where('order_year',$request->year)->latest()->get();
        return view('backend.report.report_show',compact('orders'));
    }  // End Method




}
