<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $products Products
 */
class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
        'product_id',
        'status',
    ];

    public function Products()
    {
        return $this->belongsTo(Products::class,'product_id');
    }
}
