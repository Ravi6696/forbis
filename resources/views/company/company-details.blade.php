<form enctype="multipart/form-data" id="frmAddProfile" method="post" data-toggle="validator"
    enctype="multipart/form-data" novalidate="novalidate">
    @csrf
    <div class="pro-img-section row" id="mon-profile">
        <div class="d-flex dashboard-list mx-0">
            <div class="main-img">
                <div class="pink-imginput-btn">
                    <input id="btn-input" type="file" name="company_images[]" multiple onchange="preview_image(event);">
                    <p><img src="{{ asset('images/img-icon.png') }}" class="img-icon"><a href="#">Nouvelles
                            images</a>
                    </p>
                </div>
                <img id="main-img"
                    src="{{ $companyData ? $companyData->featured_image : asset('images/coffee-shop.png') }}"
                    alt="your image" class="input-main-cols">
            </div>
            <p class="error" id="error_company_images"></p>
            <div class="d-flex justify-content-center p-0 ml-3 responive-item-slider">
                <div class="thumbes scrollbar mr-0 images-preview">
                    @if ($companyData && sizeof($companyData->images_path))
                        @foreach ($companyData->images_path as $id => $item)
                            <div class="thumb-img d-flex justify-content-center">
                                <div class="position-relative">
                                    <img src="{{ asset($item) }}" width="110px" style="height: 95px;">
                                    <img class="position-absolute cursor-pointer top-right-position delete-gallery"
                                        data-id="{{ $id }}" src="{{ asset('images/remove.png') }}"
                                        width="20px" alt="">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="y-img-section m-0">
            <div class="row m-0">
                <div class="select-imges-box d-flex justify-content-center">
                    <div class="ysqare-img">
                        <img src="{{ $companyData->company_logo_path ?? asset('images/sqare-img.png') }}"
                            class="update-img" id="output">
                        <input id="btn-input" class="hide-upload-input" type="file" name="company_logo" accept="image/*"
                            onchange="loadFile(event)">
                        <img src="{{ asset('images/right-img-upload.png') }}" class="img-upload" width="63px"
                            height="63px" alt="">
                    </div>
                    <p class="error" id="error_company_logo"></p>
                </div>
                <div class="select-imges-info">
                    <div class="row m-0 mt-4 w-100">
                        <div class="nom-entreprise-input-col  mr-4 mb-3">
                            <input class="m-0 nom-entreprise-input" type="text" name="company_name"
                                value="{{ $companyData->name ?? null }}" placeholder="Nom entreprise">
                            <p class="error" id="error_company_name"></p>
                        </div>
                        <div class="cate-entreprise-select-col">
                            <select class="cate-entreprise-select mb-3 chosen-select" id="category" name="category_id"
                                id="categories">
                                <option value="" selected disabled hidden>Catégorie</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $companyData && $companyData->category_id ? 'selected' : '' }}>
                                        {{ $item->title }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="error" id="error_category_id"></p>
                        </div>
                        <div class="nom-entreprise-input-col mb-3">
                            <input class="m-0 nom-entreprise-input" type="text" name="specialization"
                                value="{{ $companyData->specialization ?? null }}" placeholder="spécialisation">
                            <p class="error" id="error_specialization"></p>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-xl-6 col-lg-12 d-flex pl-0 responive-flex">
                            <div class="d-flex align-items-center checkbox-Raison checkbox" style="min-width: 160px;">
                                <input type="checkbox" id="collect" name="is_collect" value="1"
                                    onchange="$('#collect_link').toggle()"
                                    {{ $companyData ? ($companyData->is_collect ? 'checked' : null) : null }}>
                                <label for="collect" class=""> <span class=" responsive-text container-checkbox
                                    mt-1">Click and collect</span></label>
                            </div>
                            <div class="w-100">
                                <input
                                    class="second {{ $companyData ? ($companyData->is_collect ? '' : 'hidden') : 'hidden' }}"
                                    type="text"
                                    value="{{ $companyData ? $companyData->collect_link ?? null : null }}"
                                    name="collect_link" id="collect_link" placeholder="Lien click and collect">
                                <p class="error" id="error_collect_link"></p>

                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 d-flex responive-flex">
                            <div class="d-flex align-items-center checkbox-Raison checkbox" style="min-width: 115px;">
                                <input type="checkbox" id="Livraison" name="is_delivery" value="1"
                                    onchange="$('#delivery_link').toggle()"
                                    {{ $companyData ? ($companyData->is_delivery ? 'checked' : null) : null }}>
                                <label for="Livraison" class=""> <span class=" responsive-text container-checkbox
                                    mt-1">Livraison</span></label>
                            </div>
                            <div class="w-100">
                                <input
                                    class="second {{ $companyData ? ($companyData->is_delivery ? '' : 'hidden') : 'hidden' }}"
                                    type="text"
                                    value="{{ $companyData ? $companyData->delivery_link ?? null : null }}"
                                    name="delivery_link" id="delivery_link" placeholder="Lien livraison">
                                <p class="error" id="error_delivery_link"></p>

                            </div>
                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-end col-12">
                        <button class="parpal-btn-lg" type="submit">Sauvegarder</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
