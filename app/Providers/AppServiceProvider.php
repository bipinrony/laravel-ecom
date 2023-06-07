<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setCategories();
        $this->setProducts();
    }

    public function setCategories()
    {
        $categories = Category::where('status', 1)->get();
        View::share('header_categories', $categories);
    }

    public function setProducts()
    {
        $products = Product::where('status', 1)->get();
        View::share('products', $products);
    }
}
