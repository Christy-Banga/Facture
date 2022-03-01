<?php

namespace App\Charts;

use App\Models\Facture;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyFactureChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): array
    {
        $nombreFactureMois = Facture::select(DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count');

        $months = Facture::select(DB::raw("Month(created_at) as month"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('month');

        foreach($months as $index => $month){
                $datas[] = $nombreFactureMois[$index];
            }

        for($i=0; $i<12; $i++){
            if(!isset($datas[$i]))
            $datas[$i] = 0;
        }


        return $this->chart->barChart()
            ->setTitle('Nombre de facture par mois.')
            ->setSubtitle('Wins during season 2022.')
            ->addData('Nombre', ($datas))
            ->setXAxis(['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre'])
            ->setFontColor('#97774f')
            ->setFontFamily('DM Sans')
            ->toVue();
    }
}
