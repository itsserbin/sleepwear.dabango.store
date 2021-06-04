<?php

namespace App\Models\Bookkeeping;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Providers
 * @package App\Models\Bookkeeping
 */
class Providers extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'catalog',
        'availability',
        'refunds',
        'prepayment',
        'time_of_dispatch',
        'comment',
        'contacts',
        'created_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Relation with Products.
     *
     * @return HasOne
     */
    public function Products()
    {
        return $this->hasOne(Products::class);
    }
}
