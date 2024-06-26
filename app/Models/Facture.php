<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'numero_facture',
        'nom_fournisseur',
        'date_facturation',
        'date_echeance',
        'reference',
        'montant_HT',
        'montant_TTC',
        'etat_paiement',
        'file',
        'user_id',
        'tag_id'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function($facture){
            $facture->user()->associate(auth()->user()->id);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
