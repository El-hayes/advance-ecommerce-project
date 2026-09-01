<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class SliderController extends Controller
{

    // slider view
    public function sliderView()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));
    }
    // End slider view


    // Start Slider Store
    public function sliderStore(Request $request)
    {
        $request->validate([
            'slider_img' => 'required',
        ],
        [
            'slider_img.required' => 'Please upload a slider image',
        ]);


        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image)->resize(870, 370)->save('upload/slider/' . $name_gen);
        $save_url = 'upload/slider/' . $name_gen;

        Slider::create([
            'title' => $request->slider_title,
            'description' => $request->slider_description,
            'slider_img' => $save_url,
        ]);

        $notification = array(
            'message' => 'Slider Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    // End Slider Score


    // Start slider Edit
    public function sliderEdit($id)
    {
        $slider = Slider::find($id);
        return view('backend.slider.slider_edit', compact('slider'));
    }
    // End slider Edit


    // Start slider Update
    public function sliderUpdate(Request $request, $id)
    {

        $old_img = $request->old_img;

        if ($request->file('slider_img'))
        {
            unlink($old_img);
            $image = $request->file('slider_img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image)->resize(870, 370)->save('upload/slider/' . $name_gen);
            $save_url = 'upload/slider/' . $name_gen;

            Slider::findOrFail($id)->update([
                'title' => $request->slider_title,
                'description' => $request->slider_des,
                'slider_img' => $save_url,
            ]);

            $notification = array(
                'message' => 'Slider Updated With Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('manage.slider')->with($notification);

        } else
        {
            Slider::findOrFail($id)->update([
                'title' => $request->slider_title,
                'description' => $request->slider_des,
            ]);

            $notification = array(
                'message' => 'Slider Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('manage.slider')->with($notification);
        }

    }
    // End Slider Update



    // Start Delete Slider
    public function sliderDelete($id)
    {
        $slider = Slider::findOrFail($id)->slider_img;
        unlink($slider);

        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // End Delete Slider


    // Start inactive slider
    public function sliderInactive($id)
    {
        Slider::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Slider Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    //End inactive slider


    // Start Slider Active
    public function sliderActive($id)
    {
        Slider::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Slider Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // End Slider Active



} // End Class
