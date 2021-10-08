<div class="foorbis-boxshadow ">
    <div class="profil-entreprise-main foorbis-panel-one">
        <div class="row my-1 dashboard-list mx-0">
            <div class="col-md-10 col-12 responive-dashboard-list p-0">
                <ul>
                    <li><a href="#mon-profile">Mon profil entreprise</a></li>
                    <li><a href="#a-propos">A propos</a></li>
                    <li><a href="#coordonnees">Coordonnées</a></li>
                    <li><a href="#horaire">Horaires</a></li>
                    <li><a href="#avis">Avis</a></li>
                    <li><a href="#annonces">Annonces</a></li>
                    <li><a href="#statistiques">Statistiques</a></li>
                    <li><a href="javascript:;" class="parametres-menu">Paramêtres</a></li>
                </ul>
            </div>
            <div class="col-md-2 d-flex justify-content-end align-items-center aide-btn-px p-0">
                <i class="fa fa-star text-warning"></i>
                <p class="d-inline text-warning mb-0 mx-1">
                    {{ $companyData ? $companyData->followers()->count() : null }} follow
                </p>
            </div>
        </div>
    </div>
    <div class="view_dashboard">
        <div class="profil-entreprise-main foorbis-panel-one">
            <div class="company-details"></div>
            <div class="all-text-pro">
                <!-- A prop start -->
                <div class="a-prop" id="a-propos">
                    <div class="row justify-content-between foorbis-dashbord-heading py-3 mx-0">
                        <div class="heading">
                            <h2 class="foorbis-cheading mb-0">A propos</h2>
                        </div>
                        <div class="a-propos-content">
                            <div class=" foorbis-penal-left w-100 p-0">
                                <div class="foorbis-switch dashbord-switch-col mt-0">
                                    <div class="dashbord-right-swichbutton">
                                        <div class="btnbox-sm">
                                            <div id="announces"
                                                class="btn d-flex align-items-center justify-content-center hideSideToggel {{ !$companyData->is_toggle_apropos ? 'active' : 'notactive' }}"
                                                data-toggle="is_toggle_apropos" data-action="false">
                                                Cacher
                                            </div>
                                            <div id="mes"
                                                class="btn d-flex align-items-center justify-content-center hideSideToggel {{ $companyData->is_toggle_apropos ? 'active' : 'notactive' }}"
                                                data-toggle="is_toggle_apropos" data-action="true">
                                                Afficher
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="apropos is_toggle_apropos {{ $companyData->is_toggle_apropos ? '' : 'd-none' }}">
                        <div class="input-type mt-4">
                            <textarea rows="8" cols="50" id="about_us"
                                placeholder="Déscription de votre entreprise">{{ $companyData->about_us ?? null }}</textarea>
                            <p class="error" id="error_about_us"></p>

                        </div>
                        <div class="sub-btn">
                            <button class="parpal-btn-lg ml-auto" id="saveAboutUs">Sauvegarder</button>
                        </div>
                    </div>
                </div>
                <!-- A prop end -->
                <!-- coordonnees Start  -->
                <div class="coordonnees" id="coordonnees">
                    <div class="row m-0 d-flex justify-content-between border-foorbis foorbis-heading-padding">
                        <div class="heading">
                            <h2 class="foorbis-cheading mb-0">Coordonnées</h2>
                        </div>
                        <div class="coordon">
                            <div class=" foorbis-penal-left w-100 p-0 d-flex justify-content-end">
                                <div class="foorbis-switch dashbord-switch-col mt-0">
                                    <div class="dashbord-right-swichbutton">
                                        <div class="btnbox-pink-sm">
                                            <div id="switchButton1"
                                                class="btn hideSideToggel {{ !$companyData->is_toggle_coordonnees ? 'active' : 'notactive' }}"
                                                data-toggle="is_toggle_coordonnees" data-action="false">
                                                Cacher
                                            </div>
                                            <div id="switchButton2"
                                                class="btn hideSideToggel {{ $companyData->is_toggle_coordonnees ? 'active' : 'notactive' }}"
                                                data-toggle="is_toggle_coordonnees" data-action="true">
                                                Afficher
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="is_toggle_coordonnees {{ $companyData->is_toggle_coordonnees ? '' : 'd-none' }}">
                        <form enctype="multipart/form-data" id="frmContactDetails" method="post">
                            <div class="row line-mt">
                                <div class="tele-input col-xl-3">
                                    <input type="number" placeholder="Téléphone" min="0" name="telephone" id="telephone"
                                        value="{{ $companyData->telephone ?? null }}">
                                    <p class="error" id="error_telephone"></p>
                                </div>
                                <div class="tele-input col-xl-3">
                                    <input type="number" min="0" name="mobile_no" id="mobile_no" placeholder="Mobile"
                                        value="{{ $companyData->mobile_no ?? null }}">
                                    <p class="error" id="error_mobile_no"></p>
                                </div>
                                <div class="mail-input col-xl-6">
                                    <input type="email" name="email" id="email" placeholder="Mail"
                                        value="{{ $companyData->email ?? null }}">
                                    <p class="error" id="error_email"></p>
                                </div>
                            </div>
                            <div class="row line-mt">
                                {{-- <div class="adresse-input  col-xl-7">
                                    <input type="hidden" name="address_id" id="address_id"
                                        value="{{ $companyData->address->id ?? null }}">
                                    <input type="text" placeholder="Adresse" name="address" id="address"
                                        value="{{ $companyData->address->address_line_1 ?? null }} {{ $companyData->address->address_line_2 ?? null }}">
                                    <p class="error" id="error_address"></p>

                                </div> --}}
                                <x-google-auto-complete-address :companyData="$companyData"/>
                                <div class="ville-input col-xl-3">
                                    <input type="text" name="city" id="city" placeholder="Ville"
                                        value="{{ $companyData->address->city ?? null }}">
                                    <p class="error" id="error_city"></p>

                                </div>
                                <div class="code-postel-input col-xl-2">
                                    <input type="number" name="postal_code" id="postal_code" placeholder="Code postal"
                                        value="{{ $companyData->address->postalcode ?? null }}">
                                    <p class="error" id="error_postal_code"></p>
                                </div>
                            </div>
                            <div class="sub-btn">
                                <button type="submit" class="parpal-btn-lg ml-auto">Sauvegarder</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- coordonnees end  -->
                <!-- Horaire Start  -->
                <div class="Horaire" id="horaire">
                    <div class="row m-0 d-flex justify-content-between border-foorbis foorbis-heading-padding">
                        <div class="heading">
                            <h2 class="foorbis-cheading mb-0">Horaire d'ouverture</h2>
                        </div>
                        <div class="horaire-content">
                            <div class=" foorbis-penal-left w-100 p-0">
                                <div class="foorbis-switch dashbord-switch-col mt-0">
                                    <div class="dashbord-right-swichbutton">
                                        <div class="btnbox-sm">
                                            <div id="HoraireButton1"
                                                class="btn d-flex align-items-center justify-content-center hideSideToggel {{ !$companyData->is_toggle_horaire ? 'active' : 'notactive' }}"
                                                data-toggle="is_toggle_horaire" data-action="false">
                                                Cacher
                                            </div>
                                            <div id="HoraireButton2"
                                                class="btn d-flex align-items-center justify-content-center hideSideToggel {{ $companyData->is_toggle_horaire ? 'active' : 'notactive' }}"
                                                data-toggle="is_toggle_horaire" data-action="true">
                                                Afficher
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="is_toggle_horaire {{ $companyData->is_toggle_horaire ? '' : 'd-none' }}">
                        <div class="row line-mt">
                            <div class="col-12">
                                <p class="sub-text">Horaire d'ouverture</p>
                            </div>
                        </div>
                        <form id="frmaddCompanyTime" method="post">
                            @csrf
                            <div class="row">
                                @foreach ($companyData->time as $key => $item)
                                    <div class="col-xl-4 col-lg- 6 col-md-6 {{ $key }}dayDiv">
                                        <input type="hidden" name="{{ $key }}count"
                                            id="{{ $key }}count" value="{{ count($item) }}">
                                        @if (count($item))
                                            @foreach ($item as $i => $value)
                                                <div class="horaire-cold plusDiv">
                                                    <div class="col-3">
                                                        <p class="m-0 col-title fs-md">{{ $i == 0 ? $key : '' }}</p>
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="input-horaire-col">
                                                            <input class="horaire-input mr-3" type="time"
                                                                name="start_time[{{ $key }}][{{ $value->id }}]"
                                                                placeholder="Ouverture"
                                                                value="{{ $value->opening }}">
                                                            <input class="horaire-input mr-2" type="time"
                                                                name="end_time[{{ $key }}][{{ $value->id }}]"
                                                                placeholder="Fermeture"
                                                                value="{{ $value->closing }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        @if ($i == 0)
                                                            <div class="plus-box" data-day="{{ $key }}">
                                                                <img src="{{ asset('images/plus.png') }}">
                                                            </div>
                                                        @else
                                                            <div class="close-box" data-day="{{ $key }}">
                                                                <img src="{{ asset('images/close.png') }}">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="horaire-cold plusDiv">
                                                <div class="col-3">
                                                    <p class="m-0 col-title fs-md">{{ $key }}</p>
                                                </div>
                                                <div class="col-7">
                                                    <div class="input-horaire-col">
                                                        <input class="horaire-input mr-3" type="time"
                                                            name="start_time[{{ $key }}][]"
                                                            placeholder="Ouverture" value="">
                                                        <input class="horaire-input mr-2" type="time"
                                                            name="end_time[{{ $key }}][]"
                                                            placeholder="Fermeture" value="">
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="plus-box" data-day="{{ $key }}">
                                                        <img src="{{ asset('images/plus.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-2 w-100 agenda-margin">
                                <button class="parpal-btn-lg ml-auto" type="submit">Sauvegarder</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Horaire end  -->
                <div id="avis">
                    <!-- Agenda Start  -->
                    <div class="agenda">
                        <div class="row justify-content-between border-foorbis foorbis-heading-padding mx-0">
                            <div class="heading py-0" style="display: block;">
                                <h2 class="foorbis-cheading mb-0">Agenda réservatio</h2>
                            </div>
                            <div class="py-0 mb-0">
                                <div class="foorbis-penal-left w-100 p-0 d-flex justify-content-end">
                                    <div class="foorbis-switch dashbord-switch-col mt-0">
                                        <div class="dashbord-right-swichbutton">
                                            <div class="btnbox-sm">
                                                <div id="AgendaButton1"
                                                    class="btn d-flex align-items-center justify-content-center hideSideToggel {{ !$companyData->is_toggle_avis ? 'active' : 'notactive' }}"
                                                    data-toggle="is_toggle_avis" data-action="false">
                                                    Cacher
                                                </div>
                                                <div id="AgendaButton2"
                                                    class="btn d-flex align-items-center justify-content-center hideSideToggel {{ $companyData->is_toggle_avis ? 'active' : 'notactive' }}"
                                                    data-toggle="is_toggle_avis" data-action="true">
                                                    Afficher
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="search row line-mt is_toggle_avis {{ $companyData->is_toggle_avis ? '' : 'd-none' }}"
                            style="align-items: baseline;">
                            <div class="agenda-input px-3">
                                <input type="text" name="reservation_link" id="reservation_link"
                                    placeholder="Lien vers mon agenda"
                                    value="{{ $companyData->reservation_link ?? null }}">
                                <p class="error" id="error_reservation_link"></p>
                            </div>
                            <div class="d-flex align-items-center ml-4">
                                <button class="parpal-btn" id="saveReserveLink">Sauvegarder</button>
                            </div>
                        </div>
                    </div>
                    <!-- Agenda End  -->

                    <!-- Commentaires Start  -->
                    <div class="commentaires">
                        <div class="row foorbis-dashbord-heading">
                            <div class="heading col-6">
                                <h2 class="foorbis-cheading">Commentaires</h2>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>

                        <div class="row line-mt">
                            <div class="col-12">
                                <p class="sub-text">
                                    {{ isset($companyData->companyComments) ? count($companyData->companyComments) : 0 }}
                                    commentaires
                                </p>
                            </div>
                        </div>
                        <div class="comment-box-fix">
                            @isset($companyData->companyComments)
                                @foreach ($companyData->companyComments as $item)
                                    {{-- @dump($item->childComment) --}}
                                    @if ($item->is_respond == 0)
                                        <div class="comment-box">
                                            <div class="singal-comment">
                                                <div class="row">
                                                    <div class="profile-comment">
                                                        <img
                                                            src="{{ $item->user->profile_path ?? 'images/comment-img-one.png' }}">
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="text-comment">
                                                            <p>
                                                                <span>{{ $item->user->full_name ?? null }}</span>
                                                                {{ \Carbon\Carbon::parse($item->created_at)->diffForhumans() }}
                                                            </p>
                                                            <p>{{ $item->comment }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="comment-line">
                                                <div class="row response">
                                                    <div class="col-1"></div>
                                                    <div class="col-9 response">
                                                        <input type="text" id="respond_message{{ $item->id }}"
                                                            name="respond_message" placeholder="Répondre">
                                                    </div>
                                                    <div class="col-2 ">
                                                        <div class="response-pink-btn btn-respond"
                                                            data-id="{{ $item->id }}">
                                                            <a>Répondre</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach ($item->childComment as $comment)
                                                    <div class="comment-box">
                                                        <div class="singal-comment">
                                                            <div class="row">
                                                                <div class="profile-comment">
                                                                    <img
                                                                        src="{{ $item->user->profile_path ?? 'images/comment-img-one.png' }}">
                                                                </div>
                                                                <div class="col-8">
                                                                    <div class="text-comment">
                                                                        <p>
                                                                            <span>{{ $comment->user->full_name ?? null }}</span>
                                                                            {{ \Carbon\Carbon::parse($comment->created_at)->diffForhumans() }}
                                                                        </p>
                                                                        <p>{{ $comment->comment }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="comment-line">
                                                            <div class="row response">
                                                                <div class="col-1"></div>
                                                                <div class="col-9 response">
                                                                    <input type="text"
                                                                        id="respond_message{{ $comment->id }}"
                                                                        name="respond_message" placeholder="Répondre">
                                                                </div>
                                                                <div class="col-2 ">
                                                                    <div class="response-pink-btn btn-respond"
                                                                        data-id="{{ $comment->id }}">
                                                                        <a>Répondre</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endisset
                        </div>
                    </div>
                    <!-- Commentaires Start  -->
                </div>
                <div class="dashbord-pro-card" id="annonces">
                    <div class="foorbis-announces">
                        <label>
                            Mes annonces
                        </label>
                        <br>
                        <hr>
                        <div id="announce_div">
                            @isset($companyData->companyAdvertisement)
                                <x-pro-user.announce-list :companyAdvertisement="$companyData->companyAdvertisement" />
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="statistiques-sec" id="statistiques">
                    <div class="foorbis-announces">
                        <label>
                            Statistiques
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
