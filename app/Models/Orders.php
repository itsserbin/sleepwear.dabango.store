<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Orders
 * @package App\Models
 */
class Orders extends Model
{
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

    /**
     * Relation with Products.
     *
     * @return BelongsTo
     */
    public function Product()
    {
        return $this->belongsTo(Products::class);
    }

    /**
     * Relation with Clients.
     *
     * @return BelongsTo
     */
    public function Clients()
    {
        return $this->belongsTo(Clients::class,'client_id');
    }
}
