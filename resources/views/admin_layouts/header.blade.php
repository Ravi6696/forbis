<!DOCTYPE html>
<html>

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/foorbis-custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/foorbis-responive.css') }}" type="text/css">
    <!-- font-awsome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    @stack('styles')
    <!-- Bootstrap js -->
    <script src="{{ asset('js/jquery-slim.min.js') }}"></script>
    <title>Header-Professionnel</title>
</head>

<body>
    <!-- Whole login -->
    <section id="foorbis-col">
        <header class="foorbis-header">
            <div class="foorbis-header-container">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="#"><img src="images/logo-signin.png"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#foorbis-menu"
                        aria-controls="foorbis-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="foorbis-menu">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">A propos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Actualités</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link foorbis-btn" href="#">Recrutement</a>
                            </li>
                        </ul>
                    </div>
                    <div class="form-inline my-2 my-lg-0 foorbis-serchbar-col">
                        <i class="fas fa-bars responive-left-menu"></i>
                        <input class="foorbis-serchbar" type="search">
                        <div class="d-flex align-items-center foorbis-right-col">
                            <div class="foorbis-right-icon mr-3 ml-3"><img src="images/message-icon.png"><span
                                    class="number-item">12</span></div>
                            <div class="foorbis-right-icon mr-3"><img src="images/notification-icon.png"><span
                                    class="number-item">12</span></div>
                            <div class="foorbis-right-icon"><img src="images/setting-icon.png"></div>

                 
       </div>
                    </div>
                </nav>
            </div>
        </header>