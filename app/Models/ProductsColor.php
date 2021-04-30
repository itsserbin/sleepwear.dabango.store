<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'color',
        'product_id',
    ];

    public function Products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function Colors()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }
}
