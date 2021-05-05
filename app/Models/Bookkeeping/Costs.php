<?php

namespace App\Models\Bookkeeping;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costs extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'sum',
        'total',
        'user_id',
        'comment',
        'date',
        'created_at',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
    ];

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
