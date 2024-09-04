@extends('layout.blanc')


@section("css")
    <style>
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 2rem;
            cursor: pointer;
        }
    </style>
@endsection


@section('contenu')
<section class="hero-section d-flex justify-content-center align-items-center" id="section_1" style="height: 100vh;">

    <div style="position: absolute; height: 100%; width: 100%">
        <img src="{{ asset('bg1.jpeg') }}" style="height: 100%; width: 100%" class="d-none d-md-block">
        <img src="{{ asset('b1_mobile.jpg') }}" style="height: 100%; width: 100%" class="d-md-none">
        <div class="overlay"></div>
      </div>

    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-12 mx-auto">
                <h1 class="text-white text-center">Faites vos recherches</h1>

                <h6 class="text-center">Plateforme de visualisation des données pour les établissements d'enseignement supérieur.</h6>

                <form method="get" action="{{ route('universites') }}" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bi-search" id="basic-addon1">

                        </span>

                        <input name="entreprise" type="search" class="form-control" id="keyword" placeholder="Nom ou commune de l'établissement" aria-label="Search">
                        <button type="submit" class="form-control">Rechercher</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection