
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="Charles CAPO-CHICHI et Dorian GOMA">

        <title>EtuSup</title>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
        <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">

        <link href="{{ asset('template/css/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('template/css/templatemo-topic-listing.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

        @yield('css')
    </head>

    <body id="top">

        <main>
            @include('layout.header')

            @yield('contenu')
        </main>
        @include('layout.footer')

        <script src="{{ asset('template/js/jquery.min.js') }}"></script>
        <script src="{{ asset('template/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('template/js/jquery.sticky.js') }}"></script>

        @yield('js')

    </body>
</html>
