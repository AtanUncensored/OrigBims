<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertResidency extends Model
{
    use HasFactory;

    // Specify the table if it does not follow Laravel's naming conventions
    protected $table = 'cert_residences';

    // Specify the fillable attributes
    protected $fillable = [
        'user_id',
        'purok_id',
        'name',
        'age',
        'gender',
        'reason',
        'date',
        'civil_status',
        'punongbarangay',
        'ORnumber',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purok()
    {
        return $this->belongsTo(Purok::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
    public function requests()
    {
        return $this->hasOne(Request::class, 'resident_id', 'resident_id'); 
    }
    
}
