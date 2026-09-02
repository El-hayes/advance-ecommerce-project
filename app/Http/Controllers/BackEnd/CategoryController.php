<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // show category
    public function categoryView()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }


    // Store Category
    public function categoryStore(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required|unique:categories',
            'category_name_ar' => 'required|unique:categories',
            'category_icon' => 'required',
        ],
        [
            'category_name_en.required' => 'Please enter category name',
            'category_name_ar.required' => 'Please enter category name',
            'category_icon.required' => 'Please enter category icon',
        ]);


        Category::create([
            'category_name_en' => $request->category_name_en,
            'category_name_ar' => $request->category_name_ar,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_ar' => str_replace(' ', '-', $request->category_name_ar),
            'category_icon' => $request->category_icon
        ]);

        $notification = array(
            'message' => 'Category added successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }


    // Edit category
    public function categoryEdit($id)
    {
        $category = Category::find($id);
        return view('backend.category.category_edit', compact('category'));
    }

    // update category
    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'category_name_en' => 'required|unique:categories,category_name_en,' . $id,
            'category_name_ar' => 'required|unique:categories,category_name_ar,' . $id,
            'category_icon' => 'required',
        ], [
            'category_name_en.required' => 'Please enter category name',
            'category_name_ar.required' => 'Please enter category name',
            'category_icon.required' => 'Please enter category icon',
            ]);

        Category::findOrFail($id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_ar' => $request->category_name_ar,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_ar' => str_replace(' ', '-', $request->category_name_ar),
            'category_icon' => $request->category_icon
        ]);

        $notification = array(
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);


    }


    // delete category
    public function categoryDelete($id)
    {
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



}
