<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;


    protected $fillable = [
        'barangay_name',
        'logo',
        'background_image',
    ];
    
        public function residents()
        {
            return $this->hasMany(Resident::class);
        }
    
        public function users()
        {
            return $this->hasMany(User::class);
        }
        public function requests()
{
    return $this->hasMany(Request::class, 'barangay_id');
}

}
