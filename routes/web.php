<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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
    return 'organisation';
})->middleware(['auth'])->name('organisation');

Route::get('abonnement', function () {
    return Abonnement::all();
})->middleware(['auth'])->name('abonnement');

// Collaborateur

Route::get('collaborateur', [CollaborateurController::class, 'index'])
    ->name('collaborateur')
    ->middleware('auth');

Route::get('collaborateur/create', [CollaborateurController::class, 'create'])
    ->name('collaborateur.create')
    ->middleware('auth');

Route::post('collaborateur', [CollaborateurController::class, 'store'])
    ->name('collaborateur.store')
    ->middleware('auth');

Route::get('collaborateur/{contact}/edit', [CollaborateurController::class, 'edit'])
    ->name('collaborateur.edit')
    ->middleware('auth');

Route::put('collaborateur/{contact}', [CollaborateurController::class, 'update'])
    ->name('collaborateur.update')
    ->middleware('auth');

Route::delete('collaborateur/{contact}', [CollaborateurController::class, 'destroy'])
    ->name('collaborateur.destroy')
    ->middleware('auth');

Route::put('collaborateur/{contact}/restore', [CollaborateurController::class, 'restore'])
    ->name('collaborateur.restore')
    ->middleware('auth');


require __DIR__.'/auth.php';
