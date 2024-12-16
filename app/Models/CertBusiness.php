<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertBusiness extends Model
{
    use HasFactory;

    protected $table = 'cert_job_seekers';

    protected $fillable = [
        'user_id',
        'resident_id',
        'name',
        'age',
        'civil_status',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
