<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function authenticate(AuthenticationRequest $request){
        // We get the cretentials validated with the validator in AuthenticationRequest
        $credentials = $request->validated();

        if(!Auth::attempt($credentials)){
            return response()->json(['error' => "Authentication failed, check your credentials"], 404);
        }
        
        // Creation of the sanctum token, used to authenticate the user on the protected endpoints
        $admin = Auth::user();
        $token = $admin->createToken($admin->email)->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function createProfile(){

        return response()->json(['message' => 'you are authenticated with your token']);

    }

}
