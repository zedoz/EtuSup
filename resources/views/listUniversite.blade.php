@extends('layout.blanc')

@section("css")
    <style>
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 2rem;
            cursor: pointer;
        }

        .my-badge {
            color: #ffffff;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.8rem;
            transition: background-color 0.3s ease-in-out;
        }

        #trie {
            background-color: white;
            border: white solid 1px;
            color: white;
            border-radius: 25px;
            font-weight: bold;
            font-size: 1.3em;
            padding: 20px 10px;
            margin-top: 2px;
            margin-right: 5px;
            background-color: #74c2bf;
            width: 150px;
        }
    </style>
@endsection

@section('contenu')
<section class="hero-section d-flex justify-content-center align-items-center" id="section_1">

    {{-- <div style="position: absolute; height: 100%; width: 100%">
        <img src="{{ asset('bg1.jpeg') }}" style="height: 100%; width: 100%; position: fixed">
        <div class="overlay"></div>
    </div> --}}

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12 mx-auto mb-5">
                <form method="get" class="custom-form mt-4 pt-2 mb-lg-0" role="search">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bi-search" id="basic-addon1"></span>

                        <input name="entreprise" type="search" class="form-control" id="keyword"
                            placeholder="Nom ou commune de l'établissement" aria-label="Search"
                            value="{{ request()->entreprise ?? '' }}">
                        <button type="submit" class="form-control mx-2">Rechercher</button>
                        {{-- <button type="submit" class="form-control mx-2">Rechercher</button> --}}

                        <div class="form-group">
                            <select id="trie" name="trie">
                                <option>Trie ...</option>
                                <option value="nom_croiss">Nom croissant</option>
                                <option value="nom_decroiss">Nom décroissant</option>
                                <option value="com_nom_croiss">Commune croissant</option>
                                <option value="com_nom_decroiss">Commune décroissant</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>

            <div class="row">

                {{-- <div class="offset-9 col-3 my-3">
                    <div class="form-group">
                        <select id="trie" class="form-control" name="trie">
                            <option>Trie ...</option>
                            <option value="nom_croiss">Nom croissant</option>
                            <option value="nom_decroiss">Nom décroissant</option>
                            <option value="id_croiss">Id paysage croissant</option>
                            <option value="id_decroiss">Id paysage décroissant</option>
                        </select>
                    </div>
                </div> --}}

                @foreach ($universites as $univ)
                <div class="col-md-6 p-2">
                    <a href="{{ route('universites.show', $univ->id) }}" class="w-100">
                        <div class="card-header" style="width: 93%">
                            <div style="position: relative" class="p-0">
                                <img src="{{ asset('bg.jpg') }}" class="w-100 p-0 m-0" style="height: 300px;">
                                <div
                                    style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(0,0,0,0.5)">
                                </div>

                                <div class="d-flex justify-content-center text-center px-3"
                                    style="position: absolute; top: 40%; bottom: 0; left: 0; right: 0;">
                                    <h6 class="position-absolute text-white" style="top: 0">
                                        {{ $univ->uo_lib }}
                                        {{-- <br> ( {{ $univ->etablissement_id_paysage }} ) --}}
                                    </h6>
                                </div>

                                <div class="d-flex justify-content-center text-center px-3"
                                    style="position: absolute; top: 7%; left: 1%;">
                                    <span class="my-badge text-{{ $univ->secteur_d_etablissement == "privé" ? "white" : "dark" }} text-uppercase" style="background-color: {{ $univ->secteur_d_etablissement == "privé" ? "#15009e" : "#ffcc00" }};">
                                        {{ $univ->secteur_d_etablissement }}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </a>

                    <div class="card" style="width: 93%">
                        <div class="card-body" style="height: 120px">
                            <p class="card-text">
                                <ul class="list-unstyled">
                                    {{-- <li> Secteur : {{ $univ->secteur_d_etablissement }}</li> --}}
                                    <li>
                                        <i class="fas fa-location text-success mx-2"></i>
                                        {{ explode('>', $univ->localisation)[1] . ' ( ' .  explode('>', $univ->localisation)[0] . ' )' }}
                                    </li>
                                    <li>
                                        <i class="fa fa-link text-primary" style="margin: 0px 5px"></i>
                                        <a href="{{ $univ->url }}" class="text-primary"> {{ $univ->url }} </a>
                                    </li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-center">
            {!! $universites->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</section>
@endsection

@section('js')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script>
    $('#trie').change(function () {
        let trie = $(this).val();
        let entrteprise = $('#entreprise').val() == undefined ? $('#entreprise').val() : '';

        if ($('#entreprise').val() == undefined || $('#entreprise').val() == '') {
            window.location.href = "{{ route('universites') }}?trie=" + trie;
        } else {
            window.location.href = "{{ route('universites') }}?trie=" + trie + "&entreprise=" + $('#entreprise')
                .val();
        }

    });

</script>
@endsection
