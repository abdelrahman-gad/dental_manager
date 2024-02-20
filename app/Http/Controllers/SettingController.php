<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{
  
    public function show()
    {
        $settings = Setting::first();
        return response()->json([
            'data'=> $settings,
            'message' => ''
        ],Response::HTTP_OK);
    }


public function update(Request $request)
    {
        $settingId = Setting::first()->id;
   
        $settings = Setting::where(['id'=>$settingId])->update(
           $request->toArray()
        );
        // dd($settings);
        return response()->json([
            'data'=> [],
            'message' => 'updated successfully'
        ],Response::HTTP_OK);
    }
}
