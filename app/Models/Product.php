<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
         return $this->hasMany(ProductCategory::class);
    }

    public function subCategory()
    {
        return $this->hasMany((ProductSubCategory::class));
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => ucwords($value),
        );
    }

    protected function shortDescription(): Attribute
    {
        return Attribute::make(
           get: fn (string $value)=> ucwords($value),
           set: fn (string $value)=> ucwords($value), 
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
         get: fn (string $value)=> ucwords($value),
         set: fn (string $value)=> ucwords($value),

        ); 
        $user = Category::find(1);
    }

    
}

