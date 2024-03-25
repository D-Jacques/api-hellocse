<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("/admin")->name('admin.')->controller(AdminController::class)->group(function(){
    Route::post("/authenticate", 'authenticate')->name('authenticate');
    // You MUST have generated a token 
    Route::middleware('auth:sanctum')->get('/profile/create', 'createProfile')->name('createProfile');
});
