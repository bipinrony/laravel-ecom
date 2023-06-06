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
            'name' => 'required|unique:products,name',
            'category_id' => 'required|array',
            'sub_category_id' => 'required|array',
            'image' => 'nullable|image',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '_');
        $image = $request->file('feature_image');
        $path = $image->store('public/images/featurecategory');
        $product->feature_image = $path;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->qty_available = $request->qty_available;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->status = $request->status;

        if ($product->save()) {
            foreach ($request->category_id as $cat) {
                $productCategory = new ProductCategory();
                $productCategory->category_id = $cat;
                $productCategory->product_id = $product->id;
                $productCategory->save();
            }

            foreach ($request->sub_category_id as $subcat) {
                $productSubcategory = new ProductSubCategory();
                $productSubcategory->sub_category_id = $subcat;
                $productSubcategory->product_id = $product->id;
                $productSubcategory->save();
            }


            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $productImg = new ProductImage();
                    $path = $file->store('public/images/products');
                    $productImg->product_image = $path;
                    $productImg->product_id = $product->id;
                    $productImg->save();
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
        $productId = $product->id;
        if (!empty($product) && $product->delete()) {
            ProductCategory::where('product_id', $productId)->delete();
            ProductSubCategory::where('product_id', $productId)->delete();
            ProductImage::where('product_id', $productId)->delete();
            return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
        } else {
            return redirect()->route('admin.products')->with('error', 'Something went wrong');
        }
    }

    //edit
    public function edit(Product $product)
    {
        $data = array();
        $data['title'] = "Product";
        $data['product'] = $product;
        $data['categories'] = Category::all();
        $data['subcategories'] = SubCategory::all();
        $data['images'] = ProductImage::all();
        $data['selected_categories'] = ProductCategory::where('product_id', $product->id)
        ->pluck('category_id')->toArray();
        $data['selected_sub_categories'] = ProductSubCategory::where('product_id', $product->id)
        ->pluck('sub_category_id')->toArray();
        return view('admin.product.edit', $data);
    }

    //update
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:products,name,' .$request->id,
            'category_id'=>'required|array',
            'sub_category_id'=>'required|array',
            'image'=>'nullable|image',
       ]);

       $product = Product::find($request->id);
       $product->name = $request->name;
       $product->slug = Str::slug($request->name, '_');

       if($request->hasFile('feature_image')){
            $image = $request->file('feature_image');
            $path = $image->store('public/images/featurecategory');
            $product->feature_image = $path;
       }
      
       $product->price = $request->price;
       $product->price = $request->price;
       $product->sale_price = $request->sale_price ;
       $product->qty_available = $request->qty_available;
       $product->short_description = $request->short_description;
       $product->description = $request->description;
       $product->status = $request->status;

       if($product->save()){
           ProductCategory::where('product_id', $product->id)->delete();
           foreach($request->category_id as $cat){
               $productCategory = new ProductCategory();
               $productCategory->category_id = $cat;
               $productCategory->product_id = $product->id;
               $productCategory->save();
           }
           ProductSubCategory::where('product_id', $product->id)->delete();
           foreach($request->sub_category_id as $subcat){
               $productSubCat = new ProductSubCategory();
               $productSubCat->sub_category_id = $subcat;
               $productSubCat->product_id = $product->id;
               $productSubCat->save();
           }
           
         
           if($files=$request->file('images')){
               foreach($files as $file){
                   $productImg = new ProductImage();
                   $path = $file->store('public/images/products');
                   $productImg->product_image =$path;
                   $productImg->product_id = $product->id;
                   $productImg->save();

               }
           }
           return redirect()->route('admin.products')->with('success', 'Product updated successfully');
       } else {
           return redirect()->route('admin.products')->with('error', 'somthing went wrong');
       }
    }
}
