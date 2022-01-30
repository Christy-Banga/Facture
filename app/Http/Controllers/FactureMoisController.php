<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Console\Commands\ChartMakeCommand;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

class FactureMoisController extends Controller
{
    public function index(){
        
       
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
                

        return Inertia::render('test',[
            'users' => User::count(),
            'factures' => $TotalFacture,
            'facturePayée' => $facturePayée,
            'chart' => LarapexChart::pieChart()
                ->setTitle('Total facture, payées, non payées')
                ->addData([$factureNonPayée,$facturePayée,$TotalFacture])
                ->setColors(['#ffc63b', '#ff6384','#D6652F'])
                ->setLabels(['Total facture non payée', 'Total facture payée','Total facture'])
                ->toVue()
        ]);
    }

    /* protected function datas($year, $model)
    {
        return $model=DB::table('factures')->select(DB::raw('
            count(*) data, 
            month(created_at) month, 
            monthname(created_at) month_name
        '))
        ->whereYear('created_at', $year)
        ->groupBy('month', 'month_name')
        ->orderBy('month', 'asc')
        ->get();
    } */
}
