<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyFactureChart;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Console\Commands\ChartMakeCommand;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

class FactureMoisController extends Controller
{
    public function index(MonthlyFactureChart $chart){
        $year = request()->input("year");

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

        $TotalFacture = Facture::count();

        $years = $this->fetch_year();


        return Inertia::render('Dashboard',[
            'users' => User::count(),
            'Totalfacture' => $TotalFacture,
            'facturePayée' => $facturePayée,
            'factureNonPayée' => $factureNonPayée,
            'chart' => $chart->build($year),
            'years' => $years
        ]);
    }

    public function fetch_year(){
        $years =  Facture::selectRaw("DATE_FORMAT(created_at, '%Y') AS year")
        ->groupBy('year')
        ->get();
        return $years;
    }
}
