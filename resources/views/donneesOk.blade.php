@extends('layout.blanc')

@section('contenu')
<section class="hero-section d-flex justify-content-center align-items-center" id="section_1" style="height: 100vh">
    <div class="container">

        <div class="text-center">
            <img src="{{ asset('success.png') }}" class="w-25">
            <h3 class="text-white mt-5">Données récupérées avec succès</h3>
        </div>

    </div>
</section>
@endsection