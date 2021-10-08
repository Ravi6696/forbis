<div class="foorbis-boxshadow profil-entreprise-main foorbis-panel-one">
    <div class="">
        <input type="hidden" name="company_id" id="company_id"
        value="{{ $companyData->id ?? null }}">
        <div class="row">
            <div class="col-lg-7">
                <ul>
                    <li><a href="#mon-profile">Mon profil entreprise</a></li>
                    <li><a href="#a-propos">A propos</a></li>
                    <li><a href="#coordonnees">Coordonnées</a></li>
                    <li><a href="#horaire">Horaires</a></li>
                    <li><a href="#avis">Avis</a></li>
                    <li><a href="#announces">Annonces</a></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <ul class="d-flex">
                    <li class="foorbis-btn m-0 px-2 ml-auto btn-follow">
                        <img src="{{ asset('images/message.png') }}" width="17px" alt="">
                        <a class="text-white fs-2">Contacter l'entreprise</a>
                    </li>
                    <li class="foorbis-btn bg-yellow m-0 px-2 mx-2 btn-fav">
                        <img src="{{ asset('images/star-icon.png') }}" width="18px" alt="">
                        <a class="text-white">Contacter l'entreprise</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="">
        <div class=" company-details">
        <div class="pro-img-section" id="mon-profile">
            <div class="row m-0">
                <div class="col-12 p-0 main-img">
                    <img id="main-img" src="{{ $companyData->featured_image ?? asset('images/sqare-img.png') }}"
                        alt="your image">
                </div>
            </div>

            <div class="y-img-section m-0 w-full">
                <div class="row m-0 ysqare-img">
                    <div class="select-imges-box d-flex justify-content-center">
                        <div class="ysqare-img"><img
                                src="{{ $companyData->company_logo_path ?? asset('images/sqare-img.png') }}"
                                class="update-img"></div>
                    </div>
                    <div class="select-button-info">
                        <div class="iso-fector">
                            <div class="row m-0 mt-4 y-img-section">
                                <div class="col-md-5 p-0 mb-3">
                                    <h3 class="text-primary select-title-col">
                                        {{ $companyData->name ?? null }}
                                    </h3>
                                    <div class="d-flex">
                                        <img src="{{ asset('images/pink-menu.png') }}" width="23px" height="23px"
                                            alt="">
                                        <h4 class="text-pink ml-3 categorie-text-title">
                                            {{-- @isset($companyData->companyCategory)
                                                @foreach ($companyData->companyCategory as $item)
                                                    {{ $item->category->title ?? null }}
                                                @endforeach
                                            @endisset --}}
                                            @isset($companyData->category)
                                                    {{ $companyData->category->title ?? null }}{{$companyData->category->parent ? '-'. $companyData->category->parent->title : ''}}
                                            @endisset
                                        </h4>
                                    </div>
                                    <div class="d-flex">
                                        <img src="{{ asset('images/location (2).png') }}" width="20px" height="22px"
                                            alt="">
                                        <h5 class="text-primary ml-3">
                                            {{ $companyData->address->city ?? null }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-12 mb-3 p-0">
                                    <div class="d-flex justify-content-start justify-content-md-end responive-btn-flex">
                                        @if ($companyData && $companyData->is_collect)
                                            <a href="{{ $companyData->delivery_link ?? null }}"
                                                class="foorbis-btn-purpal-disabled p-2 px-3 mb-2 mr-2">LIVRAISON</a>
                                        @endif
                                        @if ($companyData && $companyData->is_delivery)
                                            <a href="{{ $companyData->collect_link ?? null }}"
                                                class="foorbis-btn-purpal p-2 px-3 mb-2">click and
                                                collect</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="all-text-pro">
        @if ($companyData->is_toggle_apropos)
            <div class="a-propos" id="a-propos">
                <!-- A prop start -->
                <div class="my-5">
                    <div class="row justify-content-between foorbis-dashbord-heading py-3">
                        <div class="heading">
                            <h2 class="foorbis-cheading foorbis-cheading text-pink">A propos</h2>
                        </div>
                    </div>
                    <div>
                        <p class="text-sub-title">{{ $companyData->about_us ?? '-' }}</p>
                    </div>
                </div>
            </div>
        @endif
        <!-- A prop end -->

        <!-- coordonnees Start  -->
        <div class="mb-5">
            <div class="row">
                @if ($companyData->is_toggle_coordonnees)
                    <div class="col-lg-4 col-md-5 mt-5" id="coordonnees">
                        <div>
                            <h2 class="foorbis-cheading text-pink border-bottom pb-3">Coordonnées</h2>
                        </div>
                        <div>
                            <div class="d-flex align-items-center my-3">
                                <img src="{{ asset('images/telephone.png') }}" width="14px" height="14px" alt="">
                                <p class="text-sub-title mb-0 ml-2">{{ $companyData->telephone ?? '-' }}</p>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('images/mobile.png') }}" width="11px" height="20px" alt="">
                                <p class="text-sub-title mb-0 ml-2">{{ $companyData->mobile_no ?? '-' }}</p>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('images/mail.png') }}" width="16px" height="11px" alt="">
                                <p class="text-sub-title mb-0 ml-2">{{ $companyData->email ?? '-' }}</p>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('images/home.png') }}" width="19px" height="19px" alt="">
                                <p class="text-sub-title mb-0 ml-2">{{ $companyData->full_address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($companyData->is_toggle_horaire)
                    <div class="col-lg-8 col-md-7 mt-5" id="horaire">
                        <div>
                            <h2 class="foorbis-cheading text-pink border-bottom pb-3">Horaire d'ouverture</h2>
                        </div>
                        <p class="text-sub-title">Horaire d'ouverture</p>
                        <div class="horaire-col-box">
                            <div class="horaire-col-row">
                                <div>
                                    <h6 class="pb-3 horaire-col-text">
                                        <p>Lundi:</p>
                                        <p>
                                            @isset($companyData)
                                                @foreach ($companyData->companyTime->where('day', 'monday') as $item)
                                                    {{-- @dump($item) --}}
                                                    <span class="text-pink">{{ $item->opening }} -
                                                        {{ $item->closing }}</span><br>
                                                @endforeach
                                            @endisset
                                        </p>
                                    </h6>
                                    <h6 class="pb-3 horaire-col-text">
                                        <p>Mardi:</p>
                                        <p>
                                            @isset($companyData)
                                                @foreach ($companyData->companyTime->where('day', 'tuesday') as $item)
                                                    {{-- @dump($item) --}}
                                                    <span class="text-pink">{{ $item->opening }} -
                                                        {{ $item->closing }}</span><br>
                                                @endforeach
                                            @endisset
                                        </p>
                                    </h6>
                                    <h6 class="pb-3 horaire-col-text">
                                        <p>Mercredi: </p>
                                        <p>
                                            @isset($companyData)
                                                @foreach ($companyData->companyTime->where('day', 'wednesday') as $item)
                                                    {{-- @dump($item) --}}
                                                    <span class="text-pink">{{ $item->opening }} -
                                                        {{ $item->closing }}</span><br>
                                                @endforeach
                                            @endisset
                                        </p>
                                    </h6>

                                </div>
                            </div>
                            <div class="horaire-col-row">
                                <div>
                                    <h6 class="pb-3 horaire-col-text">
                                        <p>Jeudi:</p>
                                        <p>
                                            @isset($companyData)
                                                @foreach ($companyData->companyTime->where('day', 'thursday') as $item)
                                                    {{-- @dump($item) --}}
                                                    <span class="text-pink">{{ $item->opening }} -
                                                        {{ $item->closing }}</span><br>
                                                @endforeach
                                            @endisset
                                        </p>
                                    </h6>
                                    <h6 class="pb-3 horaire-col-text">
                                        <p>Vendredi : </p>
                                        <p>
                                            @isset($companyData)
                                                @foreach ($companyData->companyTime->where('day', 'friday') as $item)
                                                    {{-- @dump($item) --}}
                                                    <span class="text-pink">{{ $item->opening }} -
                                                        {{ $item->closing }}</span><br>
                                                @endforeach
                                            @endisset
                                        </p>
                                    </h6>
                                    <h6 class="pb-3 horaire-col-text">
                                        <p>Samedi : </p>
                                        <p>
                                            @isset($companyData)
                                                @foreach ($companyData->companyTime->where('day', 'saturday') as $item)
                                                    {{-- @dump($item) --}}
                                                    <span class="text-pink">{{ $item->opening }} -
                                                        {{ $item->closing }}</span><br>
                                                @endforeach
                                            @endisset
                                        </p>
                                    </h6>

                                </div>
                            </div>
                            <div class="horaire-col-row">
                                <div class="d-flex">
                                    <div>
                                        <h6 class="pb-3 horaire-col-text">
                                            <p>Dimanche:</p>
                                            <p>
                                                @isset($companyData)
                                                    @foreach ($companyData->companyTime->where('day', 'sunday') as $item)
                                                        {{-- @dump($item) --}}
                                                        <span class="text-pink">{{ $item->opening }} -
                                                            {{ $item->closing }}</span><br>
                                                    @endforeach
                                                @endisset
                                            </p>
                                        </h6>
                                    </div>
                                    <!-- <div class="ml-2">
                                    <p class="text-pink">9h00 - 12h00 <br> 14h00 - 18h00</p>
                                </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>

        <!-- coordonnees end  -->

        <!-- agenda start -->
        @if ($companyData->is_toggle_avis)
            <div class="agenda-margin" id="avis">
                <div class="col-12 p-0">
                    <div class="border-bottom foorbis-heading-padding">
                        <h2 class="foorbis-cheading text-pink">Agenda</h2>
                    </div>
                    <div class="agenda-btn-margin d-flex justify-content-center">
                        <a class="parpal-btn-lg px-4 py-2" href="#">Aller sur l'agenda de réservation</a>
                    </div>
                </div>

            </div>
        @endif
        <!-- agenda end -->

        <div class="commentaires-mt">
            <div class="row foorbis-dashbord-heading">
                <div class="heading col-12 p-0 d-flex justify-content-between pb-3 re-block">
                    <h2 class="foorbis-cheading text-pink font-weight-bold">Commentaires</h2>
                    <div>
                        <div class="foorbis-penal-left w-100 p-0">
                            <div class="foorbis-switch dashbord-switch-col mt-0">
                                <div class="dashbord-right-swichbutton">
                                    <div class="btnbox-sm">
                                        <div id="announces" onclick="$('#commentDiv').hide()"
                                            class="btn notactive announces">
                                            Cacher
                                        </div>
                                        <div id="mes" onclick="$('#commentDiv').show()" class="btn active mes">
                                            Afficher
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="commentDiv">
                <div class="row line-mt">
                    <div class="col-12">
                        <h4>{{ $companyData ? $companyData->companyComments->count() : 0 }} commentaires</h4>
                    </div>
                </div>
                <div class="comment-box-scroll scrollbar">
                    <div class="mr-5">
                        @isset($companyData->companyComments)
                            @foreach ($companyData->companyComments as $item)
                                {{-- @dump($item->childComment) --}}
                                @if ($item->is_respond == 0)
                                    <div class="singal-comment mt-5 mb-4">
                                        <div class="row">
                                            <div class="profile-comment">
                                                <img
                                                    src="{{ $item->user->profile_path ?? 'images/comment-img-one.png' }}">
                                            </div>
                                            <div class="col-xl-8 col-lg-12 col-md-12 col-12">
                                                <div class="text-comment">
                                                    <p>
                                                        <span>{{ $item->user->full_name ?? null }}</span>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->diffForhumans() }}
                                                    </p>
                                                    <p>{{ $item->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <h2 class="border-bottom pb-3">Votre reponse</h2>
            <div class="row mt-4">
                <div class="col-md-1">
                    <div class="profile-votre my-md-0 my-3 d-flex justify-content-md-end">
                        <img src="{{ asset('images/comment-img-one.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-11">
                    <div>
                        <textarea class="rounded w-100" name="" id="" cols="100" rows="8"></textarea>
                    </div>
                    <button class="pink-btn-md p-0 mt-4 border-0">Poser votre reponse</button>
                </div>
            </div>
        </div>
        {{-- </div> --}}
        <div class="dashbord-pro-card" id="annonces">
            <div class="foorbis-announces">
                <label>
                    Mes annonces
                </label>
                <br>
                <hr>
                <div id="announce_div">
                    @if ($companyData)
                        <x-pro-user.announce-list is_create="$is_create"
                            :companyAdvertisement="$companyData->companyAdvertisement" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-fav', function(e) {
                e.preventDefault();
                var id = $('#company_id').val();
                $.ajax({
                    url: "{{ route('add-cmp-favourite') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        toastr.success(response.message);
                    },
                })
            });
            $(document).on('click', '.btn-follow', function(e) {
                e.preventDefault();
                var id = $('#company_id').val();
                $.ajax({
                    url: "{{ route('add-cmp-follow') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        toastr.success(response.message);
                    },
                })
            });
        });
    </script>
@endpush
</div>
