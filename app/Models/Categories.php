<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Categories extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'published',
        'preview',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'created_by',
        'modified_by'
    ];

//    /**
//     * Mutators
//     *
//     * @param $value
//     */
//    public function setSlugAttribute($value)
//    {
//        $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . "-" . Carbon::now()->format('dmyHi'), '-');
//    }

    /**
     * Get children category
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
//    public function children()
//    {
//        return $this->hasMany('App\Models\Categories', 'parent_id', 'id')
//            ->orderBy('id', 'asc')
//            ->with('children');
//    }

    /**
     * Polymorphic relation with products
     *
     * @return MorphToMany
     */
    public function products()
    {
        return $this->morphedbyMany(Products::class, 'categoryables');
    }

}
