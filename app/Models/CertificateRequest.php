<?php

namespace App\Models;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CertificateRequest extends Model
{
    use HasFactory;

    protected $table = 'cert_custom'; // Custom table name

    protected $fillable = [
        'user_id',
        'resident_id',
        'certificate_name',
        'purpose',
        'or_number',
        'date_needed',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
}
