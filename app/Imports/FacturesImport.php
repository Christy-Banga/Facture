<?php

namespace App\Imports;

use App\Models\Facture;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class FacturesImport implements ToModel,WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
    public function model(array $row)
    {
        return new Facture([
            'numero_facture' => $row['numero'],
            'nom_fournisseur' => $row['nom_affiche_du_partenaire_de_la_facture'],
            'date_facturation' => $this->transformDate($row['date_de_facturation']),
            'date_echeance' => $this->transformDate($row['date_decheance']),
            'montant_HT' => $row['montant_ht'],
            'montant_TTC' => $row['total'],
            'etat_paiement' => $row['etat_du_paiement'],
            'file' => $this->fileName,
        ]);
    }

    public function __construct($fileName = null)
    {
        $this->fileName = $fileName;
    }
}
