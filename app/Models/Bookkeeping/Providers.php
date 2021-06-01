<?php

namespace App\Models\Bookkeeping;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
