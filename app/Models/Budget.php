<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barangay_id',
        'item',
        'cost',
        'description',
        'period_from',
        'period_to',
    ];
}
