<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertIndigency extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's naming convention
    protected $table = 'cert_indigencies';

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'resident_id',
        'name',
        'age',
        'civil_status',
        'gender',
    ];

    // Define relationships

    // Relationship to the User (the requester)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to the Resident
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function requests()
    {
        return $this->hasOne(Request::class, 'resident_id', 'resident_id');
    }
}
