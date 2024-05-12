<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostDoctorSchedules;
use App\Services\DoctorScheduleService;
use Illuminate\Http\Request;

class ApiDoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DoctorScheduleService $doctorScheduleService)
    {
        try {
            $data = $doctorScheduleService->getPaginate($request->all());
            return $this->successResponse(['data' => $data], 200);
        } catch (Throwable $e) {
            return $this->errorResponse(['error' => 'Server Error', 500]);
        }
    }

    public function all(DoctorScheduleService $doctorScheduleService){
        try {
            $data = $doctorScheduleService->getAll();
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
    public function store(StorePostDoctorSchedules $request, DoctorScheduleService $doctorScheduleService)
    {
        try {
            $data = $doctorScheduleService->create($request->all());
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
    public function show($id, DoctorScheduleService $doctorScheduleService)
    {
        try {
            $data = $doctorScheduleService->findByPk($id);
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
    public function update(StorePostDoctorSchedules $request, $id, DoctorScheduleService $doctorScheduleService)
    {
        try {
            $data = $doctorScheduleService->update($request->all(), $id);
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
    public function destroy($id, DoctorScheduleService $doctorScheduleService)
    {
        try {
            $doctorScheduleService->delete($id);
            return $this->successResponse(['data' => 'success'], 200);
        } catch (Throwable $e) {
            return $this->errorResponse(['error' => 'Server Error', 500]);
        }
    }
}
