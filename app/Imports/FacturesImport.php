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
            'reference' => $row['reference'],
            'montant_HT' => $row['montant_ht'],
            'montant_TTC' => $row['total'],
            'etat_paiement' => $row['etat_du_paiement'],
            'file' => $this->fileName,
            'user_id' => $this->user,
            'tag_id' => $this->tag_id
        ]);
    }

    public function __construct($fileName = null, $user = null, $tag_id = null)
    {
        $this->fileName = $fileName;
        $this->user = $user;
        $this->tag_id = $tag_id;
    }
}
