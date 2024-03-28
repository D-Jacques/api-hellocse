<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{

    /**
     * The differents states a profile can go through.
     */
    public const PROFILE_STATE_AWAITING = "En attente";
    public const PROFILE_STATE_INACTIVE = "Inactif";
    public const PROFILE_STATE_ACTIVE = "Actif";
    
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'image',
        'status'
    ];

    // To get the fullname easily
    public function getFullName(): string{
        return $this->nom.' '.$this->prenom;
    }
}
