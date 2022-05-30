<!DOCTYPE html>
 <html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <style>
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 106%;
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
    </style>
 </head>
 <body>

    {{-- <div>type: {{ App\Models\Facture::findOrFail($datas->tag->name) }}</div> --}}
 <h4>Situation liaisons spécialisés Mois
     {{ Carbon\Carbon::parse($dateFacturation->date_facturation)->format('M Y') }} à
     {{ Carbon\Carbon::parse($dateEcheance->date_echeance)->format('M Y') }}
 </h4>

 <table>
   <tr>
     <th>N°Facture</th>
     <th>Fournisseur</th>
     <th>Date Début</th>
     <th>Date Fin</th>
     <th>Montant HT</th>
     <th>Montant TTC</th>
   </tr>
   @foreach ($datas as $data)
    <tr>
        <td>{{ $data->numero_facture }}</td>
        <td>{{ $data->nom_fournisseur }}</td>
        <td>{{ Carbon\Carbon::parse($data->date_facturation)->format('M Y') }}</td>
        <td>{{ Carbon\Carbon::parse($data->date_echeance)->format('M Y') }}</td>
        <td>{{ $data->montant_HT }}</td>
        <td>{{ $data->montant_TTC }}</td>
        {{-- <td>{{ $data->tag->name }}</td> --}}
    </tr>
   @endforeach
   <tr class="oo">
    <td class="noTrait"></td>
    <td class="prixText">Total</td>
    <td class="noTrait"></td>
    <td class="noTrait"></td>
    <td class="prix">{{$prixTotalFactureHT}} Dhs</td>
    <td class="prix">{{ $prixTotalFactureTTC }} Dhs</td>
    </tr>
 </table>

 </body>
 </html>

