<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'order_items';

    /**
     * Using timestamp
     *
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = [
        'hash',
        'order_id',
        'product_id',
        'count',
        'color',
        'size',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'color' => 'array',
        'size' => 'array',
    ];

    /**
     * Relation with Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne('App\Models\Products', 'id', 'product_id');
    }

    public function provider()
    {
        return $this->hasOne('App\Models\Bookkeeping\Providers', 'id', 'provider_id');
    }
}
