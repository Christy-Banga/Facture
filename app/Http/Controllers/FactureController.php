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
use App\Models\User;

class FactureController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:numero_facture,nom_fournisseur,date_facturation,date_echeance,montant_HT,montant_TTC,etat_paiement']
        ]);

        $query = Facture::query();

        if(request('search')) {
            $query->where('numero_facture','LIKE','%'.request('search').'%')
                  ->orWhere('nom_fournisseur','LIKE','%'.request('search').'%')
                  ->orWhere('date_facturation','LIKE','%'.request('search').'%')
                  ->orWhere('date_echeance','LIKE','%'.request('search').'%');
        }

        if(request()->has(['field','direction'])){
            $query->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('Facture/index',[
            'factures' => $query->paginate(5),
            'filters' => request()->all(['search','field','direction'])
        ]);
    }

    public function import_facture(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new FacturesImport, storage_path('app/temp/current.xlsx'));

        $lines = (new FacturesImport)->toArray(storage_path('app/temp/current.xlsx'));
        /* dd($lines); */

/*         return Redirect::route('facture.Line')->with('success', 'Facture importée avec succès');
 */
        return Inertia::render('Facture.Line',[
            'lines' => $lines
        ]);
 }


    public function displayLine(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);


        $fileToUpload =  $request->file('excel_file');
        $extension = $fileToUpload->getClientOriginalExtension();
        $fileName = 'current.'.$extension;
        $file_path = storage_path('app/temp/'.$fileName);

        if (!$fileToUpload->storeAs($file_path, $fileName))
        {
            dd('upload échoué');
        }



/*         Excel::import(new FacturesImport, storage_path('app/temp/current.xlsx'));
 */
        $lines = (new FacturesImport)->toArray($file_path);



        return Inertia::render('Facture.Line',[
            'lines' => $lines
        ])->with('success', 'Facture importée avec succès');
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
    public function edit($id)
    {
        $facture = Facture::findOrFail($id);

        return Inertia::render('Facture/edit',compact('facture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFactureRequest  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFactureRequest $request,$id)
    {
        $facture = Facture::findOrFail($id);

        $facture->update($request->all());

        return Redirect::route('facture.index')->with('warning','La facture a été modifiée!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Facture::findOrFail($id);
        $user->delete();

        return Redirect::route('facture.index')->with('danger','La Facture a été supprimé!');
    }
}
