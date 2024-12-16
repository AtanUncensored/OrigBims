<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barangay_id',
        'title',
        'imgUrl',
        'announcement_date',
        'content', 
        'expiration_date',
        'is_global', 

    ];

    protected $casts = [
        'announcement_date' => 'datetime',
        'expiration_date' => 'datetime', 
    ];
}
