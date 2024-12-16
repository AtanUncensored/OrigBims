<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'user_id',
        'barangay_id',
        'certificate_type_id',
        'requester_name',
        'purpose',
        'business_name',
        'date_needed',
        'or_number',
        'witness_by',
        'reference_number',
        'monthly_ave_income'
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function certificateType()
    {
        return $this->belongsTo(CertificateType::class, 'certificate_type_id');
    }
}
