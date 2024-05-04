<?php
namespace App\Services;

use Illuminate\Support\Str;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;

class MedicalRecordService
{
    public function getPagination($data){
        $limit = isset($data['limit']) ? $data['limit'] : 10;
        $orderColumn = 'created_at';
        $orderDirection = 'desc';
        $directionList = collect(['asc', 'desc']);
        $columnList = collect(['id', 'created_at', 'modified_at', 'doctor_name', 'licence_numbers']);
        if(isset($data['column']) && isset($data['direction'])){
            $direction = $data['direction'];
            $column = $data['column'];
            $filterDirection = $directionList->contains(function (string $value) use($direction) {
                return $value == Str::lower($direction);
            });
            $filterColumn = $columnList->contains(function (string $value) use($column) {
                return $value == Str::lower($column);
            });
            if($filterDirection && $filterColumn){
                $orderColumn = $data['column'];
                $orderDirection = $data['direction'];
            }
        }
        //where select specific query not available until what column is needed to be fetch
        $medicalRecords = MedicalRecord::with([
            'createdUser:id,name,email', 
            'updatedUser:id,name,email', 
            'doctor:id,first_name,middle_name,last_name,license_number,contact_number,email,gender,type',
            'patient:id,first_name,middle_name,last_name,license_number,contact_number,email,gender,type',
            ])->orderBy($orderColumn, $orderDirection)->paginate($limit);
        return $medicalRecords;
    }
    public function getAll(){
        //where select specific query not available until what column is needed to be fetch
        $medicalRecords = MedicalRecord::with([
            'createdUser:id,name,email', 
            'updatedUser:id,name,email', 
            'doctor:id,first_name,middle_name,last_name,license_number,contact_number,email,gender,type',
            'patient:id,first_name,middle_name,last_name,license_number,contact_number,email,gender,type',
            ])->get();
        return $medicalRecords;
    }

    public function findByPk($id){
         //where select specific query not available until what column is needed to be fetch
        $medicalRecords = MedicalRecord::with([
            'createdUser:id,name,email', 
            'updatedUser:id,name,email', 
            'doctor:id,first_name,middle_name,last_name,license_number,contact_number,email,gender,type',
            'patient:id,first_name,middle_name,last_name,license_number,contact_number,email,gender,type',
            ])->find($id);
        return $medicalRecords;
    }

    public function create($data){
        (auth()->check()) ? $data['created_id'] = Auth::id() : $data['created_id'] = "1";
        $medicalRecords = MedicalRecord::create($data);
        return $medicalRecords;
    }
    
    public function update($data, $id){
        $data = MedicalRecord::where('id', $id)
        ->update($data);
        return ($data) ? $data : null;
    }
}