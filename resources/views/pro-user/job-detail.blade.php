<div class="foorbis-question-head foorbis-announces">
    <label><i class="fas fa-angle-left mr-2"></i> Detaill offre demplon</label>
</div>
<hr>
<div class="intitule-cols">
    <a href="{{ route('company-details',$jobOffer->company_id)}}" class="intitule-remove"><button class="send-message-btn refresh-btn">En savoir
            plus</button></a>
    <div class="viorOffre-col">
        <div class="intitule-img viorOffre-img"><img src="{{ $jobOffer->company->company_logo_path ?? null }}"></div>
        <div class="intitule-sub-cols">
            <div class="intitule-info width">
                <span>{{ $jobOffer->company->name ?? '-' }}</span>
                <h6>{{ $jobOffer->name ?? '-' }}</h6>
                <ul class="intitule-ul">
                    <li><img src="images/edit-Intitule-icon.png"
                            class="mr-2">{{ $jobOffer->contract_type ?? '-' }}
                    </li>
                    <li><img src="images/location-Intitule-icon.png"
                            class="mr-2">{{ $jobOffer->full_address ?? '-' }}
                    </li>
                    <li><img src="images/date-Intitule-icon.png"
                            class="mr-2">{{ $jobOffer->created_at->diffForHumans() ?? '-' }}</li>
                    <li><img src="images/par-Intitule-icon.png" class="mr-2">{{ $jobOffer->pace ?? '-' }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="voiroffre-info">
        <div class="voiroffre-col">
            <h6 class="title"> Présentation entreprise</h6>
            <p class="title-info ">{{$jobOffer->description}}</p>
        </div>
        <div class="voiroffre-col">
            <h6 class="title"> Description du poste</h6>
            <p class="title-info ">{{$jobOffer->presentation}}</p>
        </div>
        <div class="voiroffre-col">
            <h6 class="title"> Profil recherché</h6>
            <p class="title-info ">{{$jobOffer->profile_sought}}</p>
        </div>
    </div>

    <div class="btnbox text-center my-5">
        <button class="btn postuler btn-apply" data-id="{{ $jobOffer->id }}" data-action="job-apply">Postuler</button>
    </div>
</div>
