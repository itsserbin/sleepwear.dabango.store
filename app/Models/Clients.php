<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'status',
        'name',
        'phone',
    ];

    public function Product()
    {
        return $this->hasMany(Products::class, 'product', 'id');
    }
}
