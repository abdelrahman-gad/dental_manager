<?php

namespace App\Http\Controllers;

use App\Http\Requests\Doctor\CreateDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        return response()->json( ['data' => Doctor::paginate(10),'message'=>''], 200);
    }

    public function store(CreateDoctorRequest $request)
    {
        Doctor::create($request->all());
        $doctor = Doctor::latest()->first();
        return response()->json(['data'=> $doctor ,'message'=>'Created Successfully'],201);
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->all());
        return response()->json( [ 'data'=> $doctor, 'message' =>'Updated Successfully'],200);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json( ['data'=> [],'message'=>'Deleted Successfully'],200);
    }
}
