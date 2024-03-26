<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\CreateProfilRequest;
use App\Models\Admin;
use App\Models\Profil;
use Illuminate\Http\UploadedFile;
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

    public function createProfile(CreateProfilRequest $request){
        $data = $request->validated();
        $data['status'] = "En attente";
        /** @var UploadedFile $image */
        $image = $request->validated('image');
        $data['image'] = $image->store('profil', 'public');
        $profil = Profil::create($data);

        return response()->json(['message' => "The profil ".$profil->getFullName()." was created successfully, the status was automatically set as \"En attente\" so as to validate the submitted datas"]);
    }

}
