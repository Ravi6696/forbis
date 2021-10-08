<!-- active-button-col -->
<div class="foorbis-question-head foorbis-announces">
    <label><a href=""><i class="fas fa-angle-left mr-2"></i> Créer une offre
            d'emploi</a></label>
</div>
<hr style="border-color:#707070;">

<form method="post" id="frmAddJobOffer" enctype="multipart/form-data">
    @csrf
    <!-- header-col-input -->
    <div class="header-col-input">
        <div class="row">
            <div class="form-input icon-input col-12">
                <input type="hidden" name="jobOffer_id" placeholder="Nom" class="icon-input"
                    value="{{ $jobOffer->id ?? null }}">
                <input type="text" name="name" placeholder="Nom" class="icon-input" value="{{ $jobOffer->name ?? '' }}">
                <span><img src="images/edit-Intitule-icon.png" alt=""></span>
                <p class="error" id="error_name"></p>
            </div>
            <div class="form-input icon-input col-6">
                <input type="text" name="address_line_1" placeholder="Siret" class="icon-input"
                    value="{{ $address->address_line_1 ?? '' }}">
                <span><img src="images/location-Intitule-icon.png" alt=""></span>
                <p class="error" id="error_address_line_1"></p>
            </div>
            <div class="form-input icon-input col-6">
                <input type="text" name="address_line_2" placeholder="Adresse" class="icon-input"
                    value="{{ $address->address_line_2 ?? '' }}">
                <span><img src="images/location-Intitule-icon.png" alt=""></span>
                <p class="error" id="error_address_line_2"></p>
            </div>
            <div class="form-input icon-input col-6">
                <input type="text" name="city" placeholder="Ville" class="icon-input"
                    value="{{ $address->city ?? '' }}">
                <span><img src="images/location-Intitule-icon.png" alt=""></span>
                <p class="error" id="error_city"></p>
            </div>
            <div class="form-input icon-input col-6">
                <input type="number" min="0" name="postalcode" placeholder="Code postal" class="icon-input"
                    value="{{ $address->postalcode ?? '' }}">
                <span><img src="images/location-Intitule-icon.png" alt=""></span>
                <p class="error" id="error_postalcode"></p>
            </div>
        </div>

        <div class="row">
            <div class="form-input icon-input col-xl-4 col-sm-6">
                <select name="contract_type" id="contract_type">
                    <option value="">Contrat Type</option>
                    @foreach (getJobContractType() as $key => $item)
                    <option value="{{ $key }}" {{ $jobOffer && $jobOffer->contract_type == $key ? 'selected' : '' }}>
                        {{ $item }}
                    </option>
                    @endforeach
                </select>
                <span><img src="images/edit-Intitule-icon.png" alt=""></span>
                <p class="error" id="error_contract_type"></p>
            </div>

            <div class="form-input icon-input col-xl-4 col-sm-6">
                <select name="pace" id="pace">
                    <option value="" selected="" disabled="" hidden="">Rythme</option>
                    @foreach (getJobRythme() as $key => $item)
                    <option value="{{ $key }}" {{ $jobOffer && $jobOffer->pace == $key ? 'selected' : '' }}>{{ $item }}
                    </option>
                    @endforeach
                </select>
                <span><img src="images/par-Intitule-icon.png" alt=""></span>
                <p class="error" id="error_pace"></p>
            </div>

            <div class="form-input icon-input col-xl-4 col-sm-6">
                <input type="date" name="publication_date" placeholder="Date de publication" class="icon-input"
                    value="{{ $jobOffer->publication_date ?? null }}">
                <span><img src="images/date-icon.png" alt=""></span>
                <p class="error" id="error_publication_date"></p>
            </div>
        </div>
    </div>
    <!-- header-col-input -->

    <hr style="border-color:#707070;">

    <div class="Header-Recrutement mt-5">
        <h6>Présentation entreprise</h6>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tincidunt augue
            accumsan, </p>
        <textarea placeholder="Texte" name="description">{{ $jobOffer->description ?? '' }}</textarea>
        <p class="error" id="error_description"></p>
    </div>

    <div class="Header-Recrutement">
        <h6>Description du poste</h6>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tincidunt augue
            accumsan, </p>
        <textarea placeholder="Texte" name="presentation">{{ $jobOffer->presentation ?? '' }}</textarea>
        <p class="error" id="error_presentation"></p>
    </div>

    <div class="Header-Recrutement">
        <h6>Profil recherché</h6>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tincidunt augue
            accumsan, </p>
        <textarea placeholder="Texte" name="profile_sought">{{ $jobOffer->profile_sought ?? '' }}</textarea>
        <p class="error" id="error_profile_sought"></p>
    </div>

    <div class="text-right mt-lg-5">
        <button type="submit" class="foorbis-btn rechercher-btn">Créer
            offre d'emploi</button>
    </div>
</form>
