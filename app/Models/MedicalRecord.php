<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'medical_records';
    protected $fillable = [
        'medical_history',
        'doctor_name',
        'licence_number',
        'diagnosis',
        'allergies_and_adverse_reaction',
        'medication_list',
        'vital_signs',
        'physical_examination_findings',
        'laboratory_test_results',
        'procedures_and_treatments',
        'drogress_notes',
        'diagnostic_codes',
        'consent_forms_and_authorizations',
        'discharge_summaries',
        'doctor_id',
        'patient_id',
        'created_id',
        'modified_id',
        'attachments'
    ]; 
    protected $casts = [
        'medical_history' => 'array',
        'allergies_and_adverse_reaction'  => 'array',
        'medication_list' => 'array',
        'vital_signs' => 'array',
        'physical_examination_findings' => 'array',
        'laboratory_test_results' => 'array',
        'procedures_and_treatments' => 'array',
        'drogress_notes' => 'array',
        'diagnostic_codes' => 'array',
        'consent_forms_and_authorizations' => 'array',
        'discharge_summaries' => 'array',
        'created_at' => 'datetime:Y-m-d h:i A',
        'updated_at' => 'datetime:Y-m-d h:i A',
    ];
    public function createdUser () {
        return $this->belongsTo(User::class, 'created_id'); 
    }
    public function updatedUser () {
        return $this->belongsTo(User::class, 'modified_id'); 
    }
    public function doctor () {
        return $this->belongsTo(Profile::class, 'doctor_id'); 
    }
    public function patient () {
        return $this->belongsTo(Profile::class, 'patient_id'); 
    }
}
