<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySubCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = "Home";
        // $categories = DB::table('categories')->where('status', 1)->get();
        // $data['categories'] = $categories = Category::where('status', 1)->get();
        // foreach ($categories as $category) {
        //     $subQuery = CategorySubCategory::where('category_id', $category->id)->pluck('sub_category_id')->toArray();
        //     $subCateData = SubCategory::whereIn(
        //         'id',
        //         $subQuery
        //     )->get();

        //     $category->sub_categories = $subCateData;
        // }
        return view('frontend.home', $data);
    }

    public function shop()
    {
        $data = array();
        $data['title'] = "Home";
        $data['categories'] = Category::where('status', 1)->get();
        return view('frontend.shop', $data);
    }
}
