<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_name',
        'user_id', // foreign key for the user who created the household
        'resident_id', // foreign key for the resident (if one resident is designated as the head)
    ];

    /**
     * Get the residents in this household.
     */
    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
    public function household_member()
    {
        return $this->hasMany(HouseholdMember::class);
    }

    /**
     * Get the user that created this household.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
