<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'day',
        'time',
    ];

    public function profile () {
        return $this->belongsTo(Profile::class, 'profile_id'); 
    }
}
