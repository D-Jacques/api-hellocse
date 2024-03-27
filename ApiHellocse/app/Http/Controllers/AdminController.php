<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\ProfilRequest;
use App\Http\Services\AdminService;
use App\Models\Admin;
use App\Models\Profil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /** @var AdminService $adminService */
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Authenticate the user with the passsed credentials if 
     * authentification is successful, we return a token to 
     * authenticate the user with Sanctum through the secured endpoints
     * 
     * @param AuthenticationRequest $request
     * @return JsonResponse
     */
    public function authenticate(AuthenticationRequest $request): JsonResponse {
        // We get the cretentials validated with the validator in AuthenticationRequest
        $credentials = $request->validated();

        if(!Auth::attempt($credentials)){
            return response()->json(['error' => "Authentication failed, check your credentials"], 404);
        }
        
        $admin = Auth::user();
        $token = $admin->createToken('adminAuthenticationToken', ['*'], now()->addDay())->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * POST request to create a new Profil
     *
     * @param ProfilRequest $request
     * @return JsonResponse
     */
    public function createProfile(ProfilRequest $request): JsonResponse{
        $profil = new Profil();
        $data = $this->adminService->handleRequestData($profil, $request);
        $data['status'] = "En attente";
        $profil = Profil::create($data);

        return response()->json(['message' => "The profil of ".$profil->getFullName()." was created successfully"]);
    }

    /**
     * PATCH request to update an existing Profil
     *
     * @param Profil $profil
     * @param ProfilRequest $request
     * @return JsonResponse
     */
    public function editProfile(Profil $profil, ProfilRequest $request): JsonResponse {
        $profil->update($this->adminService->handleRequestData($profil, $request));
        return response()->json(['message' => "The profil of ".$profil->getFullName()." was updated successfully"]);
    }
    
    /**
     * DELETE request to delete a Profil
     *
     * @param Profil $profil
     * @return JsonResponse
     */
    public function deleteProfile(Profil $profil): JsonResponse{
        $profil->delete();
        return response()->json(['message' => "The profil of ".$profil->getFullName()." was deleted successfully"]);
    }

}
