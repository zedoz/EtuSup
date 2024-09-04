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
        Schema::create('universites', function (Blueprint $table) {
            $table->id();

            $table->string('etablissement_id_paysage')->nullable();
            $table->string('uo_lib')->nullable();
            $table->string('nom_court')->nullable();
            $table->string('sigle')->nullable();
            $table->string('type_d_etablissement')->nullable();
            $table->string('secteur_d_etablissement')->nullable();
            $table->string('localisation')->nullable();
            $table->string('url')->nullable();
            $table->string('coordonnees')->nullable();
            $table->string('texte_de_ref_creation')->nullable();
            $table->string('com_nom')->nullable();
            $table->string('dep_nom')->nullable();
            $table->string('reg_nom')->nullable();
            $table->string('adresse_uai')->nullable();
            $table->string('pays_etranger_acheminement')->nullable();
            $table->string('statut_juridique_court')->nullable();
            $table->string('statut_juridique_long')->nullable();
            $table->string('inscrits')->nullable();
            $table->string('inscrits_2010')->nullable();
            $table->string('inscrits_2011')->nullable();
            $table->string('inscrits_2012')->nullable();
            $table->string('inscrits_2013')->nullable();
            $table->string('inscrits_2014')->nullable();
            $table->string('inscrits_2015')->nullable();
            $table->string('inscrits_2016')->nullable();
            $table->string('inscrits_2017')->nullable();
            $table->string('inscrits_2018')->nullable();
            $table->string('inscrits_2019')->nullable();
            $table->string('inscrits_2020')->nullable();
            $table->string('inscrits_2021')->nullable();
            $table->string('inscrits_2022')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universite');
    }
};
