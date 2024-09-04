<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();

            $table->string('etablissement_id_paysage')->nullable();
            $table->string('rentree')->nullable();
            $table->string('sexe')->nullable();
            $table->string('categorie_assimilation')->nullable();
            $table->string('grande_discipline')->nullable();
            $table->string('groupe_cnu')->nullable();
            $table->string('section_cnu')->nullable();
            $table->string('code_categorie_assimil')->nullable();
            $table->string('code_groupe_cnu')->nullable();
            $table->string('code_grande_discipline')->nullable();
            $table->string('effectif')->nullable();
            $table->string('code_section_cnu')->nullable();
            $table->string('annee_universitaire')->nullable();
            $table->string('classe_age3')->nullable();
            $table->string('quotite')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignants');
    }
};
