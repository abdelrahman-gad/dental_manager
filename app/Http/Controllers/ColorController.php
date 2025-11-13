<?php

namespace App\Http\Controllers;

use App\Http\Requests\Color\CreateColorRequest;
use App\Http\Requests\Color\UpdateColorRequest;
use App\Http\Requests\Color\DeleteColorRequest;
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
        $color = Color::latest()->first();
        return response()->json(['data'=> $color,'message'=>'Created Successfully'],201);
    }

    public function update(UpdateColorRequest $request, Color $color)
    {
        $color->update($request->all());
        return response()->json( [ 'data'=> $color, 'message' =>'Updated Successfully'],200);
    }

    public function destroy(Color $color)
    {
        if($this->colorIsUsedInOrders($color->id)) {
            return response()->json( ['data'=> [],'message'=>'Cannot delete this color because it is used in one or more orders.'],422);
        }
        $color->delete();
        return response()->json( ['data'=> [],'message'=>'Deleted Successfully'],200);
    }

    private function colorIsUsedInOrders($colorId)
    {
        return \App\Models\Order::where('color_id', $colorId)->exists();
    }
}
