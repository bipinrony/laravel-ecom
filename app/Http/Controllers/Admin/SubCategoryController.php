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
        // $subQuery = SubCategory::where('status', 1)->pluck('id')->toArray();
        // $data = CategorySubCategory::whereIn(
        //     'sub_category_id',
        //     $subQuery
        // )->get();
        // dd($data);
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

    public function edit(SubCategory $subCategory)
    {
        $data = array();
        $data['title'] = "Subcatagory";
        $data['sub_category'] = $subCategory;
        $data['categories'] = Category::all();
        // $data['selected_categories'] = CategorySubCategory::where('sub_category_id', $subCategory->id)->get();
        // $selected_categories = CategorySubCategory::where('sub_category_id', $subCategory->id)->get();
        // $temp = [];
        // foreach ($selected_categories as $selected_category) {
        //     array_push($temp, $selected_category->category_id);
        // }
        // $data['selected_categories'] = $temp;

        $data['selected_categories'] = CategorySubCategory::where('sub_category_id', $subCategory->id)
            ->pluck('category_id')
            ->toArray();

        return view('admin.subcategory.edit', $data);
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

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name,' . $request->id,
            'category_id' => 'required|array',
        ]);

        $subcategory = SubCategory::find($request->id);
        // $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name, '-');
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $path = $image->store('public/images/subcategory');

            $subcategory->image = $path;
        }
        $subcategory->description = $request->description;
        $subcategory->status = $request->status;

        if ($subcategory->save()) {
            CategorySubCategory::where('sub_category_id', $subcategory->id)->delete();

            foreach ($request->category_id as $cat) {
                // $catSubCat = CategorySubCategory::where('category_id', $cat)->where('sub_category_id', $subcategory->id)->first();
                // if (empty($catSubCat)) {
                //     $catSubCat = new CategorySubCategory();
                //     $catSubCat->category_id = $cat;
                //     $catSubCat->sub_category_id = $subcategory->id;
                //     $catSubCat->save();
                // }

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
