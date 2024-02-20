<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(RegisterRequest $request){
        $user = User::create([
            'email'=>$request['email'],
                'password'=>Hash::make($request['password']),
                'name'=>$request['name']
            ]
        );
        return response()->json(['message'=>'User Created','data'=>[]],Response::HTTP_CREATED);
    }
    public function login(Request $request){
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'message' => 'Email & Password does not match with our record.',
                    'data' => []
                ], Response::HTTP_UNAUTHORIZED);
            }

            $user = User::where('email', $request->email)->first();
            return response()->json([
                'message' => 'User Logged In Successfully',
                'data' => ['token' => $user->createToken('jwt_secret')->plainTextToken]
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function  logout(Request $request){

        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'User Logged Out Successfully',
            'data' => []
        ], Response::HTTP_OK);
    }

}
