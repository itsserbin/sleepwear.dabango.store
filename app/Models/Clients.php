<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'comment',
        'status',
        'name',
        'phone',
        'number_of_purchases',
        'whole_check',
        'average_check',
    ];


//    public function setPhoneAttribute($value)
//    {
//        return $this->attributes['phone'] = preg_replace('/[^0-9]/','', $value);
//    }

    public function Product()
    {
        return $this->hasMany(Products::class);
    }

    public function Orders()
    {
        return $this->hasMany(Orders::class,'client_id');
    }
}
