<?php
namespace App\Services;

use Illuminate\Support\Str;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;

class MedicalRecordService
{
    public function getPagination($data){
        $limit = isset($data['limit']) ? $data['limit'] : 10;
        $search = isset($data['search']) ? $data['search'] : '';
        $orderColumn = 'created_at';
        $orderDirection = 'desc';
        $directionList = collect(['asc', 'desc']);
        $columnList = collect(['id', 'created_at', 'modified_at', 'doctor_name', 'licence_numbers', 'diagnosis']);
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
            ])->orderBy($orderColumn, $orderDirection)
            ->when($search, function ($query) use($search){ //sorting query
				$query->where(function ($query) use ($search) {
					$query->where('doctor_name', 'like', '%' . $search . '%')
						->orWhere('licence_number', 'like', '%' . $search . '%');
				})
                ->orWhereHas('createdUser', function($query) use($search){
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->orWhereHas('updatedUser', function($query) use($search){
                    $query->where('name', 'like', '%'.$search.'%');
                })
				->orWhere(function ($query) use ($search) {
					$query->whereHas('doctor', function ($query) use ($search) {
						$query->where('first_name', 'like', '%' . $search . '%')
							->orWhere('last_name', 'like', '%' . $search . '%');
					})
					->orWhereHas('patient', function ($query) use ($search) {
						$query->where('first_name', 'like', '%' . $search . '%')
							->orWhere('last_name', 'like', '%' . $search . '%');
					});
				});
            })
            ->paginate($limit);
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

    public function delete($id){
        $data = MedicalRecord::where('id', $id)->delete();
        return $data;
    }
}