 <!DOCTYPE html>
 <html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <style>
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 105%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
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

 <h2>Situation liaisons spécialisés Mois </h2>

 <table>
   <tr>
     <th>N°Facture</th>
     <th>Fournisseur</th>
     <th>Date Début</th>
     <th>Date Fin</th>
     <th>Montant HT</th>
     <th>Montant TTC</th>
   </tr>
   @foreach ($factureExports as $factureExport)
    <tr>
        <td>{{ $factureExport->numero_facture }}</td>
        <td>{{ $factureExport->nom_fournisseur }}</td>
        <td>{{ $factureExport->date_facturation }}</td>
        <td>{{ $factureExport->date_echeance }}</td>
        <td>{{ $factureExport->montant_HT }}</td>
        <td>{{ $factureExport->montant_TTC }}</td>
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

