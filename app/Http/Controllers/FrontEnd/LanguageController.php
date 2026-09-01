<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    // Arabic Language
    public function arabic()
    {
        session()->get('language');
        session()->forget('language');
        session()->put('language', 'ar');
        return redirect()->back();
    }


    // English Language
    public function english()
    {
        //dd(Session::get('language'));
        session()->get('language');
        session()->forget('language');
        session()->put('language', 'en');
        return redirect()->back();
    }

}
