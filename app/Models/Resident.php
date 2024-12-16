<?php

namespace App\Models;

use App\Models\Purok;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_alive','first_name', 'last_name', 'middle_name', 'suffix' , 'purok_id', 'birth_date',
        'place_of_birth', 'gender', 'civil_status', 'phone_number', 'citizenship',
        'nickname', 'email', 'current_address', 'permanent_address', 'household_id','mother_id',
        'father_id',
    ];

    public function mother()
    {
        return $this->belongsTo(Resident::class, 'mother_id');
    }

    public function father()
    {
        return $this->belongsTo(Resident::class, 'father_id');
    }

    // Children where this resident is the mother
    public function childrenAsMother()
    {
        return $this->hasMany(Resident::class, 'mother_id');
    }

    // Children where this resident is the father
    public function childrenAsFather()
    {
        return $this->hasMany(Resident::class, 'father_id');
    }

    public function householdMembers()
    {
        return $this->hasMany(HouseholdMember::class, 'resident_id');
    }
    public function households()
    {
        return $this->belongsToMany(Household::class, 'household_members', 'resident_id', 'household_id');
    }


    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function purok()
    {
        return $this->belongsTo(Purok::class);
    }   
}
