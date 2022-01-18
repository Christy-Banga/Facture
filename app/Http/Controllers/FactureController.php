<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Facture;
use Illuminate\Http\Request;
use App\Imports\FacturesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateFactureRequest;


class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Facture::query();

        if(request('search')) {
            $query->where('numero_facture','LIKE','%'.request('search').'%')
                  ->orWhere('nom_fournisseur','LIKE','%'.request('search').'%')
                  ->orWhere('date_facturation','LIKE','%'.request('search').'%')
                  ->orWhere('date_echeance','LIKE','%'.request('search').'%');       
        }

        return Inertia::render('Facture/index',[
            'factures' => $query->get()
        ]);
    }

    public function import_facture(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new FacturesImport, $request->file('excel_file'));

        return Redirect::route('factures.index')->with('success', 'Facture importée avec succès');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFactureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFactureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFactureRequest  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFactureRequest $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        //
    }
}
