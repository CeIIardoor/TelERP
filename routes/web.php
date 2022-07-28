<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Collaborateur;
use App\Models\Organisation;
use App\Models\Abonnement;
use App\Http\Controllers\CollaborateurController;

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

Route::get('abonnement', function () {
    return Abonnement::all();
})->middleware(['auth'])->name('abonnement');

Route::get('collaborateur', [CollaborateurController::class, 'index'])->middleware(['auth'])->name('collaborateur');
Route::get('collaborateur/create', [CollaborateurController::class, 'create'])->middleware(['auth'])->name('collaborateur.create');
Route::post('collaborateur/store', [CollaborateurController::class, 'store'])->middleware(['auth'])->name('collaborateur.store');
Route::post('collaborateur/{collaborateur:id}', [CollaborateurController::class, 'update'])->middleware(['auth'])->name('collaborateur.edit');
Route::get('collaborateur/{collaborateur:id}/delete', [CollaborateurController::class, 'delete'])->middleware(['auth'])->name('collaborateur.delete');

Route::get('collaborateur/corbeille', [CollaborateurController::class, 'corbeille'])->middleware(['auth'])->name('collaborateur.corbeille');
Route::post('collaborateur/corbeille/restore/{collaborateur:id}', [CollaborateurController::class, 'restore'])->middleware(['auth'])->name('collaborateur.restore');
Route::get('collaborateur/corbeille/{collaborateur:id}/destroy', [CollaborateurController::class, 'destroy'])->middleware(['auth'])->name('collaborateur.destroy');


require __DIR__.'/auth.php';
