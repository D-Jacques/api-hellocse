<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Profil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    /**
     * Test for the admin authentication function.
     * @covers App\Http\Controllers\AdminController::authenticate
     * @dataProvider provideTestAuthenticate
     */
    public function testAuthenticate(string $password, int $httpResponseCode, string $expectedTokenKey): void
    {
        // Creating a dummy admin 
        $testAdmin = Admin::factory()->create([
            'email' => 'adminTest@gmail.com',
            'password' => Hash::make("testPassword")
        ]);

        // Simulate an authentication
        $response = $this->postJson("/api/admin/authenticate", [
            'email' => $testAdmin->email,
            'password' => $password
        ]);

        $response->assertStatus($httpResponseCode);
        $response->assertSee($expectedTokenKey);

        // Delete the dummy user in the end
        $testAdmin->delete();
    }

    public static function provideTestAuthenticate(){

        return [
            // Authentification successful => 200 and return token
            'auth-success' => [
                "testPassword",
                200,
                "token"
            ],
            // Authentification failed => 404 and return an error message
            'auth-failed' => [
                "wrongPassword",
                404,
                "error"
            ]
        ];
    }

    /**
     * Test for the createProfile method
     * @covers App\Http\Controllers\AdminController::createProfile
     * @dataProvider provideTestCreatedProfile
     */
    public function testCreateProfile(array $dummyDatas, int $httpResponseCode, string $expectedJsonFragment){

        $testAdmin = Admin::factory()->create([
            'email' => 'adminTest@gmail.com',
            'password' => Hash::make("testPassword")
        ]);

        $this->actingAs($testAdmin, 'sanctum');

        $response = $this->postJson("/api/admin/profile/create", $dummyDatas);

        $response->assertStatus($httpResponseCode);
        $response->assertSee($expectedJsonFragment);

        Profil::where('nom', $dummyDatas['nom'])->delete();
        $testAdmin->delete();
    }

    public static function provideTestCreatedProfile(){
        return [
            [
                [ 
                    'nom' => "CreatedTest",
                    'prenom' => "John",
                    'status' => "En attente",
                    'image' => UploadedFile::fake()->image('test.jpeg')
                ],
                Response::HTTP_CREATED,
                'was created successfully',
            ]
        ];
    }

    /**
     * Wanted to create some test for edit and delete methods
     * Though due to lack of time i had not enough time to do them
     */

}
