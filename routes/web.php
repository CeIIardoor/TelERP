<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Collaborateur;
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

Route::get('collaborateur', [CollaborateurController::class, 'index'])->middleware(['auth'])->name('collaborateur');


require __DIR__.'/auth.php';
