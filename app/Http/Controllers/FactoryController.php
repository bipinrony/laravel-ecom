<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    public function index()
    {
        // $category = Category::factory()->make();

        // $category = Category::factory()->count(3)->inactive()->make();

        // $category = Category::factory()->count(3)->make([
        //     'name' => 'Abigail Otwell',
        // ]);

        // $category = Category::factory()->create();
        // $category = Category::factory()->create();
        $category = Category::factory()->has(SubCategory::factory()->count(3))->create();

        dd($category);
    }
}
