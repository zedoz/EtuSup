<?php

namespace App\Http\Controllers;

use App\Models\Insertion;
use App\Models\Universite;
use Illuminate\Http\Request;

class UniversiteController extends Controller {

    public function index(Request $request) {
        $universites = Universite::query();

        if ($request->entreprise) {
            $universites = $universites->where('uo_lib', 'like', '%' . $request->entreprise . '%')->orWhere('com_nom', 'like', '%' . $request->entreprise . '%');
        }

        if ($request->trie) {
            $universites = $universites->where('uo_lib', 'like', '%' . $request->entreprise . '%')->orWhere('com_nom', 'like', '%' . $request->entreprise . '%');

            switch ($request->trie) {
                case 'nom_croiss':
                    $universites = $universites->orderBy('uo_lib', 'asc');
                    break;

                case 'nom_decroiss':
                    $universites = $universites->orderByDesc('uo_lib', 'desc');
                    break;

                case 'com_nom_croiss':
                    $universites = $universites->orderBy('com_nom', 'asc');
                    break;

                case 'com_nom_decroiss':
                    $universites = $universites->orderByDesc('com_nom', 'desc');
                    break;

                default:
                    # code...
                    break;
            }
        }

        $universites = $universites->paginate(10);
        return view('listUniversite', compact('universites'));
    }

    public function show(Request $request, Universite $universite){
        $insertions = $universite->insertions;

        $insertionChatData = $this->insertionChatData($universite->id_paysage);
        $personnelChatData = $this->personnelChatData($universite);

        return view('detailUniversite', compact('universite', 'insertions', 'personnelChatData', 'insertionChatData'));
    }

    public function personnelChatData($universite) {
        $personnels = $universite->personnels;

        $chatData = [
            "2010" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2011" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2012" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2013" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2014" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2015" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2016" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2017" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2018" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2019" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2020" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2021" => [
                "titulaires" => 0,
                "contractuels" => 0
            ],
            "2022" => [
                "titulaires" => 0,
                "contractuels" => 0
            ]
        ];

        foreach ($personnels as $person) {
            $chatData[$person->rentree][$person->type_personnel] ++;
        }

        return $chatData;
    }

    public function insertionChatData($id_paysage) {
        $annee = request()->annee ?? 2020;
        $diplome = request()->diplome ?? "licence";

        $insertions = Insertion::where("id_paysage", $id_paysage)->where('diplome', 'like', '%' . $diplome . '%')->where("annee", $annee)->get();
        $chart_data = [
            "libelle" => [],
            "data" => []
        ];

        foreach ($insertions as $insertion) {
            if (!in_array($insertion->domaine, $chart_data["libelle"])) {
                $chart_data["libelle"][] = $insertion->domaine;
                $key = array_search($insertion->domaine, $chart_data["libelle"]);

                $chart_data["data"][$key] = 0;
            }

            $chart_data["data"][$key] = ($chart_data["data"][$key] + $insertion->taux_dinsertion) / 2;
        }

        return $chart_data;
    }

    public function comparaison() {
        $universites = null;

        if (count(request()->all()) > 0) {
            $universites = Universite::query()->with('personnels')->with('insertions');

            if (request()->type) {
                switch (request()->type) {
                    case 'etudiant':
                        $universites = $universites->orderBy('inscrits_' . request()->annee ?? 2022, request()->trie ?? 'desc');
                        break;

                    case 'insertion':
                        $universites = Insertion::where('taux_dinsertion', '!=', 'ns')
                                                    ->whereNotNull('taux_dinsertion')
                                                    ->where('taux_dinsertion', '!=', 'ns')
                                                    ->where('taux_dinsertion', '!=', 'nd')
                                                    ->where('annee', request()->annee ?? 2014)
                                                    ->whereHas("universite", function($u){
                                                        return $u->with('personnels');
                                                    })->orderBy('taux_dinsertion', request()->trie ?? 'desc')
                                                    ->limit(request()->nbr_result ?? 5)
                                                    ->get();

                        break;

                    case 'contractuel':
                        $universites = $universites->whereHas('personnels', function($p){
                            return $p->where('type_personnel', 'contractuels');
                        })->withCount(['personnels' => function($query) {
                            $query->where('type_personnel', 'contractuels');
                        }])->orderBy('personnels_count', request()->trie ?? 'desc');
                        break;

                    case 'non_contractuel':
                        $universites = $universites->whereHas('personnels', function($p){
                            return $p->where('type_personnel', 'titulaires');
                        })->withCount(['personnels' => function($query) {
                            $query->where('type_personnel', 'titulaires');
                        }])->orderBy('personnels_count', request()->trie ?? 'desc');
                        break;

                    default:
                        # code...
                        break;
                }

                if (request()->type != "insertion") {
                    $universites = $universites->take(request()->nbr_result ?? 5)->get();
                }
            } else if(request()->comparaison) {
                $universites = Universite::find([request()->comparaison]);
            }
        }

        $universite_all = Universite::get(['id', 'uo_lib']);
        return view('comparaison', compact('universites', 'universite_all'));
    }

}