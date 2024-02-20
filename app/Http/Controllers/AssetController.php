<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssetRequest;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        return  response()->json( ['data'=> Asset::paginate(30),'message'=>' '], 200);
    }

    public function store(CreateAssetRequest $request)
    {
        $asset = Asset::create($request->all());
        return response()->json(['data'=> $asset,'message'=>'Created Successfully'],201);
    }

    public function update(CreateAssetRequest $request, Asset $asset)
    {
     $asset->update($request->all());
     return response()->json( [ 'data'=> $asset, 'message' =>'Updated Successfully'],200);
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return response()->json( ['data'=> $asset ,'message'=>'Deleted Successfully'],200);
    }
}
