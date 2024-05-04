<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostMedicalRecords;
use App\Services\MedicalRecordService;
use Throwable;
use Illuminate\Http\Request;

class ApiMedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MedicalRecordService $medicalRecordService)
    {
        try {
            $data = $medicalRecordService->getPagination($request->all());
            return $this->successResponse(['data' => $data], 200);
        } catch (Throwable $e) {
            return $this->errorResponse(['error' => 'Server Error', 500]);
        }
    }
    
    public function all(MedicalRecordService $medicalRecordService){
        try {
            $data = $medicalRecordService->getAll();
            return $this->successResponse(['data' => $data], 200);
        } catch (Throwable $e) {
            return $this->errorResponse(['error' => 'Server Error', 500]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostMedicalRecords $request, MedicalRecordService $medicalRecordService)
    {
        try {
            $data = $medicalRecordService->create($request->all());
            if($data)  return $this->successResponse(['data' => 'success'], 200);
            return $this->errorResponse(['error' => 'server error', 500]);
        } catch (Throwable $e) {
            return $this->errorResponse(['error' => 'Server Error', 500]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, MedicalRecordService $medicalRecordService)
    {
        try {
            $data = $medicalRecordService->findByPk($id);
            return $this->successResponse(['data' => $data], 200);
        } catch (Throwable $e) {
            return $this->errorResponse(['error' => 'Server Error', 500]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostMedicalRecords $request, $id, MedicalRecordService $medicalRecordService)
    {
        try {
            $data = $medicalRecordService->update($request->all(), $id);
            if($data)  return $this->successResponse(['data' => 'success'], 200);
            return $this->errorResponse(['error' => 'server error', 500]);
        } catch (Throwable $e) {
            return $this->errorResponse(['error' => 'Server Error', 500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, MedicalRecordService $medicalRecordService)
    {
        try {
            $medicalRecordService->delete($id);
            return $this->successResponse(['data' => 'success'], 200);
        } catch (Throwable $e) {
            return $this->errorResponse(['error' => 'Server Error', 500]);
        }
    }
}
