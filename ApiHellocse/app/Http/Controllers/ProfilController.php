<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\JsonResponse;

class ProfilController extends Controller
{

    /**
     * We get the profil informations for all users, we filter profils that are 
     * actives but we don't send the status in the response 
     * 
     * @return JsonResponse
     */
    public function getActiveProfiles(): JsonResponse {
        $responseInfo = [
            'nom',
            'prenom',
            'image',
            'created_at',
            'updated_at'
        ];
        $profils = Profil::where('status', 'Actif')->get($responseInfo);
        return response()->json(['profiles' => $profils]);
    }
}
