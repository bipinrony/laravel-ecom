<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = "Category";
        $data['categories'] = Category::all();

        return view('admin.category.index', $data);
    }

    public function create()
    {
        $data = array();
        $data['title'] = "Category";
        return view('admin.category.create');
    }
}