<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insertions', function (Blueprint $table) {
            $table->id();

            $table->string('id_paysage')->nullable();
            $table->string('annee')->nullable();
            $table->string('diplome')->nullable();
            $table->string('domaine')->nullable();
            $table->string('discipline')->nullable();
            $table->string('situation')->nullable();
            $table->string('remarque')->nullable();
            $table->string('emplois_cadre_ou_professions_intermediaires')->nullable();

            $table->string('taux_dinsertion')->nullable();
            $table->string('taux_d_emploi')->nullable();
            $table->string('taux_d_emploi_salarie_en_france')->nullable();
            $table->string('salaire_net_mensuel_regional_1er_quartile')->nullable();
            $table->string('salaire_net_mensuel_regional_3eme_quartile')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insertions');
    }
};
