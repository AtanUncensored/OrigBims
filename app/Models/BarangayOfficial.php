<?php

namespace App\Models;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangayOfficial extends Model
{
    use HasFactory;

    protected $fillable = ['resident_id', 'barangay_id', 'position', 'purok' , 'committee', 'start_of_service', 'end_of_service'];


    // Relationship with Resident
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

}
