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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();

            $table->string('etablissement_id_paysage')->nullable();
            $table->string('rentree')->nullable();
            $table->string('annee_universitaire')->nullable();
            $table->string('type_personnel')->nullable();
            $table->string('categorie')->nullable();
            $table->string('code_corps')->nullable();
            $table->string('corps_lib')->nullable();
            $table->string('filiere_lib')->nullable();
            $table->string('effectif')->nullable();
            $table->string('effectif_femmes')->nullable();
            $table->string('effectif_hommes')->nullable();
            $table->string('classe_age3')->nullable();
            $table->string('code_filiere')->nullable();

            $table->string('type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
