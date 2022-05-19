<?php

use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('numero_facture');
            $table->string('nom_fournisseur');
            $table->date('date_facturation');
            $table->date('date_echeance');
            $table->float('montant_HT');
            $table->float('montant_TTC');
            $table->string('etat_paiement');
            $table->string('file');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Tag::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
