<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universite extends Model {
    use HasFactory;

    protected $fillable =  [
        "etablissement_id_paysage",
        "uo_lib",
        "nom_court",
        "sigle",
        "type_d_etablissement",
        "secteur_d_etablissement",
        "localisation",
        "url",
        "coordonnees",
        "texte_de_ref_creation",
        "com_nom",
        "dep_nom",
        "reg_nom",
        "adresse_uai",
        "pays_etranger_acheminement",
        "statut_juridique_court",
        "statut_juridique_long",
        "inscrits",
        "inscrits_2010",
        "inscrits_2011",
        "inscrits_2012",
        "inscrits_2013",
        "inscrits_2014",
        "inscrits_2015",
        "inscrits_2016",
        "inscrits_2017",
        "inscrits_2018",
        "inscrits_2019",
        "inscrits_2020",
        "inscrits_2021",
        "inscrits_2022",
    ];


    public function enseignants() {
        return $this->hasMany(Enseignant::class, 'etablissement_id_paysage', 'etablissement_id_paysage');
    }

    public function insertions() {
        return $this->hasMany(Insertion::class, 'id_paysage', 'etablissement_id_paysage');
    }

    public function personnels() {
        return $this->hasMany(Personnel::class, 'etablissement_id_paysage', 'etablissement_id_paysage');
    }

}
