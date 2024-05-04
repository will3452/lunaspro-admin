<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostMedicalRecords extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'medical_history' => 'nullable|array',
            'doctor_name' => 'nullable|max:255',
            'licence_number' => 'nullable|max:255',
            'diagnosis' => 'nullable|max:255',
            'doctor_id' => 'required|integer|exists:profiles,id',
            'patient_id' => 'required|integer|exists:profiles,id',
            'allergies_and_adverse_reaction' => 'nullable|array',
            'medication_list' => 'nullable|array',
            'vital_signs' => 'nullable|array',
            'physical_examination_findings' => 'nullable|array',
            'procedures_and_treatments' => 'nullable|array',
            'drogress_notes' => 'nullable|array',
            'diagnostic_codes' => 'nullable|array',
            'consent_forms_and_authorizations' => 'nullable|array',
            'discharge_summaries' => 'nullable|array',
            'attachments' => 'nullable|string|max:255'
        ];
    }
}
