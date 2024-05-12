<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorSchedule extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'doctor_schedules';
    protected $fillable = [
        'doctor_id',
        'date',
        'time',
        'created_id',
        'modified_id',
    ]; 
    protected $casts = [
        'date' => 'date:Y-m-d',
        'time' => 'datetime:h:i A',
        'created_at' => 'datetime:Y-m-d h:i A',
        'updated_at' => 'datetime:Y-m-d h:i A',
    ];
    public function doctor () {
        return $this->belongsTo(Profile::class, 'doctor_id'); 
    }
    public function createdUser () {
        return $this->belongsTo(User::class, 'created_id'); 
    }
    public function updatedUser () {
        return $this->belongsTo(User::class, 'modified_id'); 
    }
}
