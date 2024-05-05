<?php

use App\Http\Controllers\ApiAuthenticationController;
use App\Http\Controllers\ApiDoctorScheduleController;
use App\Http\Controllers\ApiMedicalRecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//private access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth-test', function () {
        return 'authentication test';
    });
    Route::post('/logout', [ApiAuthenticationController::class, 'logout']);
});

Route::get('/public-test', function () {
    return 'public test';
});

Route::prefix('/v1.0/')->group(function () {
    //medical records
    Route::prefix('/medical-records')->group(function (){
        Route::get('/', [ApiMedicalRecordController::class, 'index']); //api end point http://localhost:8000/api/v1.0/medical-records?page=1&limit=2&column=id&direction=asc note parameters is optional
        Route::get('/all', [ApiMedicalRecordController::class, 'all']); //api end point http://localhost:8000/api/v1.0/medical-records/all
        Route::get('/show/{id}', [ApiMedicalRecordController::class, 'show']); //api end point http://localhost:8000/api/v1.0/medical-records/show/{id}
        Route::post('/', [ApiMedicalRecordController::class, 'store']); //http://localhost:8000/api/v1.0/medical-records/ with form-data
        Route::put('/{id}', [ApiMedicalRecordController::class, 'update']); //http://localhost:8000/api/v1.0/medical-records/ with form-data
        Route::delete('/{id}', [ApiMedicalRecordController::class, 'destroy']); //http://localhost:8000/api/v1.0/medical-records/ with form-data
    });
    //medical records
    Route::prefix('/doctor-schedule')->group(function (){
        Route::get('/', [ApiDoctorScheduleController::class, 'index']);
        Route::get('/all', [ApiDoctorScheduleController::class, 'all']);
        Route::get('/show/{id}', [ApiDoctorScheduleController::class, 'show']); 
        Route::post('/', [ApiDoctorScheduleController::class, 'store']);
        Route::put('/{id}', [ApiDoctorScheduleController::class, 'update']);
        Route::delete('/{id}', [ApiDoctorScheduleController::class, 'destroy']);
    });
});

//user authentication
Route::post('/register', [ApiAuthenticationController::class, 'register']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);
