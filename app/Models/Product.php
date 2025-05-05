<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'category_id', 'stock', 'description', 'image', 'size', 'color'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
