<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status',
        'title',
        'description',
        'h1',
        'content',
        'characteristics',
        'cost',
        'sale_cost',
        'preview',
        'images',
    ];

    public function ProductsPhoto()
    {
        return $this->hasMany('App\Models\ProductsPhoto', 'product_id', 'id');
    }

    public function ProductsColor()
    {
        return $this->hasMany('App\Models\ProductsColor', 'product_id', 'id');
    }

    public function Clients()
    {
        return $this->hasMany(Clients::class, 'product', 'id');
    }

    public function Reviews()
    {
        return $this->hasMany(Reviews::class, 'product_id');
    }
}
