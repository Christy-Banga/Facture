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

    public function build($year=null): array
    {
        $nombreFactureMois = Facture::select(DB::raw("COUNT(*) as count"))
                    ->when(is_null($year),function($q){
                        $q->whereYear('created_at', date('Y'));
                    })

                    ->when(!is_null($year),function($q) use($year){
                        $q->whereYear('created_at', $year);
                    })
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('count');

                    $months = Facture::select(DB::raw("Month(created_at) as month"))
                    ->when(is_null($year),function($q){
                        $q->whereYear('created_at', date('Y'));
                    })

                    ->when(!is_null($year),function($q) use($year){
                        $q->whereYear('created_at', $year);
                    })

                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('month');

        foreach($months as $index => $month){
                $datas[] = $nombreFactureMois[$index];
            }
        for($i=0; $i<12; $i++){
            if(empty($datas[$i]))
            $datas[$i] = 0;
        }

        return $this->chart->barChart()
            ->setTitle('Nombre total de factures par mois')
            ->addData('Nombre', ($datas))
            ->setXAxis(['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre'])
            ->setFontColor('#97774f')
            ->setFontFamily('DM Sans')
            ->toVue();
    }


}
