<?php

use App\Models\User;
use Inertia\Inertia;
use App\Models\Facture;
use Illuminate\Support\Facades\DB;
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

Route::middleware(['auth:sanctum','verified'])->resource('/facture',FactureController::class);

Route::middleware(['auth:sanctum','verified'])->post('/import_facture',[FactureController::class,'import_facture'])->name('import_facture');

Route::middleware(['auth:sanctum','verified'])->resource('/gestionnaire', UserController::class);

Route::middleware(['auth:sanctum','verified'])->get('/', function () {
    return Inertia::render('Dashboard', [
        'users' => User::count(),
        'factures' => Facture::count(),
        'facturePayée' => DB::table('factures')
        ->select(DB::raw('count(*) as total, etat_paiement'))
        ->where('etat_paiement', '=', 'Payé')
        ->groupBy('etat_paiement')
        ->count()
    ]);
})->name('dashboard');

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'users' => User::count(),
        'factures' => Facture::count(),
        'facturePayée' => DB::table('factures')
        ->select(DB::raw('count(*) as total, etat_paiement'))
        ->where('etat_paiement', '=', 'Payé')
        ->groupBy('etat_paiement')
        ->count()
    ]);
})->name('dashboard'); */


require __DIR__.'/auth.php';
