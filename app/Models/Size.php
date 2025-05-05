<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    // Relación muchos a muchos con productos
    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('stock');
    }
}