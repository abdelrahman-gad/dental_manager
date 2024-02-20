<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateToothTypeRequest;
use App\Models\ToothType;
use Illuminate\Http\Request;

class ToothTypeController extends Controller
{
    public function index()
    {
        return  response()->json( ['data'=>ToothType::all(),'message'=>' '], 200);
    }

    public function store(CreateToothTypeRequest $request)
    {
        ToothType::create($request->all());
        return response()->json(['data'=> [],'message'=>'Created Successfully'],201);
    }

    public function update(CreateToothTypeRequest $request, ToothType $toothType)
    {
        $toothType->update($request->all());
        return response()->json( [ 'data'=> [], 'message' =>'Updated Successfully'],200);
    }

    public function destroy(ToothType $toothType)
    {
        $toothType->delete();
        return response()->json( ['data'=> [],'message'=>'Deleted Successfully'],200);
    }
}
