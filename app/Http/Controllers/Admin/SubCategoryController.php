<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySubCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = "Subcategory";
        $data['subcategories'] = SubCategory::all();
        return view('admin.subcategory.index', $data);
    }

    public function create()
    {
        $data = array();
        $data['title'] = "Subcatagory";
        $data['categories'] = Category::all();
        return view('admin.subcategory.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name',
            // 'category_id' => 'required|exists:categories,id',
            'category_id' => 'required|array',
            'image' => 'required|image',
        ]);

        $subcategory = new SubCategory();
        // $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name, '_');

        $image = $request->file('image');
        $path = $image->store('public/images/subcategory');

        $subcategory->image = $path;
        $subcategory->description = $request->description;
        $subcategory->status = $request->status;

        if ($subcategory->save()) {
            foreach ($request->category_id as $cat) {
                $catSubCat = new CategorySubCategory();
                $catSubCat->category_id = $cat;
                $catSubCat->sub_category_id = $subcategory->id;
                $catSubCat->save();
            }
            return redirect()->route('admin.sub_categories')
                ->with('success', 'Subcategory added successfully');
        } else {
            return redirect()->route('admin.sub_categories')
                ->with('error', 'Something went wrong');
        }
    }
}
