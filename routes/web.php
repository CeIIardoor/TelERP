<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Abonnement;

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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/organisations', function () {
    return Inertia::render('Organisations');
})->middleware(['auth'])->name('organisations');

Route::get('/abonnements', function () {
    return Abonnement::all();
})->middleware(['auth'])->name('abonnements');

Route::get('/collaborateurs', function () {
    return Inertia::render('Collaborateurs');
})->middleware(['auth'])->name('collaborateurs');

require __DIR__.'/auth.php';
