<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class BrandController extends Controller
{

    // all brand
    public function brandView()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    // store brand
    public function brandStore(Request $request)
    {
        $request->validate([
            'brand_name_en' => 'required|unique:brands',
            'brand_name_ar' => 'required|unique:brands',
            'brand_img' => 'required|mimes:jpg,jpeg,png,webp',
        ],
        [
            'brand_name_en.required' => 'Please enter brand name in English',
            'brand_name_ar.required' => 'Please enter brand name in Arabic',
            'brand_img.required' => 'Please upload brand image',
        ]);

        $image = $request->file('brand_img');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image)->resize(300, 300)->save('upload/brands/' . $name_gen);
        $save_url = 'upload/brands/' . $name_gen;

        Brand::create([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_ar' => $request->brand_name_ar,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_ar' => str_replace(' ', '-', $request->brand_name_ar),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand added successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }


    // Edit brand
    public function brandEdit($id)
    {
        $brand = Brand::find($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    // brand update
    public function brandUpdate(Request $request, $id)
    {
        $request->validate([
            'brand_name_en' => 'required|unique:brands,brand_name_en,' . $id,
            'brand_name_ar' => 'required|unique:brands,brand_name_ar,' . $id,
            'brand_img' => 'mimes:jpg,jpeg,png,webp',
        ],
            [
                'brand_name_en.required' => 'Please enter brand name in English',
                'brand_name_ar.required' => 'Please enter brand name in Arabic',
            ]);

        $old_img = $request->old_img;
        if ($request->file('brand_img'))
        {
            @unlink($old_img);
            $image = $request->file('brand_img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image)->resize(300, 300)->save('upload/brands/' . $name_gen);
            $save_url = 'upload/brands/' . $name_gen;

            Brand::findOrFail($id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ar' => $request->brand_name_ar,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ar' => str_replace(' ', '-', $request->brand_name_ar),
                'brand_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Brand updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);

        } else
        {
            Brand::findOrFail($id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ar' => $request->brand_name_ar,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ar' => str_replace(' ', '-', $request->brand_name_ar),
            ]);
            $notification = array(
                'message' => 'Brand updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);
        }


    }


    // delete brand
    public function brandDelete($id)
    {
        $brand = Brand::findOrFail($id)->brand_image;
        @unlink($brand);

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }




}
