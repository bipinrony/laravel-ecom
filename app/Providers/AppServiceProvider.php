<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
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
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        $this->setCategories();
      
    }

    public function setCategories()
    {
        $categories = Category::where('status', 1)->get();
        View::share('header_categories', $categories);
    }
}