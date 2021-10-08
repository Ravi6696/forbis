<!-- intitule-post-list-sub-itme -->
<div class="intitule-post-list d-flex ">
    <p class="mb-0">Mes offres d'emploi</p>
    <span>{{ $applications->count() }} offres</span>
</div>
<hr>
<div class="intitule-item-row scrollbar">
    @foreach ($applications as $offer)
        <!-- intitule-post-col -->
        <div class="intitule-cols">
            <a class="intitule-remove"> <img src="{{ asset('images/intitule-remove.png') }}"></a>
            <div class="intitule-img"><img src="{{ asset('images/sqare-img.png') }}"></div>
            <div class="intitule-sub-cols">
                <div class="intitule-info">
                    <span>{{ $offer->company->name ?? null }}</span>
                    <h6>{{ $offer->name }}</h6>
                    <ul class="intitule-ul">
                        <li><img src="{{ asset('images/edit-Intitule-icon.png') }}"
                                class="mr-2">{{ $offer->contract_type ?? null }}</li>
                        <li><img src="{{ asset('images/location-Intitule-icon.png') }}"
                                class="mr-2">{{ $offer->company->full_address ?? null }}
                        </li>
                    </ul>
                    <ul class="intitule-ul">
                        <li><img src="{{ asset('images/date-Intitule-icon.png') }}"
                                class="mr-2">{{ $offer->created_at->diffForHumans() ?? '-' }}</li>
                        <li><img src="{{ asset('images/par-Intitule-icon.png') }}"
                                class="mr-2">{{ $offer->pace ?? null }}
                        </li>
                    </ul>
                </div>
                <div class="intitule-icon">
                    <a data-id="{{ $offer->id }}" href="Header-over-Recrutement-Recruteur-CréationOffre.html">
                        <img src="{{ asset('images/intitule-icon-setting.png') }}"></a>
                </div>
            </div>
        </div>
    @endforeach
</div>
