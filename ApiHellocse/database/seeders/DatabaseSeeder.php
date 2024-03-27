<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin used to create Authentification Tokens
        \App\Models\Admin::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make("adminSecurePassword")
        ]);

        // Multiple profiles created 3 Awating, 3 actives and 1 inactive

        \App\Models\Profil::factory(3)->create([
            'status' => 'En attente'
        ]);

        \App\Models\Profil::factory(3)->create([
            'status' => 'Actif'
        ]);

        \App\Models\Profil::factory()->create([
            'status' => 'Inactif'
        ]);
    }
}
