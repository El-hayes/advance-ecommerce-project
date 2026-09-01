<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    // show subCategory
    public function subCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcategories', 'categories'));
    }

    // store subCategory
    public function subCategoryStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required|unique:sub_categories,subcategory_name_en',
            'subcategory_name_ar' => 'required|unique:sub_categories,subcategory_name_ar',
        ],
        [
            'category_id.required' => 'Select Category',
            'subcategory_name_en.required' => 'Enter Sub Category Name in English',
            'subcategory_name_ar.required' => 'Enter Sub Category Name in Arabic',
        ]);


        SubCategory::create([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ar' => $request->subcategory_name_ar,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_ar' => str_replace(' ', '-', $request->subcategory_name_ar)
        ]);

        $notification = array(
            'message' => 'Sub Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }

    //  Edit subcategory
    public function subCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategory = SubCategory::find($id);
        return view('backend.category.subcategory_edit', compact('subcategory', 'categories'));
    }


    // update subcategory
    public function subCategoryUpdate(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required|unique:sub_categories,subcategory_name_en,' . $id,
            'subcategory_name_ar' => 'required|unique:sub_categories,subcategory_name_ar,' . $id,
        ],
            [
                'category_id.required' => 'Select Category',
                'subcategory_name_en.required' => 'Enter Sub Category Name in English',
                'subcategory_name_ar.required' => 'Enter Sub Category Name in Arabic',
            ]);


        SubCategory::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ar' => $request->subcategory_name_ar,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_ar' => str_replace(' ', '-', $request->subcategory_name_ar)
        ]);

        $notification = array(
            'message' => 'Sub Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subcategory')->with($notification);


    }


    // Delete subCategory
    public function subCategoryDelete($id)
    {
        SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }




    /////////////////////  sub sub Category Methods ///////////////////


    public function subSubCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcategories = SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view', compact('subsubcategories', 'categories'));
    }



    // Fetch subcategories for a specific category

    public function GetSubCategory($category_id){

        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }
    // Fetch subsubcategories for a specific subcategory

    public function GetSubSubCategory($subcategory_id){

        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
    }


    //

    // store subCategory
    public function subSubCategoryStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required|unique:sub_sub_categories,subsubcategory_name_en',
            'subsubcategory_name_ar' => 'required|unique:sub_sub_categories,subsubcategory_name_ar',
        ],
            [
                'category_id.required' => 'Select Category',
                'subcategory_id' => 'Select Sub Category',
                'subsubcategory_name_en.required' => 'Enter Sub Category Name in English',
                'subsubcategory_name_ar.required' => 'Enter Sub Category Name in Arabic',
            ]);


        SubSubCategory::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_ar' => $request->subsubcategory_name_ar,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_ar' => str_replace(' ', '-', $request->subsubcategory_name_ar)
        ]);

        $notification = array(
            'message' => 'Sub Sub Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }

    // Edit Sub-SubCategory
    public function subSubCategoryEdit($id)
    {

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $current_subsubcat = SubSubCategory::find($id);   // get subsubcategory id to select specific sub category
        $subcategories = SubCategory::where('category_id' , $current_subsubcat->category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        $sub_subcategory = SubSubCategory::find($id);
        return view('backend.category.sub_subcategory_edit', compact('categories','subcategories' ,'sub_subcategory'));
    }

    // Update Sub-SubCategory
    public function subSubCategoryUpdate(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required|unique:sub_sub_categories,subsubcategory_name_en,'. $id,
            'subsubcategory_name_ar' => 'required|unique:sub_sub_categories,subsubcategory_name_ar,'. $id,
        ],
            [
                'category_id.required' => 'Select Category',
                'subcategory_id' => 'Select Sub Category',
                'subsubcategory_name_en.required' => 'Enter Sub Category Name in English',
                'subsubcategory_name_ar.required' => 'Enter Sub Category Name in Arabic',
            ]);

        SubSubCategory::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_ar' => $request->subsubcategory_name_ar,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_ar' => str_replace(' ', '-', $request->subsubcategory_name_ar)
        ]);

        $notification = array(
            'message' => 'Sub Sub Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.subsubcategory')->with($notification);

    }

    // Delete Sub sub category
    public function subSubCategoryDelete($id)
    {
        SubSubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub Sub Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }



}
