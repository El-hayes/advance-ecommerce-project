<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Models\Seo;

class SiteSettingController extends Controller
{

    public function siteSetting(){

        $setting = SiteSetting::find(1);
        return view('backend.setting.setting_update',compact('setting'));
    } // End Method



    public function siteSettingUpdate(Request $request, $id)
    {
        if ($request->file('logo')) {

            $logo = SiteSetting::findOrFail($id)->logo;
            @unlink(public_path($logo));

            // post image handel
            $image = $request->file('logo');
            $gen_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $manager->read($image)->resize(139,36)->save(public_path('upload/logo/' . $gen_name));
            $save_url = 'upload/logo/' . $gen_name;

            SiteSetting::findOrFail($id)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'logo' => $save_url,

            ]);

            $notification = array(
                'message' => 'Setting Updated with Image Successfully',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);

        }else{

            SiteSetting::findOrFail($id)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,


            ]);

            $notification = array(
                'message' => 'Setting Updated Successfully',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);

        } // end else

    }  // End Method


    // Seo setting
    public function seoSetting()
    {
        $seo = Seo::find(1);
        return view('backend.setting.seo_update', compact('seo'));
    } // End Method


    public function seoSettingSetting(Request $request, $id)
    {

        Seo::findOrFail($id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,

        ]);

        $notification = array(
            'message' => 'Seo Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    } // End Method


}
