<?php

namespace App\Models;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purok extends Model
{
    use HasFactory;

    protected $fillable = ['barangay_id', 'purok_name', 'purok_number'];


    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
