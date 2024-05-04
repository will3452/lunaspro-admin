<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointments extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'date',
        'time',
        'reason',
        'remarks',
        'type',
        'isReschedule',
        'status',
        'approved_at',
        'declined_at',
        'canceled_at',
        'profile_id'
    ]; 

    public $casts = [
        'date' => 'date',
        'time' => 'datetime',
        'approved_at' => 'date',
        'declined_at' => 'date',
        'canceled_at' => 'date',
    ];

    public function profile () {
        return $this->belongsTo(Profile::class, 'profile_id'); 
    }
}
