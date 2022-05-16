<?php

namespace App\Http\Controllers;

use PDF;
use File;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Facture;
use Illuminate\Http\Request;
use App\Imports\FacturesImport;
use App\Events\SomeonePostedEvent;
use App\Notifications\SuppFacture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Notifications\FactureImport;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateFactureRequest;

class FactureController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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


        $datas = $query->paginate(7);

        /* $data = (clone $query)->paginate(7); */

        $dateFacturation = Facture::get('date_facturation')->first();
        $dateEcheance = Facture::get('date_echeance')->first();
        $prixTotalFactureTTC =  $datas->sum('montant_TTC');
        $prixTotalFactureHT =  $datas->sum('montant_HT');


        if($request->has('exportPDF')){
            $pdf = PDF::loadView('pdf',[
                'dateFacturation' => $dateFacturation,
                'dateEcheance' => $dateEcheance,
                'datas' => $datas,
                'prixTotalFactureHT' => $prixTotalFactureHT,
                'prixTotalFactureTTC' => $prixTotalFactureTTC,
                ]);
            return $pdf->stream();

        }if($request->has('print')){
            $pdf = PDF::loadView('pdf',[
                'dateFacturation' => $dateFacturation,
                'dateEcheance' => $dateEcheance,
                'datas' => $datas,
                'prixTotalFactureHT' => $prixTotalFactureHT,
                'prixTotalFactureTTC' => $prixTotalFactureTTC,
                ]);
            return $pdf->download('fact.pdf');
        }


        return Inertia::render('Facture/index',[
            'factures' => $datas,
            'filters' => request()->all(['search','field','direction']),
            'prixTotalFactureTTC' => $prixTotalFactureTTC,
            'prixTotalFactureHT' => $prixTotalFactureHT,
        ]);
    }

    public function displayLine(Request $request)
    {

        $lines = collect();

        return Inertia::render('Facture/Line/index',[
            'lines' => $lines
        ]);
    }

    public function readLines(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);


        $fileToUpload =  $request->excel_file;
        $extension = $fileToUpload->getClientOriginalExtension();
        $fileName = 'current.'.$extension;
        $file_path = storage_path('app/temp/'.$fileName);
        $path = storage_path('app/temp');
        $request->session()->put('temp_file', $file_path);
        if (!File::exists($path))
        {

            File::makeDirectory($path, 0755, true);
        }

        if (!$fileToUpload->storeAs('temp', $fileName))
        {
            dd('upload échoué');
        }


        $line = (new FacturesImport)->toArray($file_path);

        foreach($line as $lines){
            $lines;
        }


        return Inertia::render('Facture/Line/index',[
            'lines' => $lines
        ]);

    }

    public function saveFile(Request $request)
    {
        sleep(1);

        $request->session()->get('temp_file');

        $fileName = uniqid().'.'.pathinfo($request->session()->get('temp_file'), PATHINFO_EXTENSION);

        $user = User::firstWhere('role','admin');

        Excel::import(new FacturesImport($fileName,$user), $request->session()->get('temp_file'));

        event(new SomeonePostedEvent($user, auth()->user()));
        //$user->notify(new FactureImport(auth()->user()));

        File::move($request->session()->get('temp_file'), storage_path('app/public/'.$fileName));

        return Redirect()->route('facture.index')->with('success','La facture a été ajoutée !');
    }

  /*   public function report(Request $request)
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


        $datas = $query->paginate(7);


        $data = (clone $query)->paginate(7);


        $dateFacturation = Facture::get('date_facturation')->first();
        $dateEcheance = Facture::get('date_echeance')->first();
        $prixTotalFactureHT =  $datas->sum('montant_HT');
        $prixTotalFactureTTC =  $datas->sum('montant_TTC');


        $pdf = PDF::loadView('pdf',[
            'dateFacturation' => $dateFacturation,
            'dateEcheance' => $dateEcheance,
            'datas' => $datas,
            'prixTotalFactureHT' => $prixTotalFactureHT,
            'prixTotalFactureTTC' => $prixTotalFactureTTC
        ]);

        return $pdf->stream();

        return Inertia::render('Facture/index',[
            'factures' => $datas,
            'filters' => request()->all(['search','field','direction']),
            'prixTotalFactureTTC' => $prixTotalFactureTTC,
            'prixTotalFactureHT' => $prixTotalFactureHT,
        ]);
    } */

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
        if(!Gate::allows('access-admin'))
        {
            abort(403);
        }

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
        if(!Gate::allows('access-admin'))
        {
            abort(403);
        }

        $user = Facture::findOrFail($id);
        $user->delete();

        return Redirect::route('facture.index')->with('danger','La Facture a été supprimé!');
    }
}
