<?php
namespace App\Services;

use App\Models\DoctorSchedule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DoctorScheduleService
{
    public function getPaginate($data){
        $limit = isset($data['limit']) ? $data['limit'] : 10;
        $search = isset($data['search']) ? $data['search'] : '';
        $orderColumn = 'created_at';
        $orderDirection = 'desc';
        $directionList = collect(['asc', 'desc']);
        $columnList = collect(['id', 'date', 'time', 'created_at']);
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
        $doctorSchedules = DoctorSchedule::with([
            'createdUser:id,name,email', 
            'updatedUser:id,name,email', 
            'doctor:id,first_name,middle_name,last_name,license_number,contact_number,email,gender,type',
        ])
        ->when($search, function($query) use ($search){
            $query->where(function ($query) use ($search) {
                $query->where('date', 'like', '%'.$search.'%')
                    ->orWhere('time', 'like', '%'.$search.'%');
            })
            ->orWhereHas('createdUser', function($query) use($search){
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->orWhereHas('updatedUser', function($query) use($search){
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->orWhereHas('doctor', function($query) use ($search){
                $query->where('first_name', 'like', '%'.$search.'%')
                ->orWhere('last_name', 'like', '%'.$search.'%');
            });
        })
        ->orderBy($orderColumn, $orderDirection)
        ->paginate($limit);
        return $doctorSchedules;
    }
    public function getAll(){
        $doctorSchedules = DoctorSchedule::with([
            'createdUser:id,name,email', 
            'updatedUser:id,name,email', 
            'doctor:id,first_name,middle_name,last_name,license_number,contact_number,email,gender,type',
            ])->get();
        return $doctorSchedules;
    }
    public function findByPk($id){
       $doctorSchedules = DoctorSchedule::with([
            'createdUser:id,name,email', 
            'updatedUser:id,name,email', 
            'doctor:id,first_name,middle_name,last_name,license_number,contact_number,email,gender,type',
           ])->find($id);
       return $doctorSchedules;
   }
   public function create($data){
        (auth()->check()) ? $data['created_id'] = Auth::id() : $data['created_id'] = "1";
        $doctorSchedules = DoctorSchedule::create($data);
        return $doctorSchedules;
    }
    public function update($data, $id){
        (auth()->check()) ? $data['modified_id'] = Auth::id() : $data['modified_id'] = "1";
        $data = DoctorSchedule::where('id', $id)
        ->update($data);
        return ($data) ? $data : null;
    }
    public function delete($id){
        $data = DoctorSchedule::where('id', $id)->delete();
        return $data;
    }
}