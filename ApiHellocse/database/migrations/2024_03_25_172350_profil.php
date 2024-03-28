<?php

use App\Models\Profil;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profils', function(Blueprint $table){
            $table->id();
            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->string('image')->nullable();
            $table->string('status',50)->default(Profil::PROFILE_STATE_AWAITING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropDatabaseIfExists('profils');
    }
};
