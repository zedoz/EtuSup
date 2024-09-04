<nav class="navbar navbar-expand-lg" style="background-image: linear-gradient(15deg, #80d0c7 0%, #13547a 100%)">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi-back"></i>
            <span>EtuSup</span>
        </a>

        <div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-5 me-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Accueil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('universites') }}">Universités</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comparaison') }}">Comparaison</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</nav>