<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

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
}
