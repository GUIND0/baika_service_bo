<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;

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
Route::post('/login', [UserController::class, 'connexion'])->name('connexion')->middleware('throttle:login');
Route::get('/deconnexion', [UserController::class, 'deconnexion'])->name('deconnexion');
Route::get('/mot-de-passe-oublie/success', [UserController::class, 'success'])->name('mot_de_passe.success');
Route::get('/mot-de-passe-oublie', [UserController::class, 'motDePasseForm'])->name('mot_de_passe.form');
Route::post('/mot-de-passe-oublie', [UserController::class, 'motDePasseSend'])->name('mot_de_passe.send');
Route::get('/mot-de-passe-oublie/{token}', [UserController::class, 'motDePasseLien'])->name('mot_de_passe.lien');
Route::post('/mot-de-passe-oublie/{token}', [UserController::class, 'motDePasseChange'])->name('mot_de_passe.change');
Route::get('/',[DashboardController::class,'index'])->name('dashboard.index');

Route::middleware(['permission','XSS'])->group(function () {
    //User
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
    Route::post('/reset', [UserController::class, 'reset'])->name('user.reset');


    // Role
    Route::get('/role/{role_id?}', [RoleController::class, 'index'])->name('role.index');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::delete('/role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
});
