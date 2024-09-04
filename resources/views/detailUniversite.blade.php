@extends('layout.blanc')

@section('contenu')
<section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
    <div class="container">

        <h2 class="text-center text-white">{{ $universite->uo_lib }}</h2>

        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title">Informations générales</h5>

                    <table class="table table-light table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <i class="fa fa-hashtag mx-3" aria-hidden="true"></i>
                                    {{ $universite->secteur_d_etablissement }}
                                </td>
                                <td>
                                    <i class="fa fa-hashtag mx-3" aria-hidden="true"></i>
                                    {{ json_decode($universite->type_d_etablissement)[0] }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-location-arrow mx-3" aria-hidden="true"></i>
                                    {{ explode('>', $universite->localisation)[1] . ' ( ' .  explode('>', $universite->localisation)[0] . ' )' }}
                                </td>
                                <td>
                                    <i class="fa fa-map-marker mx-3" aria-hidden="true"></i>
                                    {{ $universite->adresse_uai }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title">Enseignants</h6>
                        <p class="card-text"> {{ $universite->enseignants->count() }} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title">Personnels</h6>
                        <p class="card-text"> {{ $universite->personnels->count() }} </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mt-5" style="height: 500px">
                    <div class="card-header">
                        <h5>Evolution des inscription des etudiants</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="etudiantsChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-5" style="height: 500px">
                    <div class="card-header">
                        <h5>Insertion proffetionelle</h5>
        
        
                        <form method="get">
                            <div class="d-flex justify-content-around my-3">
                                <div class="form-group col-6">
                                    <select class="form-control" name="annee">
                                        <option value="">Année</option>
                                        <option {{ request()->annee == "2010" ? "selected" : "" }} value="2010">2010</option>
                                        <option {{ request()->annee == "2011" ? "selected" : "" }} value="2011">2011</option>
                                        <option {{ request()->annee == "2012" ? "selected" : "" }} value="2012">2012</option>
                                        <option {{ request()->annee == "2013" ? "selected" : "" }} value="2013">2013</option>
                                        <option {{ request()->annee == "2014" ? "selected" : "" }} value="2014">2014</option>
                                        <option {{ request()->annee == "2014" ? "selected" : "" }} value="2014">2014</option>
                                        <option {{ request()->annee == "2015" ? "selected" : "" }} value="2015">2015</option>
                                        <option {{ request()->annee == "2016" ? "selected" : "" }} value="2016">2016</option>
                                        <option {{ request()->annee == "2017" ? "selected" : "" }} value="2017">2017</option>
                                        <option {{ request()->annee == "2018" ? "selected" : "" }} value="2018">2018</option>
                                        <option {{ request()->annee == "2019" ? "selected" : "" }} value="2019">2019</option>
                                        <option {{ request()->annee == "2020" ? "selected" : "" }} value="2020">2020</option>
                                        <option {{ request()->annee == "2021" ? "selected" : "" }} value="2021">2021</option>
                                        <option {{ request()->annee == "2022" ? "selected" : "" }} value="2022">2022</option>
                                        {{-- <option {{ request()->annee == "2023" ? "selected" : "" }} value="2023">2023</option>
                                        <option {{ request()->annee == "2024" ? "selected" : "" }} value="2024">2024</option> --}}
                                    </select>
                                </div>
        
                                <div class="form-group col-6">
                                    <select id="my-select" class="form-control" name="diplome">
                                        <option value="">Diplôme</option>
                                        <option {{ request()->diplome == "licence" ? "selected" : "" }} value="licence">Licence</option>
                                        <option {{ request()->diplome == "master" ? "selected" : "" }} value="master">Master</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary">Filtrer</button>
                            </div>
                        </form>

                    </div>
                    <div class="card-body">
                        <canvas id="insertion"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h5>Personnel administratif</h5>
            </div>
            <div class="card-body">
                <canvas id="personnelChart" style="width: 100%; height: 450px;"></canvas>
            </div>
        </div>

    </div>
</section>

@endsection


@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const ctx = document.getElementById('etudiantsChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [ "2010", "2011", "2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019", "2020", "2021", "2022"],
            datasets: [{
                label: "Nombre d'inscription",
                data: [
                    {{ $universite->inscrits_2010?? 0 }},
                    {{ $universite->inscrits_2011?? 0 }},
                    {{ $universite->inscrits_2012?? 0 }},
                    {{ $universite->inscrits_2013?? 0 }},
                    {{ $universite->inscrits_2014?? 0 }},
                    {{ $universite->inscrits_2015?? 0 }},
                    {{ $universite->inscrits_2016?? 0 }},
                    {{ $universite->inscrits_2017?? 0 }},
                    {{ $universite->inscrits_2018?? 0 }},
                    {{ $universite->inscrits_2019?? 0 }},
                    {{ $universite->inscrits_2020?? 0 }},
                    {{ $universite->inscrits_2021?? 0 }},
                    {{ $universite->inscrits_2022?? 0 }},
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });



    const ctx_perso = document.getElementById('insertion');
    let ctx_perso_data = @json($insertionChatData);
    console.log(ctx_perso_data);

    new Chart(ctx_perso, {
        type: 'bar',
        data: {
            labels: ctx_perso_data['libelle'],
            datasets: [{
                label: "Nombre d'inscription",
                data: ctx_perso_data['data'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });



    const ctx2 = document.getElementById('personnelChart');
    let ras = @json($personnelChatData['2021']);
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: [ "2010", "2011", "2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019", "2020", "2021", "2022"],
            datasets: [{
                label: "Personnel titulaires",
                data: [
                    {{ $personnelChatData['2010']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2011']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2012']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2013']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2014']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2015']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2016']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2017']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2018']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2019']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2020']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2021']['titulaires'] ?? 0 }},
                    {{ $personnelChatData['2022']['titulaires'] ?? 0 }},
                ],
                borderWidth: 1
            }, {
                label: "Personnel contractuels",
                data: [
                    {{ $personnelChatData['2010']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2011']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2012']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2013']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2014']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2015']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2016']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2017']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2018']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2019']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2020']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2021']['contractuels'] ?? 0 }},
                    {{ $personnelChatData['2022']['contractuels'] ?? 0 }},
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection