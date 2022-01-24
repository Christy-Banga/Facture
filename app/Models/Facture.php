<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_facture',
        'nom_fournisseur',
        'date_facturation',
        'date_echeance',
        'montant_HT',
        'montant_TTC',
        'etat_paiement'
    ];
}
