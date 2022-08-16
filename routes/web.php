<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Abonnement;
use App\Models\Organisation;
use App\Models\Facture;
use App\Http\Controllers\AbonnementController;

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

Route::get('facture', function () {
    return Facture::all();
})->middleware(['auth'])->name('facture');

Route::group(['middleware' => 'auth'], function () {
    Route::get('abonnement', [AbonnementController::class, 'index'])->name('abonnement');
    Route::get('abonnement/create', [AbonnementController::class, 'create'])->name('abonnement.create');
    Route::post('abonnement/store', [AbonnementController::class, 'store'])->name('abonnement.store');
    Route::post('abonnement/{abonnement:id}', [AbonnementController::class, 'update'])->name('abonnement.edit');
    Route::get('abonnement/{abonnement:id}/delete', [AbonnementController::class, 'delete'])->name('abonnement.delete');

    Route::get('corbeille/abonnement', [AbonnementController::class, 'corbeille'])->name('corbeille.abonnement');
    Route::get('corbeille/abonnement/{id}/restore', [AbonnementController::class, 'restore'])->name('corbeille.abonnement.restore');
    Route::get('corbeille/abonnement/{id}/destroy', [AbonnementController::class, 'destroy'])->name('corbeille.abonnement.destroy');
});


require __DIR__.'/auth.php';
