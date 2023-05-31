<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //protected $table = 'category';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'status',
    ];

    //public $timestamps = false;

    public function subCategories()
    {
        return $this->hasOne(SubCategory::class);
    }
}
