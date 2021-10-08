<!-- intitule-post-list-sub-itme -->
<div class="intitule-post-list d-flex ">
    <p class="mb-0">Mes offres d'emploi</p>
    <span>{{ $offers->count() }} offres</span>
</div>
<hr>
<div class="intitule-item-row scrollbar">
    @foreach ($offers as $offer)
    <!-- intitule-post-col -->
    <div class="intitule-cols">
        @if ($type == 'recruitment')
        <a class="intitule-remove btn-remove" data-id="{{$offer->id}}"> <img src="{{ asset('images/intitule-remove.png') }}"></a>
        @endif
        <div class="intitule-img"><img src="{{ $offer->company->company_logo_path ?? null }}"></div>
        <div class="intitule-sub-cols">
            <div class="intitule-info">
                <span>{{ $offer->company->name ?? null }}</span>
                <h6>{{ $offer->name }}</h6>
                <ul class="intitule-ul">
                    <li><img src="{{ asset('images/edit-Intitule-icon.png') }}"
                            class="mr-2">{{ $offer->contract_type ?? null }}</li>
                    <li><img src="{{ asset('images/location-Intitule-icon.png') }}"
                            class="mr-2">{{ $offer->full_address ?? null }}
                    </li>
                </ul>
                <ul class="intitule-ul">
                    <li><img src="{{ asset('images/date-Intitule-icon.png') }}"
                            class="mr-2">{{ $offer->created_at->diffForHumans() ?? '-' }}</li>
                    <li><img src="{{ asset('images/par-Intitule-icon.png') }}" class="mr-2">{{ $offer->pace ?? null }}
                    </li>
                </ul>
            </div>
            <div class="intitule-icon">
                @if ($type == 'recruitment')
                <a data-id="{{ $offer->id }}" class="btn-setting">
                    <img src="{{ asset('images/intitule-icon-setting.png') }}"></a>
                @else
                <a data-id="{{ $offer->id }}" data-action="job-detail" class="btn-apply">
                    <img src="images/intitule-icon-plus.png"></a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
