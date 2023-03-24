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

// OM
Route::post('/om/return', [ApiController::class, 'om_return']);
Route::post('/om/cancel', [ApiController::class, 'om_cancel']);
Route::post('/om/notif', [ApiController::class, 'om_notif']);

Route::get('/toto',function(Request $request){
    dd($request);
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
Route::get('/recrutements', [ApiController::class, 'recrutements']);

//all location
Route::get('/locations', [ApiController::class, 'locations']);
//Single location
Route::get('/location/{location_id}', [ApiController::class, 'location']);
//loaction Image
Route::get('/location/{location_id}/images', [ApiController::class, 'location_images']);

Route::post('/create-ticket', [ApiController::class, 'create_ticket']);

Route::post('/create_evenement_ticket', [ApiController::class, 'create_evenement_ticket']);
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
Route::post('/create-billet', [ApiController::class, 'create_billet']);

Route::post('/create-automobile', [ApiController::class, 'create_automobile']);

Route::get('/get_prix/{id}/{id1}', [ApiController::class, 'get_prix']);

//Billets
Route::get('/billets', [ApiController::class, 'billets']);
// Single billet
Route::get('/billet/{billet_id}', [ApiController::class, 'billet']);


Route::post('/create-recrutement', [ApiController::class, 'create_recrutement']);





