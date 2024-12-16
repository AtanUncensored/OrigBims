<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['complain_type', 'date_of_incident', 'details', 'user_id', 'barangay_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
