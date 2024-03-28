<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User As Authenticable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'email',
        'password'
    ];
}
