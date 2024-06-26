<!DOCTYPE html>
 <html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>



    <style>
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 131%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }

        h4{
            text-align: center;
        }

        .prixText{
            font-size: 20px;
            border: none;
        }

        .noTrait{
            border: none;
        }
        .oo{
            border: 1px solid #dddddd;
        }
        .prix{
            font-size: 20px;
        }

         .eco2{
            padding-left: 40%;
            padding-top: -12%;
        }
        .eco3{
            padding-left: 69%;
            padding-top: -38%;
        }
    </style>
 </head>
 <body>

    <div class="eco1" style="height: 50px; width:200px">
        <div><img src="img/eco1.jpg" /></div>
    </div>

    <div class="eco2" style="height: 20%; width:15%;">
        <div><img src="img/eco2.png" /></div>
    </div>

    <div class="eco3" style="height: 50px; width:200px">
        <div><img src="img/eco3.jpeg" /></div>
    </div>

    {{-- <div>type: {{ App\Models\Facture::findOrFail($datas->tag->name) }}</div> --}}
 <h4>Situation liaisons spécialisés Mois
    @if ($dateFacturation && $dateEcheance)
    {{ Carbon\Carbon::parse($dateFacturation->date_facturation)->format('M Y') }} à
    {{ Carbon\Carbon::parse($dateEcheance->date_echeance)->format('M Y') }}
    @endif
 </h4>

 <table>
   <tr>
     <th>N°Facture</th>
     <th>Abonnement</th>
{{--      <th>Fournisseur</th>
 --}}     <th>Reference</th>
     <th>Date Début</th>
     <th>Date Fin</th>
     <th>Montant HT</th>
     <th>Montant TTC</th>
   </tr>
   @foreach ($datas as $data)
    <tr>
        <td>{{ $data->numero_facture }}</td>
        <td>{{ $data->tag->name }}</td>
{{--         <td>{{ $data->nom_fournisseur }}</td>
 --}}        <td>{{ $data->reference }}</td>
        <td>{{ Carbon\Carbon::parse($data->date_facturation)->format('M Y') }}</td>
        <td>{{ Carbon\Carbon::parse($data->date_echeance)->format('M Y') }}</td>
        <td>{{ $data->montant_HT }}</td>
        <td>{{ $data->montant_TTC }}</td>
    </tr>
   @endforeach
   <tr class="oo">
    <td class="noTrait"></td>
    <td class="prixText">Total</td>
    <td class="noTrait"></td>
    <td class="noTrait"></td>
    <td class="noTrait"></td>
{{--     <td class="noTrait"></td>
 --}}    <td class="prix">{{$prixTotalFactureHT}} Dhs</td>
    <td class="prix">{{ $prixTotalFactureTTC }} Dhs</td>
    </tr>
 </table>

 </body>
 </html>

