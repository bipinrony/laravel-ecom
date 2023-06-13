<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    // protected $appends = ['total_product_count'];

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'image',
        'description',
        'status',
    ];

    public function categories()
    {
        // return $this->belongsTo('App\Models\Category', 'category_id', 'id');
        return $this->hasMany(CategorySubCategory::class);
    }

    // public function getTotalProductCountAttribute()
    // {
    //     return ProductSubCategory::where('sub_category_id', $this->id)->count();
    // }
}
