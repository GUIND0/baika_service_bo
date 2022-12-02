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
// Single ticket
Route::get('/ticket/{ticket_id}', [ApiController::class, 'ticket']);
//Evenement
Route::get('/evenements', [ApiController::class, 'evenements']);
// Single evenement
Route::get('/evenement/{evenement_id}', [ApiController::class, 'evenement']);
//Chauffeur
Route::get('/chauffeurs', [ApiController::class, 'chauffeurs']);

//all location
Route::get('/locations', [ApiController::class, 'locations']);
//Single location
Route::get('/location/{location_id}', [ApiController::class, 'location']);
//loaction Image
Route::get('/location/{location_id}/images', [ApiController::class, 'location_images']);

//all tourisme
Route::get('/tourismes', [ApiController::class, 'tourismes']);
//Single tourisme
Route::get('/tourisme/{tourisme_id}', [ApiController::class, 'tourisme']);
//loaction Image
Route::get('/tourisme/{tourisme_id}/images', [ApiController::class, 'tourisme_images']);

Route::get('/quartiers', [ApiController::class, 'quartiers']);

Route::get('/type_colis', [ApiController::class, 'type_colis']);


Route::post('/create_demande_colis', [ApiController::class, 'create_demande_colis']);

Route::post('/create_demande_taxi', [ApiController::class, 'create_demande_taxi']);

Route::get('/get_prix/{id}/{id1}', [ApiController::class, 'get_prix']);

Route::post('/create_get_ticket', [ApiController::class, 'create_get_ticket']);
Route::post('/create_get_evenement_ticket', [ApiController::class, 'create_get_evenement_ticket']);


