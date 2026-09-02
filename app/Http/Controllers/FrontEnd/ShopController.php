<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shopPage()
    {
        $products = Product::query();

        // Filter By Category
        if (!empty($_GET['category'])) {

            $slugs = explode(',', $_GET['category']);

            $catIds = Category::whereIn('category_slug_en', $slugs)
                ->pluck('id')
                ->toArray();

            $products->whereIn('category_id', $catIds);
        }

        // Filter By Brand
        if (!empty($_GET['brand'])) {

            $slugs = explode(',', $_GET['brand']);

            $brandIds = Brand::whereIn('brand_slug_en', $slugs)
                ->pluck('id')
                ->toArray();

            $products->whereIn('brand_id', $brandIds);
        }

        // Status + Order
        $products = $products->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(6);

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $brands = Brand::orderBy('brand_name_en', 'ASC')->get();

        return view('frontend.shop.shop_page',
            compact('categories', 'products', 'brands'));
    }


    public function shopFilter(Request $request)
    {
        // dd($request->all());

        $data = $request->all();

        // Filter Category

        $catUrl = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category='.$category;
                }else{
                    $catUrl .= ','.$category;
                }
            } // end foreach condition
        } // end if condition



        // Filter Brand

        $brandUrl = "";
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand='.$brand;
                } else {
                    $brandUrl .= ','.$brand;
                }
            }// end foreach condition
        } // end if condition

        return redirect()->route('shop.page', $catUrl.$brandUrl);
    } // End Method



}
