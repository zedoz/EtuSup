<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insertion extends Model {
    use HasFactory;

    protected $fillable = [
        "id_paysage",
        "annee",
        "diplome",
        "domaine",
        "discipline",
        "situation",
        "remarque",
        "taux_dinsertion",
        "taux_d_emploi",
        "taux_d_emploi_salarie_en_france",
        "salaire_net_mensuel_regional_1er_quartile",
        "salaire_net_mensuel_regional_3eme_quartile",
        "emplois_cadre_ou_professions_intermediaires",
    ];

    public function universite() {
        return $this->belongsTo(Universite::class, 'id_paysage', 'etablissement_id_paysage');
    }
}
