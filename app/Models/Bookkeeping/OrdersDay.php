<?php

namespace App\Models\Bookkeeping;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
    ];

    protected $dates = [
        'date'
    ];

    public function setDateAttribute($value)
    {
        $this->attributes['date'] =  Carbon::parse($value);
    }
}
