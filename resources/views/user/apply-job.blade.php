<div class="foorbis-question-head foorbis-announces">
    <label><i class="fas fa-angle-left mr-2"></i> Detaill offre demplon</label>
</div>
<hr>
<div class="intitule-col-height scrollbar">
    <div class="intitule-col mb-1">
        <div class="viorOffre-col">
            <div class="intitule-img viorOffre-img"><img src="{{$jobOffer->company->company_logo_path ??null}}"></div>
            <div class="intitule-sub-cols">
                <div class="intitule-info width">
                    <span>{{$jobOffer->company->name ?? '-'}}</span>
                    <h6>{{$jobOffer->name ?? '-'}}</h6>
                    <ul class="intitule-ul">
                        <li><img src="images/edit-Intitule-icon.png" class="mr-2">{{$jobOffer->contract_type ?? '-'}}
                        </li>
                        <li><img src="images/location-Intitule-icon.png" class="mr-2">{{$jobOffer->full_address ?? '-'}}
                        </li>
                        <li><img src="images/date-Intitule-icon.png"
                                class="mr-2">{{$jobOffer->created_at->diffForHumans() ?? '-'}}</li>
                        <li><img src="images/par-Intitule-icon.png" class="mr-2">{{$jobOffer->pace ??'-'}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="postuler-top-col">
            <div class="intitule-col-p-all">
                <p class="fs-md">Postuler</p>
                <p class="fs-md">Infos personnelles</p>
                <form enctype="multipart/form-data" id="frmApplyJob" method="post">
                    @csrf
                    <input type="hidden" name="job_offer_id" id="job_offer_id" value="{{$jobOffer->id ?? null}}">
                    <div class="row m-0 justify-content-between">
                        <div class="col-md-6 px-0">
                            <div class="d-flex justify-content-end align-items-end">
                                <span class="text-pink mt-auto mb-0">*</span>
                            </div>
                            <input type="text" class="mt-0" placeholder="Prénom" name="first_name" id="first_name">
                            <p class="error" id="error_first_name"></p>
                        </div>
                        <div class="col-md-6 pl-md-2 pl-0 pr-0">
                            <div class="d-flex justify-content-end align-items-end">
                                <span class="text-pink mt-auto mb-0">*</span>
                            </div>
                            <input type="text" class="mt-0" placeholder="Nom de famille" name="last_name"
                                id="last_name">
                            <p class="error" id="error_last_name"></p>
                        </div>
                    </div>
                    <div class="row m-0 justify-content-between">
                        <div class="col-md-6 px-0">
                            <div class="d-flex justify-content-end align-items-end">
                                <span class="text-pink mt-auto mb-0">*</span>
                            </div>
                            <input type="text" name="address_line_1" placeholder="Siret" class="icon-input">
                            <p class="error" id="error_address_line_1"></p>
                        </div>
                        <div class="col-md-6 px-0">
                            <div class="d-flex justify-content-end align-items-end">
                                <span class="text-pink mt-auto mb-0">*</span>
                            </div>
                            <input type="text" name="address_line_2" placeholder="Adresse" class="icon-input">
                            <p class="error" id="error_address_line_2"></p>
                        </div>
                        <div class="col-md-6 px-0">
                            <div class="d-flex justify-content-end align-items-end">
                                <span class="text-pink mt-auto mb-0">*</span>
                            </div>
                            <input type="text" name="city" placeholder="Ville" class="icon-input">
                            <p class="error" id="error_city"></p>
                        </div>
                        <div class="col-md-6 px-0">
                            <div class="d-flex justify-content-end align-items-end">
                                <span class="text-pink mt-auto mb-0">*</span>
                            </div>
                            <input type="number" min="0" name="postalcode" placeholder="Code postal" class="icon-input">
                            <p class="error" id="error_postalcode"></p>
                        </div>
                    </div>
                    {{-- <div class="col-12 px-0">
                        <div class="d-flex justify-content-end align-items-end">
                            <span class="text-pink mt-auto mb-0">*</span>
                        </div>
                        <input type="text" name="location" id="location" placeholder="Lieu">
                    </div> --}}
                    <div class="row m-0 mb-4 justify-content-between">
                        <div class="col-md-6 px-0">
                            <div class="d-flex justify-content-end align-items-end">
                                <span class="text-pink mt-auto mb-0">*</span>
                            </div>
                            <input type="email" class="mt-0" placeholder="Mail" name="email" id="email">
                            <p class="error" id="error_email"></p>
                        </div>
                        <div class="col-md-6 pl-md-2 pl-0 pr-0">
                            <div class="d-flex justify-content-end align-items-end">
                                <span class="text-pink mt-auto mb-0">*</span>
                            </div>
                            <input type="number" min="0" class="mt-0" placeholder="Mobile" name="contact_no"
                                id="contact_no">
                            <p class="error" id="error_contact_no"></p>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-2">
                        <p class="fs-md">Fichiers</p>
                        <div class="d-flex justify-content-end align-items-end">
                            <span class="text-pink mt-auto mb-0">*</span>
                        </div>
                        <div class="col-12 p-0 postuler-col">
                            <div class="d-flex border-rounded border">
                                <input type="file" name="cv" placeholder="CV" style="border: none !important;">
                                <button type="button" class="parpal-btn">Parcourir</button>
                                <p class="error" id="error_cv"></p>
                            </div>
                            <div class="d-flex border-rounded border my-4">
                                <input type="file" name="cover_letter" placeholder="Lettre de motivation"
                                    style="border: none !important;">
                                <button type="button" class="parpal-btn">Parcourir</button>
                                <p class="error" id="error_cover_letter"></p>
                            </div>
                            <div class="d-flex border-rounded border">
                                <input type="file" name="other" placeholder="Autres" style="border: none !important;">
                                <button type="button" class="parpal-btn">Parcourir</button>
                                <p class="error" id="error_other"></p>
                            </div>
                        </div>
                    </div>
                    <div class="btnbox text-center mt-5 mb-3">
                        <button type="submit" class="btn-recrutement">Envoyer ma candidature</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
