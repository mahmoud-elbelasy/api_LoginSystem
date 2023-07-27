<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

class RegisterController extends Controller
{

    public function CreateUser(Request $request){
    try{
        $validator = validator::make($request->all(),[
            'name' => 'required',
            'email' =>'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ],401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    
    }catch(\Throwable $th){
        return response([
            'status' => false,
            'message' => $th->getMessage()
        ],500);
    }
}

}
