<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function getActiveProfiles(){
        $profils = Profil::where('status', 'Actif')->get([
            'nom',
            'prenom',
            'image',
            'created_at',
            'updated_at'
        ]);
        return response()->json(['profiles' => $profils]);
    }
}
