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

    <!-- Bootstrap js -->
    <script src="{{ asset('js/jquery-slim.min.js') }}"></script>


    <title>Forget Password</title>
</head>

<body>

    <!-- Whole login -->
    <section id="whole-login">
        <!-- Right side Form  -->
        <div class="sign-in-right-main row">
            <div class="main-form"></div>
            <div class="sign-in-right col-12 col-md-12 col-lg-5">
                <div class="full-right">
                    <img class="logo-signin" src="{{ asset('images/logo-signin.png') }}">
                    <div class="tabination">
                        <ul class="nav mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Inscription</a>
                        </ul>
                        <div>
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                            @endif
                        </div>
                        <!-- First Form -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <form action="{{ route('send-link-email') }}" method="post">
                                    @csrf

                                    <div class="inputWithIcon">
                                        <input type="email" name="email" placeholder="Adresse mail">
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                                    </div>

                                    <button type="submit" class="btn inscription">Connexion</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- left Side Img -->
            <div class="sign-in-left col-12 col-md-12 col-lg-7">
                <div class="logo-text">
                    <img class="left-logo-line" src="{{ asset('images/left-logo.png') }}">
                    <hr>
                    <p class="subtext-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut orci sit
                        <br> amet justo rhoncus eleifend ut a orci. Donec et eros pretium,<br> consectetur augue eget,
                        aliquam massa. Integer ac vulputate felis.<br> Vivamus ultrices arcu eu elementum dapibus. Nunc
                        at quam dictum, e.
                    </p>
                </div>
            </div>
        </div>
    </section>

</body>

<!-- Bootstrap js -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('js/foorbis-custom.js') }}"></script>

</html>
