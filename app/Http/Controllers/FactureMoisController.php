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

        /* $TotalFactureMois = Facture::select(DB::raw("COUNT(*) as count"))
       ->whereYear("created_at",date('Y'))
        ->groupBy(DB::raw("Month(date_facturation)"))
        ->pluck('count'); */

        $prixTotalFacture =  DB::table('factures')->sum('montant_TTC');
        $prixMinFacture =  DB::table('factures')->min('montant_TTC');
        $prixMaxFacture =  DB::table('factures')->max('montant_TTC');
                 

        return Inertia::render('test',[
            'users' => User::count(),
            'factures' => $TotalFacture,
            'facturePayée' => $facturePayée,
            'chart' => LarapexChart::pieChart()
                ->setTitle('Total facture, payées, non payées')
                ->addData([$TotalFacture,$facturePayée,$factureNonPayée])
                ->setColors(['#ffc63b', '#ff6384','#D6652F'])
                ->setLabels(['Total facture','Facture payée','Facture non payée'])
                ->toVue(),
            'chart2' => LarapexChart::donutChart()
                ->setTitle('Total prix des factures')
                ->setSubtitle('')
                ->addData([$prixTotalFacture, $prixMinFacture, $prixMaxFacture])
                ->setLabels(['Prix total', 'Prix minimal', 'Prix maximal'])
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
