<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\CompagnieController;
use App\Http\Controllers\CategoriePermiController;
use App\Http\Controllers\QuartierController;
use App\Http\Controllers\TypeAutoController;
use App\Http\Controllers\TypeLocationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ItineraireController;
use App\Http\Controllers\AutomobileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route Authentication Pages
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'connexion'])->name('connexion');
Route::get('/test', [UserController::class, 'connexion']);
Route::get('/deconnexion', [UserController::class, 'deconnexion'])->name('deconnexion');
Route::get('/mot-de-passe-oublie/success', [UserController::class, 'success'])->name('mot_de_passe.success');
Route::get('/mot-de-passe-oublie', [UserController::class, 'motDePasseForm'])->name('mot_de_passe.form');
Route::post('/mot-de-passe-oublie', [UserController::class, 'motDePasseSend'])->name('mot_de_passe.send');
Route::get('/mot-de-passe-oublie/{token}', [UserController::class, 'motDePasseLien'])->name('mot_de_passe.lien');
Route::post('/mot-de-passe-oublie/{token}', [UserController::class, 'motDePasseChange'])->name('mot_de_passe.change');

Route::middleware(['permission','XSS'])->group(function () {

    Route::get('/',[DashboardController::class,'index'])->name('dashboard.index');

    //User
    Route::post('/reset', [UserController::class, 'reset'])->name('user.reset');
    Route::get('/user/changepassword/{id}', [UserController::class, 'changepassword'])->name('user.changepassword');
    Route::post('/user/changepassword/{id}', [UserController::class, 'changePasswordStore'])->name('changePasswordStore');
    Route::get('/mot-de-passe-oublie/success', [UserController::class, 'success'])->name('mot_de_passe.success');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/paginate', [UserController::class, 'pagination'] )->name('user.pagination');
    Route::get('/user/create/{user_id?}', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/personnel', [UserController::class, 'gerer'])->name('user.gerer');
    Route::get('/compte', [UserController::class, 'compte'])->name('user.compte');
    Route::post('/password', [UserController::class, 'password'])->name('user.password');


    // Role
    Route::get('/role/{role_id?}', [RoleController::class, 'index'])->name('role.index');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::delete('/role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');

    // compagnie
    Route::get('/compagnie/{compagnie_id?}', [CompagnieController::class, 'index'])->name('compagnie.index');
    Route::post('/compagnie/store', [CompagnieController::class, 'store'])->name('compagnie.store');
    Route::delete('/compagnie/delete/{id}', [CompagnieController::class, 'delete'])->name('compagnie.delete');

    // trajet
    Route::get('/trajet/{trajet_id?}', [ TrajetController::class, 'index'])->name('trajet.index');
    Route::post('/trajet/store', [ TrajetController::class, 'store'])->name('trajet.store');
    Route::delete('/trajet/delete/{id}', [ TrajetController::class, 'delete'])->name('trajet.delete');

    // trajet
    Route::get('/categorie_permis/{categorie_permis_id?}', [ CategoriePermiController::class, 'index'])->name('categorie_permis.index');
    Route::post('/categorie_permis/store', [ CategoriePermiController::class, 'store'])->name('categorie_permis.store');
    Route::delete('/categorie_permis/delete/{id}', [ CategoriePermiController::class, 'delete'])->name('categorie_permis.delete');

    // Quartier
    Route::get('/quartier/{quartier_id?}', [ QuartierController::class, 'index'])->name('quartier.index');
    Route::post('/quartier/store', [ QuartierController::class, 'store'])->name('quartier.store');
    Route::delete('/quartier/delete/{id}', [ QuartierController::class, 'delete'])->name('quartier.delete');

     // Itineraire
     Route::get('/itineraire/{itineraire_id?}', [ ItineraireController::class, 'index'])->name('itineraire.index');
     Route::post('/itineraire/store', [ ItineraireController::class, 'store'])->name('itineraire.store');
     Route::delete('/itineraire/delete/{id}', [ ItineraireController::class, 'delete'])->name('itineraire.delete');

    // Type Auto
    Route::get('/type_auto/{type_auto_id?}', [ TypeAutoController::class, 'index'])->name('type_auto.index');
    Route::post('/type_auto/store', [ TypeAutoController::class, 'store'])->name('type_auto.store');
    Route::delete('/type_auto/delete/{id}', [ TypeAutoController::class, 'delete'])->name('type_auto.delete');

    // Type Location
    Route::get('/type_location/{type_location_id?}', [ TypeLocationController::class, 'index'])->name('type_location.index');
    Route::post('/type_location/store', [ TypeLocationController::class, 'store'])->name('type_location.store');
    Route::delete('/type_location/delete/{id}', [ TypeLocationController::class, 'delete'])->name('type_location.delete');

    // Ticket
    Route::get('tickets', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket/{id?}', [TicketController::class, 'create_or_update'])->name('ticket.create_or_update');
    Route::post('ticket/store', [TicketController::class, 'store'])->name('ticket.store');
    Route::delete('ticket/delete/{id}', [TicketController::class, 'delete'])->name('ticket.delete');

    // Location
    Route::get('locations', [LocationController::class, 'index'])->name('location.index');
    Route::get('/location/{id?}', [LocationController::class, 'create_or_update'])->name('location.create_or_update');
    Route::post('location/store', [LocationController::class, 'store'])->name('location.store');
    Route::delete('location/delete/{id}', [LocationController::class, 'delete'])->name('location.delete');
    Route::get('/location/deleteImage/{id}', [LocationController::class, 'deleteImage'])->name('location.deleteImage');


    // Location
    Route::get('automobiles', [AutomobileController::class, 'index'])->name('automobile.index');
    Route::get('/automobile/{id?}', [AutomobileController::class, 'create_or_update'])->name('automobile.create_or_update');
    Route::post('automobile/store', [AutomobileController::class, 'store'])->name('automobile.store');
    Route::delete('automobile/delete/{id}', [AutomobileController::class, 'delete'])->name('automobile.delete');
});