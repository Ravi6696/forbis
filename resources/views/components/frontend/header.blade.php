<div>
    <header class="foorbis-header">
        <div class="foorbis-header-container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="#"><img src="{{ asset('images/logo-signin.png') }}"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#foorbis-menu"
                    aria-controls="foorbis-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="foorbis-menu">
                    <ul class="navbar-nav mr-auto">
                        @if (!Auth::user()->hasRole('admin'))
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('apropos') }}">A propos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('actualities') }}">Actualités</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link foorbis-btn" href="{{ route('recrutement') }}">Recrutement</a>
                        </li>
                    </ul>
                </div>
                <div class="form-inline my-2 my-lg-0 foorbis-serchbar-col">
                    <i class="fas fa-bars responive-left-menu"></i>
                    <input class="foorbis-serchbar" type="search">
                    <div class="d-flex align-items-center foorbis-right-col">
                        <div class="foorbis-right-icon mr-3 ml-3 message-popup"><img src="{{ asset('images/message-icon.png')}}"><span
                                class="number-item">12</span></div>
                        <div class="foorbis-right-icon mr-3 notification-popup"><img
                                src="{{ asset('images/notification-icon.png')}}"><span class="number-item">12</span></div>
                        <div class="foorbis-right-icon"><img src="{{ asset('images/setting-icon.png')}}"></div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</div>
