<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class CartItems
 * @package App\Models
 *
 * @property int $id
 * @property int $cart_id
 * @property int $product_id
 * @property int $count
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Cart $cart
 * @property Products $products
 */
class CartItems extends Model
{
    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'cart_items';

    /**
     * Using timestamp
     *
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = [
        'hash',
        'cart_id',
        'product_id',
        'provider_id',
        'count',
        'color',
        'size',
        'trade_price',
        'sale_price',
        'profit',
        'pay',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'color' => 'array',
        'size' => 'array',
    ];

    /**
     * Relation with cart.
     *
     * @return HasOne
     */
    public function cart()
    {
        return $this->hasOne('App\Models\Cart', 'id', 'cart_id');
    }

    /**
     * Relation with product.
     *
     * @return HasOne
     */
    public function product()
    {
        return $this->hasOne('App\Models\Products', 'id', 'product_id');
    }
}
