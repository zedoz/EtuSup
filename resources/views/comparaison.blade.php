@extends('layout.blanc')


@section('css')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
@endsection


@section('contenu')
<section class="hero-section d-flex justify-content-center align-items-center">
    <div class="container">

        <div class="card shadow" style="border: none">
            <div class="card-header">
                <h3 class="card-title">Filtre</h3>
            </div>

            <div class="card-body">
                <form method="get" class="row">
                    <div class="form-group col-6 mt-2">
                        <label for="type" class="pb-1">Type de filtre</label>
                        <select id="type" class="form-control" name="type">
                            <option {{ request()->type == "etudiant" ? "selected" : "" }} value="etudiant">Etudiant</option>
                            <option {{ request()->type == "insertion" ? "selected" : "" }} value="insertion">Taux d'insertion</option>
                            <option {{ request()->type == "contractuel" ? "selected" : "" }} value="contractuel">Personnel contractuels</option>
                            <option {{ request()->type == "non_contractuel" ? "selected" : "" }} value="non_contractuel">Personnel titulaires</option>
                        </select>
                    </div>

                    <div class="form-group col-6 mt-2">
                        <label for="annee" class="pb-1">Année</label>
                        <select class="form-control" name="annee">
                            <option {{ request()->annee == "2010" ? "selected" : "" }} value="2010">2010</option>
                            <option {{ request()->annee == "2011" ? "selected" : "" }} value="2011">2011</option>
                            <option {{ request()->annee == "2012" ? "selected" : "" }} value="2012">2012</option>
                            <option {{ request()->annee == "2013" ? "selected" : "" }} value="2013">2013</option>
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

                    <div class="form-group col-6 mt-2">
                        <label for="annee" class="pb-1">Trie</label>
                        <select class="form-control" name="trie">
                            <option {{ request()->trie == "asc" ? "selected" : "" }} value="asc">Croissant</option>
                            <option {{ request()->trie == "desc" ? "selected" : "" }} value="desc">Décroissant</option>
                        </select>
                    </div>

                    <div class="form-group col-6 mt-2">
                        <label for="nbr_result" class="pb-1">Nombre de résultat</label>
                        <select class="form-control" name="nbr_result">
                            @for ($i = 0; $i < 50; $i++)
                                <option {{ request()->nbr_result == $i + 1 ? "selected" : "" }} value="{{ $i + 1 }}"> {{ $i + 1 }} </option>
                            @endfor
                        </select>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary">Filtrer</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="card mt-5 shadow" style="border: none">
            <div class="card-header">
                <h3 class="card-title">Comparaison ciblée</h3>
                <i>Sélectionner la liste des établissements que vous souhaitez comparer, puis mancer la comparaison.</i>
            </div>
            <div class="card-body">
                <form method="get" class="row">
                    <div class="form-group">
                        <label for="type" class="pb-1">Comparaison</label>
                        <select id="type" class="js-example-basic-multiple form-control" name="comparaison[]" multiple="multiple">
                            @foreach ($universite_all as $univ)
                                <option value="{{ $univ->id }}"> {{ $univ->uo_lib }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary">Comparer</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="card mt-5">
            <div class="card-header">
                <h3 class="modal-title">Résultat de filtre</h3>
            </div>
            <div class="card-body">

                @if($universites)
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>Universite</th>
                                    <th>Etudiant ({{ request()->annee ?? "2022" }}) </th>

                                    @if (request()->type == "insertion")
                                        <th> Domaine </th>
                                        <th> Discipline </th>
                                        <th> Taux (%) </th>
                                    @endif

                                    <th>Personnel contractuels</th>
                                    <th>Personnel titulaires</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (request()->type == "insertion")
                                    @foreach ($universites as $universite)
                                        <tr>
                                            <td> {{ $universite->universite->uo_lib }} </td>
                                            <td> {{ $universite->universite->inscrits_ . (request()->annee ?? "0") }} </td>
                                            <td> {{ $universite->domaine }} </td>
                                            <td> {{ $universite->discipline }} </td>
                                            <td> {{ $universite->taux_dinsertion }} </td>
                                            <td> {{ $universite->universite->personnels->where('type_personnel', 'contractuels')->count() }} </td>
                                            <td> {{ $universite->universite->personnels->where('type_personnel', '!=', 'contractuels')->count() }} </td>
                                            <td class="text-center">
                                                <a href="{{ route('universites.show', $universite->id) }}"><i class="fa fa-eye text-primary"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach ($universites as $universite)
                                        <tr>
                                            <td> {{ $universite->uo_lib }} </td>
                                            <td> {{ $universite->inscrits_ . (request()->annee ?? "0") }} </td>
                                            <td> {{ $universite->personnels->where('type_personnel', 'contractuels')->count() }} </td>
                                            <td> {{ $universite->personnels->where('type_personnel', '!=', 'contractuels')->count() }} </td>
                                            <td class="text-center">
                                                <a href="{{ route('universites.show', $universite->id) }}"><i class="fa fa-eye text-primary"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center">Aucun filtre n'a été appliqué</p>
                @endif

            </div>
        </div>

    </div>
</section>
@endsection



@section('js')
<script src="{{ asset('js/select2.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection