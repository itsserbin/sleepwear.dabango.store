<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'images',
        'product_id',
    ];

    public function Products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
