<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySubCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
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

    public function shop($categorySlug = null, $subCategorySlug = null)
    {
        $data = array();
        $data['title'] = "Shop";
        $products = Product::where('status', 1);
        if (!is_null($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $productsIds = ProductCategory::where('category_id', $category->id)->pluck('product_id')->toArray();
            if (!empty($productsIds)) {
                $products = $products->whereIn('id', $productsIds);
            }
        }

        if (!is_null($categorySlug) && !is_null($subCategorySlug)) {
            $subCategory = SubCategory::where('slug', $subCategorySlug)->firstOrFail();
            $productsIds = ProductSubCategory::where('sub_category_id', $subCategory->id)->pluck('product_id')->toArray();
            if (!empty($productsIds)) {
                $products = $products->whereIn('id', $productsIds);
            }
        }
        $products = $products->get();
        $data['products'] =  $products;
        return view('frontend.shop', $data);
    }
}
