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
use App\Http\Controllers\BilletAvionController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\CompagnieAerienneController;
use App\Http\Controllers\DemandeAutoController;
use App\Http\Controllers\DemandeColiController;
use App\Http\Controllers\DemandeTaxiController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\TourismeController;
use App\Http\Controllers\TrajetAvionController;
use App\Http\Controllers\TypeColiController;
use App\Models\CompagnieAerienne;

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

    // Type Coli
    Route::get('/type_coli/{type_coli_id?}', [ TypeColiController::class, 'index'])->name('type_coli.index');
    Route::post('/type_coli/store', [ TypeColiController::class, 'store'])->name('type_coli.store');
    Route::delete('/type_coli/delete/{id}', [ TypeColiController::class, 'delete'])->name('type_coli.delete');

     // Type Permi
     Route::get('/categorie_permi/{categorie_permi_id?}', [ CategoriePermiController::class, 'index'])->name('categorie_permi.index');
     Route::post('/categorie_permi/store', [ CategoriePermiController::class, 'store'])->name('categorie_permi.store');
     Route::delete('/categorie_permi/delete/{id}', [ CategoriePermiController::class, 'delete'])->name('categorie_permi.delete');

    // Type Location
    Route::get('/type_location/{type_location_id?}', [ TypeLocationController::class, 'index'])->name('type_location.index');
    Route::post('/type_location/store', [ TypeLocationController::class, 'store'])->name('type_location.store');
    Route::delete('/type_location/delete/{id}', [ TypeLocationController::class, 'delete'])->name('type_location.delete');

    // Ticket
    Route::get('tickets', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticket/{id?}', [TicketController::class, 'create_or_update'])->name('ticket.create_or_update');
    Route::post('ticket/store', [TicketController::class, 'store'])->name('ticket.store');
    Route::delete('ticket/delete/{id}', [TicketController::class, 'delete'])->name('ticket.delete');
    Route::get('ticket/show/{id}', [TicketController::class, 'show'])->name('ticket.show');

    // Location
    Route::get('locations', [LocationController::class, 'index'])->name('location.index');
    Route::get('/location/show/{id}', [LocationController::class, 'show'])->name('location.show');
    Route::get('/location/{id?}', [LocationController::class, 'create_or_update'])->name('location.create_or_update');
    Route::post('location/store', [LocationController::class, 'store'])->name('location.store');
    Route::delete('location/delete/{id}', [LocationController::class, 'delete'])->name('location.delete');
    Route::get('/location/deleteImage/{id}', [LocationController::class, 'deleteImage'])->name('location.deleteImage');

    // Tourisme
    Route::get('tourismes', [TourismeController::class, 'index'])->name('tourisme.index');
    Route::get('/tourisme/show/{id}', [TourismeController::class, 'show'])->name('tourisme.show');
    Route::get('/tourisme/{id?}', [TourismeController::class, 'create_or_update'])->name('tourisme.create_or_update');
    Route::post('tourisme/store', [TourismeController::class, 'store'])->name('tourisme.store');
    Route::delete('tourisme/delete/{id}', [TourismeController::class, 'delete'])->name('tourisme.delete');
    Route::get('/tourisme/deleteImage/{id}', [TourismeController::class, 'deleteImage'])->name('tourisme.deleteImage');


    // Automobile
    Route::get('automobiles', [AutomobileController::class, 'index'])->name('automobile.index');
    Route::get('/automobile/{id?}', [AutomobileController::class, 'create_or_update'])->name('automobile.create_or_update');
    Route::post('automobile/store', [AutomobileController::class, 'store'])->name('automobile.store');
    Route::delete('automobile/delete/{id}', [AutomobileController::class, 'delete'])->name('automobile.delete');

    // Chauffeur
    Route::get('chauffeurs', [ChauffeurController::class, 'index'])->name('chauffeur.index');
    Route::get('/chauffeur/{id?}', [ChauffeurController::class, 'create_or_update'])->name('chauffeur.create_or_update');
    Route::post('chauffeur/store', [ChauffeurController::class, 'store'])->name('chauffeur.store');
    Route::delete('chauffeur/delete/{id}', [ChauffeurController::class, 'delete'])->name('chauffeur.delete');

    // Evenement
    Route::get('evenements', [EvenementController::class, 'index'])->name('evenement.index');
    Route::get('/evenement/{id?}', [EvenementController::class, 'create_or_update'])->name('evenement.create_or_update');
    Route::post('evenement/store', [EvenementController::class, 'store'])->name('evenement.store');
    Route::delete('evenement/delete/{id}', [EvenementController::class, 'delete'])->name('evenement.delete');
    Route::get('evenement/show/{id}', [EvenementController::class, 'show'])->name('evenement.show');

    // Demande Coli
    Route::get('colis_livraison_traite', [DemandeColiController::class, 'traite'])->name('colis_livraison_traite.index');
    Route::get('colis_livraison_encours', [DemandeColiController::class, 'encours'])->name('colis_livraison_encours.index');
    Route::get('colis_livraison_rejete', [DemandeColiController::class, 'rejete'])->name('colis_livraison_rejete.index');
    Route::get('demande_change_etat/{id}', [DemandeColiController::class, 'demande_change_etat'])->name('demande_change_etat');


    // Demande Taxi
    Route::get('demande_taxi_traite', [DemandeTaxiController::class, 'traite'])->name('demande_taxi_traite.index');
    Route::get('demande_taxi_encours', [DemandeTaxiController::class, 'encours'])->name('demande_taxi_encours.index');
    Route::get('demande_taxi_rejete', [DemandeTaxiController::class, 'rejete'])->name('demande_taxi_rejete.index');
    Route::get('demande_taxi_change_etat/{id}', [DemandeTaxiController::class, 'demande_change_etat'])->name('demande_taxi_change_etat');


    // Demande Auto
    Route::get('demande_auto_traite', [DemandeAutoController::class, 'traite'])->name('demande_auto_traite.index');
    Route::get('demande_auto_encours', [DemandeAutoController::class, 'encours'])->name('demande_auto_encours.index');
    Route::get('demande_auto_rejete', [DemandeAutoController::class, 'rejete'])->name('demande_auto_rejete.index');
    Route::get('demande_auto_change_etat/{id}', [DemandeAutoController::class, 'demande_change_etat'])->name('demande_auto_change_etat');


    // compagnie Aerienne
    Route::get('/compagnie_aerienne/{compagnie_aerienne_id?}', [CompagnieAerienneController::class, 'index'])->name('compagnie_aerienne.index');
    Route::post('/compagnie_aerienne/store', [CompagnieAerienneController::class, 'store'])->name('compagnie_aerienne.store');
    Route::delete('/compagnie_aerienne/delete/{id}', [CompagnieAerienneController::class, 'delete'])->name('compagnie_aerienne.delete');

    // trajet Avion
    Route::get('/trajet_avion/{trajet_avion_id?}', [ TrajetAvionController::class, 'index'])->name('trajet_avion.index');
    Route::post('/trajet_avion/store', [ TrajetAvionController::class, 'store'])->name('trajet_avion.store');
    Route::delete('/trajet_avion/delete/{id}', [ TrajetAvionController::class, 'delete'])->name('trajet_avion.delete');


     // Billet
     Route::get('billets', [BilletAvionController::class, 'index'])->name('billet.index');
     Route::get('/billet/{id?}', [BilletAvionController::class, 'create_or_update'])->name('billet.create_or_update');
     Route::post('billet/store', [BilletAvionController::class, 'store'])->name('billet.store');
     Route::delete('billet/delete/{id}', [BilletAvionController::class, 'delete'])->name('billet.delete');
     Route::get('billet/show/{id}', [BilletAvionController::class, 'show'])->name('billet.show');
 });
