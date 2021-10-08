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


    <title>Login</title>
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
                            </li><a class="nav-link" href="#">/</a>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Connexion</a>
                            </li>
                        </ul>
                        <div>
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
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
                                <form action="{{ route('save-user') }}" method="post">
                                    @csrf
                                    <div class="inputWithIcon">
                                        <input type="text" placeholder="Intra nomine usuario" name="user_name">
                                        @error('user_name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                                    </div>
                                    <div class="inputWithIcon">
                                        <input type="email" name="email" placeholder="Adresse mail">
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                                    </div>

                                    <div class="inputWithIcon">
                                        <input type="password" name="password" placeholder="Mot de passe">
                                        @error('password')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                        <i class="fas fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                                    </div>
                                    <div class="inputWithIcon">
                                        <input type="password" placeholder="Confirmer mot de passe"
                                            name="confirm_password">
                                        @error('confirm_password')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                        <i class="fas fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                                    </div>
                                    <button type="submit" class="btn inscription">Inscription</button>
                                    <label class="container-checkbox">Se souvenir de moi
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                    <div class="social">
                                        <p class="social-head">Suivez nous sur</p>
                                        <div class="social-media-icon">
                                            <a href="#">
                                                <img src="{{ asset('images/fb.png') }}">
                                            </a>
                                            <a href="#">
                                                <img src="{{ asset('images/insta.png') }}">
                                            </a>
                                            <a href="#">
                                                <img src="{{ asset('images/twiter.png') }}">
                                            </a>
                                            <a href="#">
                                                <img src="{{ asset('images/linkdin.png') }}">
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Second Form -->
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <form action="{{ route('do-login') }}" method="post">
                                    @csrf

                                    <div class="inputWithIcon">
                                        <input type="email" name="email" placeholder="Adresse mail">
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                                    </div>

                                    <div class="inputWithIcon">
                                        <input type="password" name="password" placeholder="Mot de passe">
                                        @error('password')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                        <i class="fas fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                                    </div>

                                    <button type="submit" class="btn inscription">Connexion</button>
                                    <label class="two-inline container-checkbox">Se souvenir de moi
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                        <p><a href="{{ route('forget-password') }}">Mot de passe oublié</a></p>
                                    </label>


                                    <button type="button" class="btn avec-google btn-r"><a
                                            href="{{ route('auth-google') }}">Continuer
                                            avec
                                            Google</a></button>
                                    <div class="social">
                                        <p class="social-head">Suivez nous sur</p>
                                        <div class="social-media-icon">
                                            <a href="#">
                                                <img src="{{ asset('images/fb.png') }}">
                                            </a>
                                            <a href="#">
                                                <img src="{{ asset('images/insta.png') }}">
                                            </a>
                                            <a href="#">
                                                <img src="{{ asset('images/twiter.png') }}">
                                            </a>
                                            <a href="#">
                                                <img src="{{ asset('images/linkdin.png') }}">
                                            </a>
                                        </div>
                                    </div>
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
