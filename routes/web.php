<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Abonnement;
use App\Models\Organisation;
use App\Models\Facture;
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\FactureController;

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

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('organisation', function () {
    return Organisation::all();
})->middleware(['auth'])->name('organisation');


Route::group(['middleware' => 'auth'], function () {
    // CRUD Abonnements
    Route::get('abonnement', [AbonnementController::class, 'index'])->name('abonnement');
    Route::get('abonnement/create', [AbonnementController::class, 'create'])->name('abonnement.create');
    Route::post('abonnement/store', [AbonnementController::class, 'store'])->name('abonnement.store');
    Route::post('abonnement/{abonnement:id}', [AbonnementController::class, 'update'])->name('abonnement.edit');
    Route::get('abonnement/{abonnement:id}/delete', [AbonnementController::class, 'delete'])->name('abonnement.delete');
    // Corbeille Abonnements
    Route::get('corbeille/abonnement', [AbonnementController::class, 'corbeille'])->name('corbeille.abonnement');
    Route::get('corbeille/abonnement/{id}/restore', [AbonnementController::class, 'restore'])->name('corbeille.abonnement.restore');
    Route::get('corbeille/abonnement/{id}/destroy', [AbonnementController::class, 'destroy'])->name('corbeille.abonnement.destroy');
    // CRUD Factures
    Route::get('abonnement/{id}/factures', [FactureController::class, 'index'])->name('facture.index');
    Route::post('facture/{facture:id}/download', [FactureController::class, 'download'])->name('facture.download');
    Route::get('facture/{facture:id}/destroy', [FactureController::class, 'destroy'])->name('facture.destroy');
    // Corbeille Factures
    Route::get('corbeille/facture', [FactureController::class, 'corbeille'])->name('corbeille.facture');
});


require __DIR__.'/auth.php';
