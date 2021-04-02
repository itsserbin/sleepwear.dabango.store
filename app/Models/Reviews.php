<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
        'product_id',
        'status',
    ];

    public function Product()
    {
        return $this->hasOne(Products::class, 'product_id', 'id');
    }
}
