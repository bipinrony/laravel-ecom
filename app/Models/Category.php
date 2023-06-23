<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //protected $table = 'category';

    protected $appends = ['name_slug', 'product'];

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'status',
    ];

    // protected $hidden = ['status'];

    //public $timestamps = false;

    public function subCategories()
    {
        // return $this->hasMany(SubCategory::class);
        return $this->hasMany(CategorySubCategory::class);
    }

    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = ucwords($value);
    // }

    // public function getNameAttribute($value)
    // {
    //     return ucfirst($value);
    // }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => ucwords($value),
        );
    }

    public function getNameSlugAttribute()
    {
        return  $this->name . '-' . $this->slug;
    }

    public function getProductAttribute()
    {
        return  Product::all();
    }
}
