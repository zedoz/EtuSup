<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model {
    use HasFactory;

    protected $fillable = [
        "etablissement_id_paysage",
        "rentree",
        "sexe",
        "categorie_assimilation",
        "grande_discipline",
        "groupe_cnu",
        "section_cnu",
        "code_categorie_assimil",
        "code_groupe_cnu",
        "code_grande_discipline",
        "effectif",
        "code_section_cnu",
        "annee_universitaire",
        "classe_age3",
        "quotite",
    ];

}
