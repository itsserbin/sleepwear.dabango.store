<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule',
        'email',
        'phone',
        'facebook',
        'instagram',
        'telegram',
        'viber',
        'whatsapp',
        'fb_messenger',
        'head_scripts',
        'after_body_scripts',
        'footer_scripts',
    ];
}
