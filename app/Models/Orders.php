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
        'nova_poshta',
        'comment',
        'product_id',
        'client_id',
        'product_name',
        'trade_price',
        'sale_price',
        'profit',
        'created_at',
        'updated_at',
    ];


    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
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
