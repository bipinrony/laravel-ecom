<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = "Category";
        // $data['categories'] = Category::all();

        // $categories = Category::query();
        // if ($request->search) {
        //     $categories = $categories->where('name', 'LIKE', '%' . $request->search . '%');
        // }
        // $data['categories'] = $categories->paginate(1);

        // $categories = Category::query();
        //  if ($request->search) {
        //     // $categories = $categories->where('name', 'LIKE', '%' . $request->search . '%');
        //     $categories = Category::where('name', 'LIKE', '%' . $request->search . '%')->paginate(1);
        // } else {
        //     $categories = Category::paginate(1);
        // }
        // $data['categories'] = $categories;

        return view('admin.category.index', $data);
    }

    public function categoryList()
    {
        $model = Category::all();

        return DataTables::of($model)
            ->addColumn('product_image', function ($row) {
                $product_image = "<img src='" . Storage::url($row->image) . "' alt=''
                height='75'>";
                return $product_image;
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.categories.edit', [$row->id]);
                $deleteUrl = route('admin.categories.delete', [$row->id]);
                $actionBtn = "<a href='" . $editUrl . "'><i
                class='fa fa-pencil'></i> Edit</a>
                <a href='" . $deleteUrl . "'><i
                class='fa fa-trash'></i> Delete</a>";
                return $actionBtn;
            })
            ->rawColumns(['product_image', 'action'])
            ->make(true);
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
        $path = $image->store('public/images');
        $category->image = $path;
        $category->description = $request->description;
        $category->status = $request->status;

        // mass assignment

        // $data = array();
        // $data['name'] = $request->name;
        // $data['slug'] = Str::slug($request->name, '-');
        // $data['image'] = $path;
        // $data['description'] = $request->description;
        // $data['status'] = $request->status;

        // Category::create($data); //mass assignment

        if ($category->save()) {
            return redirect()->route('admin.categories')->with('success', 'Category added successfully.');
        } else {
            return redirect()->route('admin.categories')->with('error', 'Something went wrong.');
        }
    }

    public function edit(Category $category)
    {
        $data = array();
        $data['title'] = "Category";
        $data['category'] = $category;
        return view('admin.category.edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|unique:categories,name,' . $request->id,
            'image' => 'nullable|image',
            'description' => 'required'
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/images');
            $category->image = $path;
        }
        $category->description = $request->description;
        $category->status = $request->status;


        if ($category->save()) {
            return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
        } else {
            return redirect()->route('admin.categories')->with('error', 'Something went wrong.');
        }
    }

    public function delete(Category $category)
    {
        // $category = Category::find($request->id);
        if (!empty($category) && $category->delete()) {
            return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->route('admin.categories')->with('error', 'Something went wrong.');
        }
    }
}