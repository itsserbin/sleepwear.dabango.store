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
        'price',
        'sale_price',
        'discount_price',
        'preview',
        'images',
    ];

    public function ProductsPhoto()
    {
        return $this->hasMany('App\Models\ProductsPhoto', 'product_id', 'id');
    }

    public function ProductsColor()
    {
        return $this->hasMany(ProductsColor::class, 'product_id');
    }

    public function Client()
    {
        return $this->hasMany(Clients::class,);
    }

    public function Reviews()
    {
        return $this->hasMany(Reviews::class, 'product_id');
    }

    public function Order()
    {
        return $this->hasOne(Orders::class,'product_id');
    }
}
