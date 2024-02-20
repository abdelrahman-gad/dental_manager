<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDoctorRequest;
use App\Models\Doctor;

class DoctorController extends Controller
{

    public function index()
    {
        return  response()->json( ['data'=>Doctor::paginate(1),'message'=>' '], 200);
    }

    public function store(CreateDoctorRequest $request)
    {
        Doctor::create($request->all());
        return response()->json(['data'=> [],'message'=>'Created Successfully'],201);
    }

    public function update(CreateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->all());
        return response()->json( [ 'data'=> [], 'message' =>'Updated Successfully'],200);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json( ['data'=> [],'message'=>'Deleted Successfully'],200);
    }
}
