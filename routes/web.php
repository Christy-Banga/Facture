<?php

use App\Models\User;
use Inertia\Inertia;
use App\Models\Facture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FactureMoisController;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

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

Route::middleware(['auth:sanctum','verified'])->get('/',[FactureMoisController::class,'index'])->name('dashboard');


/* Route::middleware(['auth:sanctum','verified'])->get('/', function () {
    //Requete pour les graphiques
$facturePayée = DB::table('factures')
->select(DB::raw('count(*) as total, etat_paiement'))
->where('etat_paiement', '=', 'Payé')
->groupBy('etat_paiement')
->count();

$factureNonPayée = DB::table('factures')
->select(DB::raw('count(*) as total, etat_paiement'))
->where('etat_paiement', '=', 'Non payées')
->groupBy('etat_paiement')
->count();
    return Inertia::render('Dashboard', [
        'users' => User::count(),
        'factures' => Facture::count(),
        'facturePayée' => DB::table('factures')
        ->select(DB::raw('count(*) as total, etat_paiement'))
        ->where('etat_paiement', '=', 'Payé')
        ->groupBy('etat_paiement')
        ->count(),
        'chart' => (new ArielMejiaDev\LarapexCharts\LarapexChart())->barChart()
        ->setTitle('San Francisco vs Boston.')
        ->setSubtitle('Wins during season 2021.')
        ->addData('San Francisco', [6, 9, 3, 4, 10, 8, 9, 10, 4, 7, 5])
        ->setXAxis(['Janvier', 'Fevrirer', 'Mars', 'Avril', 'Mai', 'Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre'])
            ->toVue(),
            'chart2' => LarapexChart::pieChart()
            ->setTitle('Factures')
            ->addData([
                
                $factureNonPayée,
                $facturePayée
            ])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setLabels(['Facture non payée', 'Facture payée'])
            ->toVue()
    ]);
})->name('dashboard'); */
//requete nombre total de facture par mois
//requete prix total des factures par mois


require __DIR__.'/auth.php';
