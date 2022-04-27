<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class IncoherenceController extends Controller
{
    public function index()
    {

        $prixTotalFacture =  DB::table('factures')->sum('montant_TTC');


        $monttMaxFac = Facture::select(['id', 'numero_facture', 'montant_TTC'])
                                ->orderBy('montant_TTC', 'desc')->first();

        $monttMinFac = Facture::select(['id', 'numero_facture', 'montant_TTC'])
                                ->orderBy('montant_TTC', 'asc')->first();




        return Inertia::render('NumberIncoherence',[
            'monttMaxFac' => $monttMaxFac,
            'monttMinFac' => $monttMinFac,
            'prixTotalFacture' => $prixTotalFacture,
        ]);
    }

    public function store(Request $request)
    {
       /*  $request->validate(([
            'valeur_global' => 'required'
        ]));
        $valeur_global = $request->input('valeur_global');
        $prixTotalFacture =  DB::table('factures')->sum('montant_TTC');
        $result = 0;

        if($valeur_global == $prixTotalFacture){
            $result = 'Il n\'y a pas d\'incoherence';
        }else{
            $result = 'Il y\'a incoherence';
        }

        return redirect()->route('incoherence')->with('success',$result); */
    }
}
