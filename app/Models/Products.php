<?php

namespace App\Models;

use App\Models\Bookkeeping\Providers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


/**
 * Class Products
 * @package App\Models
 *
 * @property ProductsPhoto $productsPhoto
 * @property Providers $providers
 * @property ProductsColor $productsColor
 * @property Clients $clients
 * @property Reviews $reviews
 * @property Orders $orders
 */

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
        'size_table',
        'price',
        'sale_price',
        'discount_price',
        'preview',
        'images',
        'category_id',
        'total_sales',
    ];

    /**
     * Relations with photo.
     *
     * @return HasMany
     */
    public function ProductsPhoto()
    {
        return $this->hasMany('App\Models\ProductsPhoto', 'product_id', 'id');
    }

    /**
     * Relation with providers.
     *
     * @return BelongsTo
     */
    public function Providers()
    {
        return $this->belongsTo(Providers::class,'provider_id');
    }

    /**
     * Relations with colors.
     *
     * @return HasMany
     */
    public function ProductsColor()
    {
        return $this->hasMany(ProductsColor::class, 'product_id');
    }

    /**
     * Relations with Client.
     *
     * @return HasMany
     */
    public function Client()
    {
        return $this->hasMany(Clients::class,);
    }

    /**
     * Relations with Reviews
     *
     * @return HasMany
     */
    public function Reviews()
    {
        return $this->hasMany(Reviews::class,'product_id');
    }

    /**
     * Relations with Order
     *
     * @return HasOne
     */
    public function Order()
    {
        return $this->hasOne(Orders::class,'product_id');
    }

    /**
     * Polymorphic relation with categories
     *
     * @return MorphToMany
     */
    public function categories()
    {
        return $this->morphToMany('App\Models\Categories','categoryables');
    }
}
