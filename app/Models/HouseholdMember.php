<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdMember extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'resident_id',
        'household_id',
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    public function household()
    {
        return $this->belongsTo(Household::class);
    }
}
