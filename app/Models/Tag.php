<?php

namespace App\Models;

use App\Models\Facture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
}
