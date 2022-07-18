@extends('admin_layouts.main')
@push('styles')
    <style>
        .btn-submit {
            text-align: right;
            margin-top: 30px;
        }

    </style>
@endpush
@section('content')
    <input type="hidden" name="company_id" id="company_id" value="{{ $companyData->id }}">
    <!--  Dashbord-start  -->
    <div class="foorbis-penal scrollbar">
        <div class="foorbis-penal-all scrollbar">
            <div class="top-bar row">
                <p class="dashbord-name col-6">mon DASHBOARD</p>
                <div class="toggle-btns col-6">
                    <a class="pink-btn" href="#"><img src="{{ asset('images/aide.png') }}">Aide</a>
                </div>
            </div>
            <div class="foorbis-boxshadow profil-entreprise-main foorbis-panel-one">
                <ul>
                    <li><a href="#">Mon profil entreprise</a></li>
                    <li><a href="#">A propos</a></li>
                    <li><a href="#">Coordonnées</a></li>
                    <li><a href="#">Horaires</a></li>
                    <li><a href="#">Avis</a></li>
                    <li><a href="#">Annonces</a></li>
                    <li><a href="#">Statistiques</a></li>
                    <li><a href="#">Paramêtres</a></li>
                </ul>
                <form enctype="multipart/form-data" id="frmAddProfile" method="post">
                    <div class="pro-img-section row">
                        @csrf
                        <div class="pink-imginput-btn">
                            <p><img src="{{ asset('images/img-icon.png') }}"><a href="#">Nouvelles images</a></p>
                        </div>
                        <input id="btn-input" type="file" name="company_images[]" onchange="readURL(this);" multiple>
                        <div class="col-10 main-img">
                            <img id="main-img" src="{{ asset('images/coffee-shop.png') }}" alt="your image">
                        </div>
                        <div class="thumbes scrollbar">
                            @foreach ($companyData->images_path as $item)
                                <div class="thumb-img"><img src="{{ asset($item) }}" height="100" width="100"></div>
                            @endforeach
                        </div>

                        <div class="y-img-section">
                            <div class="img-inoneline">
                                <div class="ysqare-img"><img src="{{ asset('images/sqare-img.png') }}"></div>
                                <input id="pink-imginput-btn" type="file" name="company_logo" onchange="readURL(this);"
                                    multiple>
                                <div class="iso-fector">
                                    <input type="text" name="company_name" value="{{ $companyData->name }}"
                                        placeholder="Nom entreprise">
                                    <label class="error error-company_name"></label>
                                    <select name="category" id="cars">
                                        <option value="">Genus Selectos</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $companyData->category_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label class="error error-category"></label>
                                    <br>
                                    <div class="input">
                                        <label class="container-checkbox">Click and collect
                                            <input type="checkbox" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <input class="second" type="text"
                                            value="{{ $companyData->collect_link }}" name="collect_link"
                                            placeholder="Lien click and collect">
                                    </div>
                                    <div class="input">
                                        <label class="container-checkbox">Livraison
                                            <input type="checkbox" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <input class="second" type="text"
                                            value="{{ $companyData->delivery_link }}" name="delivery_link"
                                            placeholder="Lien livraison">
                                    </div>
                                    <div class="sub-btn">
                                        <button class="parpal-btn" type="submit">Sauvegarder</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="all-text-pro">
                    <!-- A prop start -->
                    <div class="a-prop">
                        <div class="row foorbis-dashbord-heading">
                            <div class="heading col-6">
                                <h2 class="foorbis-cheading">A propos</h2>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        <div class="input-type">
                            <textarea rows="8" cols="50" id="about_us"
                                placeholder="Déscription de votre entreprise">{{ $companyData->about_us }}</textarea>
                        </div>
                        <div class="sub-btn">
                            <button class="parpal-btn" id="saveAboutUs">Sauvegarder</button>
                        </div>
                    </div>
                    <!-- A prop end -->

                    <!-- coordonnees Start  -->
                    <div class="coordonnees">
                        <div class="row foorbis-dashbord-heading">
                            <div class="heading col-6">
                                <h2 class="foorbis-cheading">Coordonnées</h2>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        <form enctype="multipart/form-data" id="frmContactDetails" method="post">
                            <div class="row line-mt">
                                <div class="col-3">
                                    <div class="input-type">
                                        <input class="regular-input" type="number" min="0" name="telephone" id="telephone"
                                            placeholder="Téléphone" value="{{ $companyData->telephone }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-type">
                                        <input class="regular-input" type="number" min="0" name="mobile_no" id="mobile_no"
                                            placeholder="Mobile" value="{{ $companyData->mobile_no }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-type">
                                        <input class="regular-input" type="email" name="email" id="email"
                                            placeholder="Mail" value="{{ $companyData->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row line-mt">
                                <div class="col-6">
                                    <div class="input-type">
                                        <textarea name="address" id="address" cols="30" rows="10" class="regular-input"
                                            placeholder="Adresse"> {{ $companyData->address }}</textarea>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-type">
                                        <input class="regular-input" type="text" name="city" id="city" placeholder="Ville"
                                            value="{{ $companyData->city }}">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-type">
                                        <input class="regular-input" type="number" name="postal_code" id="postal_code"
                                            placeholder="Code postal" value="{{ $companyData->postal_code }}">
                                    </div>
                                </div>
                            </div>

                            <div class="sub-btn">
                                <button type="submit" class="parpal-btn">Sauvegarder</button>
                            </div>
                        </form>
                    </div>
                    <!-- coordonnees end  -->

                    <!-- Horaire Start  -->
                    <div class="Horaire">
                        <div class="row foorbis-dashbord-heading">
                            <div class="heading col-6">
                                <h2 class="foorbis-cheading">Horaire d'ouverture</h2>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>

                        <div class="row line-mt">
                            <div class="col-12">
                                <p class="sub-text">Horaire d'ouverture</p>
                            </div>
                        </div>
                        <form id="frmaddCompanyTime" method="post">
                            @csrf
                            <div class="box-part-1 col-12 row">
                                <div class="col-4">
                                    <div class="sub-ho-box row">
                                        <div class="mondayDiv row">
                                            @if (sizeof($objCompanyTime['monday']))
                                                @foreach ($objCompanyTime['monday'] as $item)
                                                    <div class="row col-12">
                                                        <div class="col-2">
                                                            <p class="hora-text">Lundi</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="mon_start_time[{{ $item->id }}]"
                                                                    placeholder="Ouverture" value="{{ $item->opening }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="mon_end_time[{{ $item->id }}]"
                                                                    placeholder="Fermeture" value="{{ $item->closing }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="plus-box" data-day="mon">
                                                                <img src="images/plus.png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row col-12">
                                                    <div class="col-2">
                                                        <p class="hora-text">Lundi</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="mon_start_time[]" placeholder="Ouverture">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text" name="mon_end_time[]"
                                                                placeholder="Fermeture">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="plus-box" data-day="mon">
                                                            <img src="images/plus.png">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="sub-ho-box row">
                                        <div class="tuesdayDiv row">
                                            @if (sizeof($objCompanyTime['tuesday']))
                                                @foreach ($objCompanyTime['tuesday'] as $item)
                                                    <div class="row col-12">
                                                        <div class="col-2">
                                                            <p class="hora-text">Mardi</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="tues_start_time[{{ $item->id }}]"
                                                                    placeholder="Ouverture" value="{{ $item->opening }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="tues_end_time[{{ $item->id }}]"
                                                                    placeholder="Fermeture" value="{{ $item->closing }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="plus-box" data-day="tues">
                                                                <img src="images/plus.png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row col-12">
                                                    <div class="col-2">
                                                        <p class="hora-text">Mardi</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="tues_start_time[]" placeholder="Ouverture">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="tues_end_time[]" placeholder="Fermeture">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="plus-box" data-day="tues">
                                                            <img src="images/plus.png">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="sub-ho-box row">
                                        <div class="wednesdayDiv row">
                                            @if (sizeof($objCompanyTime['wednesday']))
                                                @foreach ($objCompanyTime['wednesday'] as $item)
                                                    <div class="row col-12">
                                                        <div class="col-2">
                                                            <p class="hora-text">Mercredi</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="wednes_start_time[{{ $item->id }}]"
                                                                    placeholder="Ouverture">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="wednes_end_time[{{ $item->id }}]"
                                                                    placeholder="Fermeture">
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="plus-box" data-day="wednes">
                                                                <img src="images/plus.png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row col-12">
                                                    <div class="col-2">
                                                        <p class="hora-text">Mercredi</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="wednes_start_time[]" value="{{ $item->opening }}"
                                                                placeholder="Ouverture">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="wednes_end_time[]" value="{{ $item->closing }}"
                                                                placeholder="Fermeture">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="plus-box" data-day="wednes">
                                                            <img src="images/plus.png">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="sub-ho-box row">
                                        <div class="thursdayDiv row">
                                            @if (sizeof($objCompanyTime['thursday']))
                                                @foreach ($objCompanyTime['thursday'] as $item)
                                                    <div class="row col-12">
                                                        <div class="col-2">
                                                            <p class="hora-text">Jeudi</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="thurs_start_time[{{ $item->id }}]"
                                                                    placeholder="Ouverture">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="thurs_end_time[{{ $item->id }}]"
                                                                    placeholder="Fermeture">
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="plus-box" data-day="thurs">
                                                                <img src="images/plus.png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row col-12">
                                                    <div class="col-2">
                                                        <p class="hora-text">Jeudi</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="thurs_start_time[{{ $item->id }}]"
                                                                placeholder="Ouverture">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="thurs_end_time[{{ $item->id }}]"
                                                                placeholder="Fermeture">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="plus-box" data-day="thurs">
                                                            <img src="images/plus.png">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="sub-ho-box row">
                                        <div class="fridayDiv row">
                                            @if (sizeof($objCompanyTime['friday']))
                                                @foreach ($objCompanyTime['friday'] as $item)
                                                    <div class="row col-12">
                                                        <div class="col-2">
                                                            <p class="hora-text">Vendredi</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="fri_start_time[{{ $item->id }}]"
                                                                    value="{{ $item->opening }}" placeholder="Ouverture">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="fri_end_time[{{ $item->id }}]"
                                                                    value="{{ $item->closing }}" placeholder="Fermeture">
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="plus-box" data-day="fri">
                                                                <img src="images/plus.png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row col-12">
                                                    <div class="col-2">
                                                        <p class="hora-text">Vendredi</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="fri_start_time[]" placeholder="Ouverture">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text" name="fri_end_time[]"
                                                                placeholder="Fermeture">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="plus-box" data-day="fri">
                                                            <img src="images/plus.png">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="sub-ho-box row">
                                        <div class="saturdayDiv row">
                                            @if (sizeof($objCompanyTime['saturday']))
                                                @foreach ($objCompanyTime['saturday'] as $item)
                                                    <div class="row col-12">
                                                        <div class="col-2">
                                                            <p class="hora-text">Samedi</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="satur_start_time[{{ $item->id }}]"
                                                                    value="{{ $item->opening }}" placeholder="Ouverture">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="satur_end_time[{{ $item->id }}]"
                                                                    value="{{ $item->closing }}" placeholder="Fermeture">
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="plus-box" data-day="satur">
                                                                <img src="images/plus.png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row col-12">
                                                    <div class="col-2">
                                                        <p class="hora-text">Samedi</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="satur_start_time[]" placeholder="Ouverture">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="satur_end_time[]" placeholder="Fermeture">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="plus-box" data-day="satur">
                                                            <img src="images/plus.png">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="sub-ho-box row">
                                        <div class="sundayDiv row">
                                            @if (sizeof($objCompanyTime['sunday']))
                                                @foreach ($objCompanyTime['sunday'] as $key => $item)
                                                    <div class="row col-12">
                                                        <div class="col-2">
                                                            <p class="hora-text">Dimanche</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="sun_start_time[{{ $item->id }}]"
                                                                    value="{{ $item->opening }}" placeholder="Ouverture">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-type box-hora seprete">
                                                                <input class="regular-input" type="text"
                                                                    name="sun_end_time[{{ $item->id }}]"
                                                                    value="{{ $item->opening }}" placeholder="Fermeture">
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="plus-box" data-day="sun">
                                                                <img src="images/plus.png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row col-12">
                                                    <div class="col-2">
                                                        <p class="hora-text">Dimanche</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text"
                                                                name="sun_start_time[]" placeholder="Ouverture">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-type box-hora seprete">
                                                            <input class="regular-input" type="text" name="sun_end_time[]"
                                                                placeholder="Fermeture">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="plus-box" data-day="sun">
                                                            <img src="images/plus.png">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-submit">
                                <button class="parpal-btn" type="submit">Sauvegarder</button>
                            </div>
                        </form>
                    </div>
                    <!-- Horaire end  -->

                    <div class="agenda">
                        <div class="row foorbis-dashbord-heading">
                            <div class="heading col-6">
                                <h2 class="foorbis-cheading">Agenda réservation</h2>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        <div class="search row line-mt">
                            <div class=" col-4">
                                <div class="input-type">
                                    <input class="regular-input" type="text" name="reservation_link" id="reservation_link"
                                        placeholder="Lien vers mon agenda">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="sub-btn">
                                    <button class="parpal-btn" id="saveReserveLink" type="submit">Sauvegarder</button>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                <p class="sub-text">10 commentaires</p>
                            </div>
                        </div>
                        <div class="comment-box-fix">
                            <div class="comment-box">
                                <div class="singal-comment">
                                    <div class="row">
                                        <div class="profile-comment">
                                            <img src="images/comment-img-one.png">
                                        </div>
                                        <div class="col-8">
                                            <div class="text-comment">
                                                <p><span>Nom Prénom</span> depuis 2 jours</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus
                                                    libero ut lectus porta gravida. Nunc sit amet tellus imperdiet,
                                                    dapibus
                                                    nunc eu, vestibulum quam. Aliquam et tincidunt sem. Duis molestie
                                                    congue
                                                    ante sed porta. Fusce mauris felis, malesuada ut sagittis ut,
                                                    vulputate
                                                    sed metus. Phasellus sem magna, tristique ut leo at, dapibus rhoncus
                                                    arcu. Fusce ultricies varius congue. Aliquam quis varius mauris.
                                                    Suspendisse id placerat justo, commodo pellentesque massa.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="comment-line">
                                    <div class="row response">
                                        <div class="col-1"></div>
                                        <div class="col-9 response">
                                            <input type="text" name="" placeholder="Répondre">
                                        </div>
                                        <div class="col-2 ">
                                            <div class="response-pink-btn"><a href="#">Répondre</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="comment-box">
                                <div class="singal-comment comment-new">
                                    <div class="row">
                                        <div class="profile-comment">
                                            <img src="images/y-profile.png">
                                        </div>
                                        <div class="col-8">
                                            <div class="text-comment">
                                                <p><span>Nom Prénom</span> depuis 2 jours</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus
                                                    libero ut lectus porta gravida. Nunc sit amet tellus imperdiet,
                                                    dapibus
                                                    nunc eu, vestibulum quam. Aliquam et tincidunt sem. Duis molestie
                                                    congue
                                                    ante sed porta. Fusce mauris felis, malesuada ut sagittis ut,
                                                    vulputate
                                                    sed metus. Phasellus sem magna, tristique ut leo at, dapibus rhoncus
                                                    arcu. Fusce ultricies varius congue. Aliquam quis varius mauris.
                                                    Suspendisse id placerat justo, commodo pellentesque massa.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="comment-line">

                                    <div class="row">
                                        <div class="profile-comment">
                                            <img src="images/y-comment.png">
                                        </div>
                                        <div class="col-8">
                                            <div class="text-comment">
                                                <p><span>Nom Prénom</span> depuis 2 jours</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus
                                                    libero ut lectus porta gravida. Nunc sit amet tellus imperdiet,
                                                    dapibus
                                                    nunc eu, vestibulum quam. Aliquam et tincidunt sem. Duis molestie
                                                    congue
                                                    ante sed porta. Fusce mauris felis, malesuada ut sagittis ut,
                                                    vulputate
                                                    sed metus. Phasellus sem magna, tristique ut leo at, dapibus rhoncus
                                                    arcu. Fusce ultricies varius congue. Aliquam quis varius mauris.
                                                    Suspendisse id placerat justo, commodo pellentesque massa.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="comment-line">

                                    <div class="row response">
                                        <div class="col-1"></div>
                                        <div class="col-9 response">
                                            <input type="text" name="" placeholder="Répondre">
                                        </div>
                                        <div class="col-2 ">
                                            <div class="response-pink-btn"><a href="#">Répondre</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashbord-pro-card">
                <div class="foorbis-announces">
                    <label>
                        Mes annonces
                    </label>
                    <br>
                    <hr>

                    <div class="cards scrollbar">
                        <div class="card">
                            <div class="upr">
                                <img src="images/card1.png" alt="">
                            </div>
                            <div class="lower">
                                <h4>
                                    Nom de l'annonce
                                </h4>
                                <h5>
                                    Catégorie annonce
                                </h5>
                                <h6>
                                    date
                                </h6>
                            </div>
                        </div>

                        <div class="card">
                            <div class="upr">
                                <img src="images/card2.png" alt="">
                            </div>
                            <div class="lower">
                                <h4>
                                    Nom de l'annonce
                                </h4>
                                <h5>
                                    Catégorie annonce
                                </h5>
                                <h6>
                                    date
                                </h6>

                            </div>
                        </div>
                        <div class="add-card" id="createBtn2">
                            <img src="images/plusCard.png" class="plusCard" alt="">
                            <p>
                                Nouvelle
                                annonce
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="statistiques-sec">
                <div class="foorbis-announces">
                    <label>
                        Statistiques
                    </label>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#frmAddProfile', function(form) {
                form.preventDefault();
                var formData = new FormData($('#frmAddProfile')[0]);
                console.log(formData);
                $.ajax({
                    url: "{{ route('save-company') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.message);
                        if (response.key == 1) {
                            alert(response.message);
                            location.reload();
                        } else {
                            $.each(response.message, function(i, val) {
                                $('.error-' + i).text(val);
                            });
                        }
                    },
                })
            });
            $(document).on('submit', '#frmContactDetails', function(form) {
                form.preventDefault();
                var company_id = $('#company_id').val();
                var formData = new FormData($('#frmContactDetails')[0]);
                formData.append('company_id', company_id);
                console.log(formData);
                $.ajax({
                    url: "{{ route('save-contactdetails') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.message);
                        if (response.key == 1) {
                            alert(response.message);
                            location.reload();
                        } else {
                            $.each(response.message, function(i, val) {
                                $('.error-' + i).text(val);
                            });
                        }
                    },
                })
            });
            $(document).on('submit', '#frmContactDetails', function(form) {
                form.preventDefault();
                var company_id = $('#company_id').val();
                var formData = new FormData($('#frmContactDetails')[0]);
                formData.append('company_id', company_id);
                console.log(formData);
                $.ajax({
                    url: "{{ route('save-contactdetails') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.message);
                        if (response.key == 1) {
                            alert(response.message);
                            location.reload();
                        } else {
                            $.each(response.message, function(i, val) {
                                $('.error-' + i).text(val);
                            });
                        }
                    },
                })
            });
            $(document).on('submit', '#frmaddCompanyTime', function(form) {
                form.preventDefault();
                var company_id = $('#company_id').val();
                var formData = new FormData($('#frmaddCompanyTime')[0]);
                formData.append('company_id', company_id);
                console.log(formData);
                $.ajax({
                    url: "{{ route('save-companytime') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.message);
                        if (response.key == 1) {
                            alert(response.message);
                            location.reload();
                        } else {
                            $.each(response.message, function(i, val) {
                                $('.error-' + i).text(val);
                            });
                        }
                    },
                })
            });
            $(document).on('click', '#saveAboutUs', function(e) {
                var about_us = $('textarea#about_us').val();
                alert(about_us);
                var company_id = $('#company_id').val();
                $.ajax({
                    url: "{{ route('save-aboutus') }}",
                    type: 'POST',
                    data: {
                        'about_us': about_us,
                        'company_id': company_id
                    },
                    dataType: 'json',
                    // processData: false,
                    // contentType: false,
                    success: function(response) {
                        console.log(response.message);
                        if (response.key == 1) {
                            alert(response.message);
                            location.reload();
                        } else {
                            $.each(response.message, function(i, val) {
                                $('.error-' + i).text(val);
                            });
                        }
                    },
                })
            });
            $(document).on('click', '#saveReserveLink', function(e) {
                var reservation_link = $('#reservation_link').val();
                var company_id = $('#company_id').val();
                $.ajax({
                    url: "{{ route('save-reservation_link') }}",
                    type: 'POST',
                    data: {
                        'reservation_link': reservation_link,
                        'company_id': company_id
                    },
                    dataType: 'json',
                    // processData: false,
                    // contentType: false,
                    success: function(response) {
                        console.log(response.message);
                        if (response.key == 1) {
                            alert(response.message);
                            location.reload();
                        } else {
                            $.each(response.message, function(i, val) {
                                $('.error-' + i).text(val);
                            });


                        }
                    },
                })
            });
            $(document).on('click', '.plus-box', function(e) {
                var day = $(this).data('day');
                $(`<div class="` + day + ` row col-12">
                        <div class="col-2"></div>
                            <div class="col-4">
                                <div class="input-type box-hora seprete">
                                    <input class="regular-input" type="text" name="` + day + `_start_time[]" placeholder="Overturture">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-type box-hora seprete">
                                    <input class="regular-input" type="text" name="` + day + `_end_time[]" placeholder="Fermature">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="close-box ">
                                    <img src="images/close.png">
                                </div>
                            </div>
                        </div>
                    </div>`)
                    .appendTo('.' + day + 'dayDiv');
                // alert(day);
            });
        });
    </script>
@endpush
