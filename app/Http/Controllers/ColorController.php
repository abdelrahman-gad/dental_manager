<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateColorRequest;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        return  response()->json( ['data'=> Color::all(),'message'=>' '], 200);
    }

    public function store(CreateColorRequest $request)
    {
        Color::create($request->all());
        return response()->json(['data'=> [],'message'=>'Created Successfully'],201);
    }

    public function update(CreateColorRequest $request, Color $color)
    {
        $color->update($request->all());
        return response()->json( [ 'data'=> [], 'message' =>'Updated Successfully'],200);
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return response()->json( ['data'=> [],'message'=>'Deleted Successfully'],200);
    }
}
