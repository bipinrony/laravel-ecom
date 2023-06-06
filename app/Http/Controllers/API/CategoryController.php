<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // $categories = Category::where('status', 1)->select('id', 'name', 'description')->get();
        // return $categories->toJson();
        // return response()->json($categories);

        $categories = Category::where('status', 1);
        if (request()->q) {
            $categories->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return  CategoryResource::collection($categories->get());
    }

    public function subCategories()
    {

        $categories = SubCategory::where('status', 1);
        if (request()->q) {
            $categories->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return  SubCategoryResource::collection($categories->get());
    }
}
