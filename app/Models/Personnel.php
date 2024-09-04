<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model {
    use HasFactory;

    protected $fillable = [
        "etablissement_id_paysage",
        "rentree",
        "annee_universitaire",
        "type_personnel",
        "categorie",
        "code_corps",
        "corps_lib",
        "filiere_lib",
        "effectif",
        "effectif_femmes",
        "effectif_hommes",
        "classe_age3",
        "code_filiere",
    ];

}
