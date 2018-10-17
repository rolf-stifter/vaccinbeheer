<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vaccinbeheer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.5/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <script src="js/app.js"></script>
</head>
<body>

    <!-- NAV BAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Vaccinbeheer</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05"
                aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('stock.index')}}">Voorraad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('requests.index')}}">Aanvragen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vaccinations.index')}}">Vaccinaties</a>
                    </li>
                    <hr class="" />
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Beheer
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Voorraad</a>
                            <a class="dropdown-item" href="#">Aanvragen</a>
                            <a class="dropdown-item" href="#">Vaccinaties</a>
                            <a class="dropdown-item" href="#">Gebruikers</a>
                            <a class="dropdown-item" href="#">Vaccins</a>
                            <a class="dropdown-item" href="#">Scholen</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Profiel</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Afmelden</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    <!-------------->
    <div class="container">
            @yield('content')
    </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
    @yield('javascript')
</html>