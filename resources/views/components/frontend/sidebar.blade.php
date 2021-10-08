<div>
    <div class="foorbis-sidebar scrollbar">
        <i class="fas fa-times foorbis-sidebar-close"></i>
        <div class="foorbis-profile">
            @if (Auth::user()->hasRole('admin'))
            <img src="{{ Auth::user()->profile_path ?? asset('images/Admin-logo.png') }}">
            @elseif(Auth::user()->hasRole('pro-user'))
            <img src="{{ Auth::user()->profile_path ?? asset('images/y-company.png') }}">
            @else
            <img src="{{ Auth::user()->profile_path ?? asset('images/avatar.png') }}">
            @endif
        </div>
        <p class="foorbis-profile-name">{{ auth()->user()->full_name ?? '' }}</p>
        <div class="foorbis-sliderbar-col-item">
            @role('admin')
            <ul>
                <li><a href="{{ route('apropos')}}"><img src="{{ asset('images/dual-messanger.png')}}"
                            class="mr-3 {{request()->routeIs('apropos') ? 'active' : ''}}">A propos</a></li>
                <li><a href="{{ route('actualities')}}"><img src="{{ asset('images/location.png')}}"
                            class="mr-3 {{request()->routeIs('actualities') ? 'active' : ''}}">Actualités</a></li>
                <li><a href="{{ route('admin.clients')}}"><img src="{{ asset('images/user.png')}}"
                            class="mr-3 {{request()->routeIs('admin.clients') ? 'active' : ''}}">Clients</a></li>
                <li><a href="{{ route('admin.messages')}}"><img src="{{ asset('images/message.png')}}"
                            class="mr-3 {{request()->routeIs('admin.messages') ? 'active' : ''}}">Messagerie</a></li>
                <li><a href="{{ route('admin.category')}}"><img src="{{ asset('images/dashbord.png')}}"
                            class="mr-3 {{request()->routeIs('admin.category') ? 'active' : ''}}">Categories</a></li>
                <li><a href="{{ route('admin.statistices')}}"><img src="{{ asset('images/message.png')}}"
                            class="mr-3 {{request()->routeIs('admin.statistices') ? 'active' : ''}}">Statistiques</a>
                </li>
            </ul>
            @endrole
            @role('user')
            <ul>
                <li><a href="{{ route('announces') }}"><img src="{{ asset('images/messges.png') }}"
                            class="mr-3">Annonces</a></li>
                <li><a href="{{route('recherche')}}"><img src="{{ asset('images/location.png') }}"
                            class="mr-3">Recherche</a>
                </li>
                <li><a href="{{ route('profile') }}"><img src="{{ asset('images/user.png') }}" class="mr-3">Mon
                        profil</a></li>
            </ul>
            @endrole
            @role('pro-user')
            <ul>
                <li><a href="{{ route('pro.dashboard') }}"><img src="{{ asset('images/dashbord.png') }}"
                            class="mr-3 {{ request()->routeIs('pro.dashboard') ? 'active' : ''}}">Dashboard</a></li>
                <li><a href="{{ route('recherche') }}"><img src="{{ asset('images/location.png') }}"
                            class="mr-3 {{ request()->routeIs('pro.dashboard') ? 'active' : ''}}">Recherche</a></li>
                <li><a href="{{ route('pro-annonces') }}"><img src="{{ asset('images/messges.png') }}"
                            class="mr-3 {{ request()->routeIs('pro-annonces') ? 'active' : ''}}">Mes annonces</a>
                </li>

                <li><a href="{{ route('forum') }}"><img src="{{ asset('images/forum.png') }}"
                            class="mr-3 {{ request()->routeIs('forum') ? 'active' : ''}}">Forum</a></li>
                <li><a href="{{ route('pro-messages') }}"><img src="{{ asset('images/message.png') }}"
                            class="mr-3 {{ request()->routeIs('pro-messages') ? 'active' : ''}}">Messagerie</a></li>
            </ul>
            @endrole
        </div>
        @role('user')
        <div class="foorbis-sliderbar-bottom-button">
            <a href="{{ route('become-pro-user') }}" class="main-btn foorbis-btn sidebar-foorbis-btn">Passer à la
                version pro</a>
        </div>
        @endrole
    </div>
</div>
