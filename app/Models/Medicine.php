<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'threshold',
        'uom',
        'typeId',
    ]; 

    public function type () {
        return $this->belongsTo(MedicineType::class, 'typeId'); 
    }
}
