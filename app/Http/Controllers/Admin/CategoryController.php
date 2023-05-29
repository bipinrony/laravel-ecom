<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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
        return view('admin.category.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'required|image',
            'description' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $image = $request->file('image');
        $path = $image->store('images');
        $category->image = $path;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->save();

        // mass assignment

        // $data = array();
        // $data['name'] = $request->name;
        // $data['slug'] = Str::slug($request->name, '-');
        // $data['image'] = $path;
        // $data['description'] = $request->description;
        // $data['status'] = $request->status;

        // Category::create($data); //mass assignment
    }
}
