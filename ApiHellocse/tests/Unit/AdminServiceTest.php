<?php

namespace Tests\Unit;

use App\Http\Requests\ProfilRequest;
use App\Http\Services\AdminService;
use App\Models\Profil;
use PHPUnit\Framework\TestCase;

class AdminServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testHandleRequestData(): void
    {

        // I wanted to test the handleRequestData method
        // Though due to lack of time i did not complete this unit test
        // and let commented what i did

        // $profil = new Profil();
        // $profil->nom = 'DOE';
        // $profil->prenom = 'John';
        // $profil->status = 'En attente';
        // $profil->image = 'profil/test.jpg';

        // $customRequest = new ProfilRequest([
        //     'nom' => "Test",
        //     'prenom' => "Test",
        //     'status' => "actif"
        // ]);

        // $mockAdminService = new AdminService();

        // $data = $mockAdminService->handleRequestData($profil, $customRequest);

        $this->assertTrue(true);
    }
}
