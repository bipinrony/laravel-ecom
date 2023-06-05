<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductSubCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{  
    public function index()
    {
        $data = array();
        $data['title'] = "Products";
        $data['products'] = Product::all();
        return view('admin.product.index', $data);
    }

    //Show create view
    public function create()
    {
        $data = array();
        $data['title'] = "Product";
        $data['categories'] = Category::all();
        $data['subcategories'] = SubCategory::all();
        return view('admin.product.create', $data); 
    }

    // Store data
    public function store(Request $request)
    {
        $request->validate([
             'name'=>'required|unique:products,name',
             'category_id'=>'required|array',
             'sub_category_id'=>'required|array',
             'image'=>'nullable|image',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '_');
        $product->price = $request->price;
        $product->sale_price = $request->sale_price ;
        $product->qty_available = $request->qty_available;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->status = $request->status;

        if($product->save()){
            foreach($request->category_id as $cat){
                $productcategory = new ProductCategory();
                $productcategory->category_id = $cat;
                $productcategory->product_id = $product->id;
                $productcategory->save();
            }

            foreach($request->sub_category_id as $subcat){
                $productsubcat = new ProductSubCategory();
                $productsubcat->sub_category_id = $subcat;
                $productsubcat->product_id = $product->id;
                $productsubcat->save();
            }
            
           
            if($files=$request->file('images')){
                foreach($files as $file){
                    $productimg = new ProductImage();
                    $path = $file->store('public/images/products');
                    $productimg->product_image =$path;
                    $productimg->product_id = $product->id;
                    $productimg->save();

                }
            }
            return redirect()->route('admin.products')->with('success', 'Product added successfully');
        } else {
            return redirect()->route('admin.products')->with('error', 'somthing went wrong');
        }
    }

    //delete
    public function delete(Product $product)
    {
        $productid = $product->id;
        if(!empty($product) && $product->delete()){
            ProductCategory::where('product_id', $productid)->delete();
            ProductSubCategory::where('product_id', $productid)->delete();
            ProductImage::where('product_id', $productid)->delete();
            return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
        } else {
            return redirect()->route('admin.products')->with('error', 'Something went wrong');
        }
    }
}


