<?php

namespace Database\Seeders;

use App\Models\Enseignant;
use App\Models\Insertion;
use App\Models\Personnel;
use App\Models\Universite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GetApiDataSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {

        //-------------- Chargement des universites --------------------------------
        $response = Http::get(env('DATA_SET_API_BASE_URL') . "explore/v2.1/catalog/datasets/fr-esr-principaux-etablissements-enseignement-superieur/records?limit=-1");
        $etablissements1 = $response->json();

        $response = Http::get(env('DATA_SET_API_BASE_URL') . "explore/v2.1/catalog/datasets/fr-esr-principaux-etablissements-enseignement-superieur/records?limit=-1&offset=100");
        $etablissements2 = $response->json();

        $etablissements = array_merge($etablissements1['results'], $etablissements2['results']);
        foreach ($etablissements as $et) {
            Universite::create([
                "etablissement_id_paysage" => $et['etablissement_id_paysage'],
                "uo_lib" => $et['uo_lib'],
                "nom_court" => $et['nom_court'],
                "sigle" => $et['sigle'],
                "type_d_etablissement" => json_encode($et['type_d_etablissement']),
                "secteur_d_etablissement" => $et['secteur_d_etablissement'],
                "localisation" => $et['localisation'],
                "url" => $et['url'],
                "coordonnees" => json_encode($et['coordonnees']),
                "texte_de_ref_creation" => $et['texte_de_ref_creation'],
                "com_nom" => $et['com_nom'],
                "dep_nom" => $et['dep_nom'],
                "reg_nom" => $et['reg_nom'],
                "adresse_uai" => $et['adresse_uai'],
                "pays_etranger_acheminement" => $et['pays_etranger_acheminement'],
                "statut_juridique_court" => $et['statut_juridique_court'],
                "statut_juridique_long" => $et['statut_juridique_long'],
                "inscrits" => $et['inscrits'],
                "inscrits_2010" => $et['inscrits_2010'],
                "inscrits_2011" => $et['inscrits_2011'],
                "inscrits_2012" => $et['inscrits_2012'],
                "inscrits_2013" => $et['inscrits_2013'],
                "inscrits_2014" => $et['inscrits_2014'],
                "inscrits_2015" => $et['inscrits_2015'],
                "inscrits_2016" => $et['inscrits_2016'],
                "inscrits_2017" => $et['inscrits_2017'],
                "inscrits_2018" => $et['inscrits_2018'],
                "inscrits_2019" => $et['inscrits_2019'],
                "inscrits_2020" => $et['inscrits_2020'],
                "inscrits_2021" => $et['inscrits_2021'],
                "inscrits_2022" => $et['inscrits_2022'],
            ]);
        }


        //-------------- Chargement du personnel --------------------------------
        for ($i=0; $i < 10000; $i += 100) {
            $response = Http::get(env('DATA_SET_API_BASE_URL') . "explore/v2.1/catalog/datasets/fr-esr-personnels-biatss-etablissements-publics/records?limit=-1&offset=$i&order_by=rentree desc");
            $persos = $response->json();

            foreach ($persos['results'] as $key => $perso) {
                Personnel::create([
                    "etablissement_id_paysage" => $perso["etablissement_id_paysage"],
                    "rentree" => $perso["rentree"],
                    "annee_universitaire" => $perso["annee_universitaire"],
                    "type_personnel" => $perso["type_personnel"],
                    "categorie" => $perso["categorie"],
                    "code_corps" => $perso["code_corps"],
                    "corps_lib" => $perso["corps_lib"],
                    "filiere_lib" => $perso["filiere_lib"],
                    "effectif" => $perso["effectif"],
                    "effectif_femmes" => $perso["effectif_femmes"],
                    "effectif_hommes" => $perso["effectif_hommes"],
                    "classe_age3" => $perso["classe_age3"],
                    "code_filiere" => $perso["code_filiere"],
                    "type" => "personnel",
                ]);
            }
        }



        //-------------- Chargement des enseiganants -------------------------------
        for ($i=0; $i < 10000; $i += 100) {
            $response = Http::get(env('DATA_SET_API_BASE_URL') . "explore/v2.1/catalog/datasets/fr-esr-enseignants-titulaires-esr-public/records?limit=-1&offset=$i&order_by=rentree desc");
            $enseignants = $response->json();
            // dd($enseignants, $response->json());

            foreach ($enseignants['results'] as $key => $enseignant) {
                Enseignant::create([
                    "etablissement_id_paysage" => $enseignant['etablissement_id_paysage'],
                    "rentree" => $enseignant['rentree'],
                    "sexe" => $enseignant['sexe'],
                    "categorie_assimilation" => $enseignant['categorie_assimilation'],
                    "grande_discipline" => $enseignant['grande_discipline'],
                    "groupe_cnu" => $enseignant['groupe_cnu'],
                    "section_cnu" => $enseignant['section_cnu'],
                    "code_categorie_assimil" => $enseignant['code_categorie_assimil'],
                    "code_groupe_cnu" => $enseignant['code_groupe_cnu'],
                    "code_grande_discipline" => $enseignant['code_grande_discipline'],
                    "effectif" => $enseignant['effectif'],
                    "code_section_cnu" => $enseignant['code_section_cnu'],
                    "annee_universitaire" => $enseignant['annee_universitaire'],
                    "classe_age3" => $enseignant['classe_age3'],
                    "quotite" => $enseignant['quotite'],
                ]);
            }
        }

        // -------------- Chargement des insertions -------------------------------
        // ------------------------------- Licence pro
        for ($i=0; $i < 10000; $i += 100) {
            $response = Http::get(env('DATA_SET_API_BASE_URL') . "explore/v2.1/catalog/datasets/fr-esr-insertion_professionnelle-lp/records?limit=-1&offset=$i&order_by=annee desc");
            $inserssions = $response->json();
            // dd($inserssions, $response->json());

            foreach ($inserssions['results'] as $key => $inserssion) {
                Insertion::create([
                    "id_paysage" => $inserssion['id_paysage'],
                    "annee" => $inserssion['annee'],
                    "diplome" => $inserssion['diplome'],
                    "domaine" => $inserssion['domaine'],
                    "discipline" => $inserssion['discipline'],
                    "situation" => $inserssion['situation'],
                    "remarque" => $inserssion['remarque'],
                    "taux_dinsertion" => $inserssion['taux_dinsertion'],
                    "taux_d_emploi" => $inserssion['taux_d_emploi'],
                    "taux_d_emploi_salarie_en_france" => $inserssion['taux_d_emploi_salarie_en_france'],
                    "salaire_net_mensuel_regional_1er_quartile" => $inserssion['salaire_net_mensuel_regional_1er_quartile'],
                    "salaire_net_mensuel_regional_3eme_quartile" => $inserssion['salaire_net_mensuel_regional_3eme_quartile'],
                    "emplois_cadre_ou_professions_intermediaires" => $inserssion['emplois_cadre_ou_professions_intermediaires'],
                ]);
            }
        }

        // ------------------------------- Licence Master
        for ($i=0; $i < 10000; $i += 100) {
            $response = Http::get(env('DATA_SET_API_BASE_URL') . "explore/v2.1/catalog/datasets/fr-esr-insertion_professionnelle-master/records?limit=-1&offset=$i&order_by=annee desc");
            $inserssions = $response->json();
            // dd($inserssions, $response->json());

            foreach ($inserssions['results'] as $key => $inserssion) {
                Insertion::create([
                    "id_paysage" => $inserssion['id_paysage'],
                    "annee" => $inserssion['annee'],
                    "diplome" => $inserssion['diplome'],
                    "domaine" => $inserssion['domaine'],
                    "discipline" => $inserssion['discipline'],
                    "situation" => $inserssion['situation'],
                    "remarque" => $inserssion['remarque'],
                    "taux_dinsertion" => $inserssion['taux_dinsertion'],
                    "taux_d_emploi" => $inserssion['taux_d_emploi'],
                    "taux_d_emploi_salarie_en_france" => $inserssion['taux_d_emploi_salarie_en_france'],
                    "salaire_net_mensuel_regional_1er_quartile" => $inserssion['salaire_net_mensuel_regional_1er_quartile'],
                    "salaire_net_mensuel_regional_3eme_quartile" => $inserssion['salaire_net_mensuel_regional_3eme_quartile'],
                    "emplois_cadre_ou_professions_intermediaires" => $inserssion['emplois_cadre_ou_professions_intermediaires'],
                ]);
            }
        }

    }
}
