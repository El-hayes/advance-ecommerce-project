<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{

    // Add Product
    public function productAdd()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.product_add', compact('brands', 'categories'));
    }


    // Store prodeuct

    public function productStore(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_name_en' => 'required',
            'product_name_ar' => 'required',
            'product_code' => 'required',
            'product_qty' => 'required',
            'product_tags_en' => 'required',
            'product_tags_ar' => 'required',
            /*'product_size_en' => 'required',
            'product_size_ar' => 'required',*/
            'product_color_en' => 'required',
            'product_color_ar' => 'required',
            'selling_price' => 'required',
            'product_thambnail' => 'required',
            'multi_img' => 'required',
            'short_descp_en' => 'required',
            'short_descp_ar' => 'required',
            'long_descp_en' => 'required',
            'long_descp_ar' => 'required',
            'digital_file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:2048',

        ],
        [
            'brand_id.required' => 'Please select a brand',
            'category_id.required' => 'Please select a category',
            'subcategory_id.required' => 'Please select a subcategory',
            'subsubcategory_id.required' => 'Please select a subcategory'
        ]);


        // Handling if product include digital file
        $digital_item  = 'NULL';
        if($file = $request->file('digital_file'))
        {
            $destinationPath = 'upload/products/digital_files';
            $digital_item = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $digital_item);
        }



        // handle thambnail image
        $image = $request->file('product_thambnail');
        $gen_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $manager->read($image)->resize(917, 1000)->save(public_path('upload/products/thambnail/' . $gen_name));
        $save_url = 'upload/products/thambnail/' . $gen_name;


        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ar' => $request->product_name_ar,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ar' => str_replace(' ', '-', $request->product_name_ar),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ar' => $request->product_tags_ar,
            'product_size_en' => $request->product_size_en,
            'product_size_ar' => $request->product_size_ar,
            'product_color_en' => $request->product_color_en,
            'product_color_ar' => $request->product_color_ar,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ar' => $request->short_descp_ar,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ar' => $request->long_descp_ar,

            'product_thambnail' => $save_url,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'digital_file' => $digital_item,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);


        ////////// Multiple Image Upload Start ///////////

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $manager2 = new ImageManager(new Driver());
            $manager2->read($img)->resize(917, 1000)->save(public_path('upload/products/multi-image/' . $make_name));
            $upload_path = 'upload/products/multi-image/'. $make_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $upload_path,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Product added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);

    }

    // Manage Product
    public function manageProduct(){
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }


    // Edit Product
    public function productEdit($id)
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        $subsubcategories = Subsubcategory::latest()->get();
        $product = Product::findOrFail($id);

        $multiImgs = MultiImg::where('product_id',$id)->get();
        return view('backend.product.product_edit',
            compact('brands', 'categories', 'subcategories', 'subsubcategories', 'product', 'multiImgs'));
    } // End function


    // update product without Images
    public function productUpdate(Request $request, $id)
    {
        $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'product_name_en' => 'required',
            'product_name_ar' => 'required',
            'product_code' => 'required',
            'product_qty' => 'required',
            'product_tags_en' => 'required',
            'product_tags_ar' => 'required',
            /*'product_size_en' => 'required',
            'product_size_ar' => 'required',*/
            'product_color_en' => 'required',
            'product_color_ar' => 'required',
            'selling_price' => 'required',
            'short_descp_en' => 'required',
            'short_descp_ar' => 'required',
            'long_descp_en' => 'required',
            'long_descp_ar' => 'required',

        ],
            [
                'brand_id.required' => 'Please select a brand',
                'category_id.required' => 'Please select a category',
                'subcategory_id.required' => 'Please select a subcategory',
                'subsubcategory_id.required' => 'Please select a subcategory'
            ]);


         Product::findOrFail($id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ar' => $request->product_name_ar,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ar' => str_replace(' ', '-', $request->product_name_ar),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ar' => $request->product_tags_ar,
            'product_size_en' => $request->product_size_en,
            'product_size_ar' => $request->product_size_ar,
            'product_color_en' => $request->product_color_en,
            'product_color_ar' => $request->product_color_ar,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ar' => $request->short_descp_ar,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ar' => $request->long_descp_ar,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => 1,
            'updated_at' => Carbon::now(),

        ]);


        $notification = array(
            'message' => 'Product updated without images successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }  // End update product without Images


    /// Multiple Image Update
    public function multiImageUpdate(Request $request){
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            $manager3 = new ImageManager(new Driver());
            $manager3->read($img)->resize(917, 1000)->save(public_path('upload/products/multi-image/' . $make_name));
            $uploadPath = 'upload/products/multi-image/'. $make_name;

            MultiImg::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);

        } // end foreach

        $notification = array(
            'message' => 'Product Image Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    } // end mehtod


    // Start Update Product thambnail image
    public function thambnailImageUpdate(Request $request, $id)
    {
        $old_img = Product::find($id)->product_thambnail;
        unlink($old_img);

        // handle thambnail image
        $image = $request->file('product_thambnail');
        $gen_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $manager->read($image)->resize(917, 1000)->save(public_path('upload/products/thambnail/' . $gen_name));
        $save_url = 'upload/products/thambnail/' . $gen_name;

        Product::findOrFail($id)->update([
            'product_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Image Thumbnail Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);

    }
    // End  Update Product thambnail image



    // Start Multi Image Delete
    public function multiImageDelete($id)
    {
        $old_img = MultiImg::findOrFail($id)->photo_name;
        unlink($old_img);

        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // End Multi Image Delete


    // Start Make Product Inactive
    public function productInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // End Make Product Inactive


    // Start Make Product active
    public function productactive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // End Make Product active



    // Start Delete product
    public function productDelete($id)
    {
         $product = Product::findOrFail($id);
         unlink($product->product_thambnail);
         $product->delete();

         $images = MultiImg::where('product_id', $id)->get();
         foreach ($images as $image) {
             unlink($image->photo_name);
             $image->delete();   // = MultiImg::where('product_id', $id)->delete();
         }

         $notification = array(
             'message' => 'Product Deleted Successfully',
             'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }
    // End Delete Product






    // product Stock
    public function productStock()
    {

        $products = Product::latest()->get();
        return view('backend.product.product_stock', compact('products'));


    } //End Method




 }
