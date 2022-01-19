<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum','verified'])->get('/facture',[FactureController::class,'index'])->name('factures.index');
Route::middleware(['auth:sanctum','verified'])->post('/import_facture',[FactureController::class,'import_facture'])->name('import_facture');

Route::middleware(['auth:sanctum','verified'])->resource('/gestionnaire', UserController::class);

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        /* 'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION, */
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
