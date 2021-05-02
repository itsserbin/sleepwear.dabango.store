<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status',
        'name',
        'phone',
        'sizes',
        'colors',
        'city',
        'waybill',
        'postal_office',
        'comment',
        'product_id',
        'client_id',
        'product_name',
        'trade_price',
        'sale_price',
        'pay',
        'profit',
        'created_at',
        'updated_at',
        'modified_by',
    ];


    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function Product()
    {
        return $this->belongsTo(Products::class);
    }

    public function Client()
    {
        return $this->belongsTo(Clients::class);
    }
}
