@if (Auth::user()->hasRole('pro-user'))
    <div class="foorbis-sidebar scrollbar">
        <i class="fas fa-times foorbis-sidebar-close"></i>
        <div class="foorbis-profile"><img src="{{ asset('images/y-company.png') }}"></div>
        <p class="foorbis-profile-name">Nom Entreprise</p>
        <div class="foorbis-sliderbar-col-item">
            <ul>
                <li><a href="{{ route('dashboard') }}"><img src="{{ asset('images/dashbord.png') }}"
                            class="mr-3">Dashboard</a></li>
                <li><a href="#"><img src="{{ asset('images/location.png') }}" class="mr-3">Recherche</a></li>
                <li><a href="#"><img src="{{ asset('images/messges.png') }}" class="mr-3">Mes annonces</a></li>
                <li><a href="#"><img src="{{ asset('images/forum.png') }}" class="mr-3">Forum</a></li>
                <li><a href="#"><img src="{{ asset('images/message.png') }}" class="mr-3">Messagerie</a></li>
            </ul>
        </div>
        <div class="foorbis-sliderbar-bottom-button">
            <a href="#" class="main-btn foorbis-btn sidebar-foorbis-btn">Passer à la version pro</a>
        </div>

    </div>
@else
    <div class="foorbis-sidebar scrollbar">
        <i class="fas fa-times foorbis-sidebar-close"></i>
        <div class="foorbis-profile"><img src="images/profile.png"></div>
        <p class="foorbis-profile-name">Nom Prénom</p>
        <div class="foorbis-sliderbar-col-item">
            <ul>
                <li><a href="#"><img src="images/messges.png" class="mr-3">Annonces</a></li>
                <li><a href="#"><img src="images/location.png" class="mr-3">Recherche</a></li>
                <li><a href="#"><img src="images/user.png" class="mr-3">Mon profil</a></li>
                <li><a href="#"><img src="images/user.png" class="mr-3">Mon profil</a></li>
                <li><a href="#"><img src="images/user.png" class="mr-3">Mon profil</a></li>
                <li><a href="#"><img src="images/user.png" class="mr-3">Mon profil</a></li>
            </ul>
        </div>
        <div class="foorbis-sliderbar-bottom-button">
            <a href="#" class="main-btn foorbis-btn sidebar-foorbis-btn">Passer à la version pro</a>
        </div>

    </div>
@endif
