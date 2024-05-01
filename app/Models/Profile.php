<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'license_number',
        'contact_number',
        'email', 
        'address',
        'gender',
        'birth_date',
        'user_id', 
        'type',
        'blood_type',
        'nationality',
    ]; 

    public $casts = [
        'birth_date' => 'date', 
    ]; 

    const TYPE_STAFF = 'Staff';
    const TYPE_PATIENT = 'Patient';
    const TYPE_DOCTOR = 'Doctor';
    const TYPE_ADMIN = 'Admin'; 

    public function user () {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function hmos () {
        // todo:
    }
}
