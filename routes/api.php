<?php

use App\Http\Controllers\API\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['auth:sanctum']],function(){

});

// All automobile
Route::get('/automobiles', [ApiController::class, 'automobiles']);
// Single automobile
Route::get('/automobile/{automobile_id}', [ApiController::class, 'automobile']);
//Tickect
Route::get('/tickets', [ApiController::class, 'tickets']);
//Evenement
Route::get('/evenements', [ApiController::class, 'evenements']);

//Chauffeur
Route::get('/chauffeurs', [ApiController::class, 'chauffeurs']);

//all location
Route::get('/locations', [ApiController::class, 'locations']);
//Single location
Route::get('/location/{location_id}', [ApiController::class, 'location']);
//loaction Image
Route::get('/location/{location_id}/images', [ApiController::class, 'location_images']);

