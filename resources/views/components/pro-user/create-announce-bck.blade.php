<div>
    @if (($companyAdvertisement->name && !$updateData) || $companyAdvertisement->is_view)
        <div class="card">
            <div class="upr choose-imges">
                <input type="file" name="attachment" onchange="readURL(this);">
                <img src="{{ $companyAdvertisement->attachment_path ?? asset('images/card1.png') }}" alt=""
                    id="MesAnnonces-img">
            </div>
            <div class="lower">
                <div class="header">
                    <div class="first">
                        <img src="{{ $companyAdvertisement->company->company_logo_path }}" alt="">
                    </div>
                    <div class="second">
                        <h5>
                            {{ $companyAdvertisement->company->name ?? '-' }}
                        </h5>
                        <p>
                            <img src="{{ asset('images/location2.png') }}" alt="">
                            {{ $companyAdvertisement->company->full_address ?? '-' }}
                        </p>
                    </div>
                    <div class="label">
                        Ouvert
                    </div>
                </div>
                <hr>
                <div class="content">
                    <h4>
                        {{ $companyAdvertisement->name ?? '-' }}
                    </h4>
                    <h6>
                        {{ $companyAdvertisement->category->title ?? '-' }}
                    </h6>
                    <p>
                        {{ $companyAdvertisement->description ?? '-' }}
                    </p>
                    @if (!$companyAdvertisement->is_view)
                        <div class="btnbox">
                            <button class="foorbis-btn updateAd"
                                data-id="{{ $companyAdvertisement->id ?? null }}">Mettre à
                                jour</button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="cardFooter">
                <div class="btnbox">
                    <a href="">
                        <img src="{{ asset('images/share.png') }}" alt="">
                        Partager
                    </a>
                </div>
                <div class="social">
                    <div class="box fb">
                        <a href="">
                            <img src="{{ asset('images/fb.png') }}" alt="">
                        </a>
                        12
                    </div>
                    <div class="box insta">
                        <a href="">
                            <img src="{{ asset('images/insta.png') }}" alt="">
                        </a>
                        15
                    </div>
                    <div class="box twitter">
                        <a href="">
                            <img src="{{ asset('images/twiter.png') }}" alt="">
                        </a>
                        24
                    </div>
                    <div class="box linkedin">
                        <a href="">
                            <img src="{{ asset('images/linkdin.png') }}" alt="">
                        </a>
                        35
                    </div>
                </div>
            </div>
        </div>
    @else
        <form enctype="multipart/form-data" id="storeAd" class="storeAd" method="POST" data-toggle="validator" novalidate="novalidate">
            @csrf
            <div class="card">
                <div class="upr right-imges-upload">
                    <div class="right-imges-upload-col">
                        <img src="{{ asset('images/right-img-upload.png') }}">
                        <input type="file" name="attachment" onchange="loadFile(event)" accept="image/*">
                    </div>
                    <img id="output" src="{{ $companyAdvertisement->attachment_path }}">
                </div>
                <div class="lower">
                    <!-- top-section -->
                    <div class="header">
                        <div class="first">
                            <img src="{{ $companyAdvertisement->company->company_logo_path }}" alt="">
                        </div>
                        <div class="second">
                            <h5>
                                {{ $companyAdvertisement->company->name ?? '-' }}
                            </h5>
                            <p>
                                <img src="{{ asset('images/location2.png') }}" alt="">
                                {{ $companyAdvertisement->company->full_address ?? '-' }}
                            </p>
                        </div>
                        <div class="label">
                            Ouvert
                        </div>
                    </div>
                    <div style="overflow: hidden;" class="mt-2">
                        <a class="nav-link foorbis-btn Modifier-button" href="#">Modifier</a>
                    </div>
                    <!-- top-section -->
                    <hr>
                    <div class="content right-panal-content">
                        <div class="row">
                            <div class="col-10">
                                <div class="right-panal-data">
                                    <input type="hidden" name="ad_id" id="ad_id"
                                        value="{{ $companyAdvertisement->id ?? null }}">
                                    <input type="hidden" name="company_id" id="company_id"
                                        value="{{ $companyAdvertisement->company_id ?? null }}">
                                    <input type="text" name="name" class="adTitle"
                                        value="{{ $companyAdvertisement->name ?? null }}"
                                        placeholder="Titre de l'annonce">
                                    <p class="error error_name"></p>
                                    <select name="category_id" id="category_id" class="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $id => $title)
                                            <option value="{{ $id }}"
                                                {{ $companyAdvertisement->category_id == $id ? 'selected' : null }}>
                                                {{ $title }}</option>
                                        @endforeach
                                    </select>
                                    <p class="error error_category_id"></p>
                                </div>
                            </div>
                            <div class="col-2 mt-2" style="color: #c2c2c2">date</div>
                        </div>

                        <div>
                            <textarea class="scrollbar adDesc" placeholder="Descriptif"
                                name="description">{{ $companyAdvertisement->description ?? null }}</textarea>
                            <hr>
                            <p class="error error_description"></p>

                            <div class="dashboard-check">
                                <input type="checkbox" class="is_send_dashboard" name="is_send_dashboard" value="1"
                                    {{ $companyAdvertisement->is_send_dashboard == 1 ? 'checked' : null }}>
                                <label for="dashboard" class="m-0 text-light"> Envoyer vers mon dashboard</label>
                            </div>
                            <input type="text" name="redirection_link" placeholder="redirection"
                                class="redirection_link" value="{{ $companyAdvertisement->redirection_link }}">
                            <p class="error error_redirection_link"></p>
                        </div>

                        <div class="btnbox">
                            <button type="submit" class="foorbis-btn mb-2 mt-3">Créer</button>
                        </div>
                    </div>
                </div>
                <div class="cardFooter">
                    <div class="btnbox">
                        <a href="">
                            <img src="{{ asset('images/share.png') }}" alt="">
                            Partager
                        </a>
                    </div>
                    <div class="social">
                        <div class="box fb">
                            <a href="">
                                <img src="{{ asset('images/fb.png') }}" alt="">
                            </a>
                            12
                        </div>
                        <div class="box insta">
                            <a href="">
                                <img src="{{ asset('images/insta.png') }}" alt="">
                            </a>
                            15
                        </div>
                        <div class="box twitter">
                            <a href="">
                                <img src="{{ asset('images/twiter.png') }}" alt="">
                            </a>
                            24
                        </div>
                        <div class="box linkedin">
                            <a href="">
                                <img src="{{ asset('images/linkdin.png') }}" alt="">
                            </a>
                            35
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>
@push('scripts')
    <script>
        $('.storeAd').validate({
            rules: {
                name: 'required',
                category_id: "required",
                description: {
                    required: true,
                },
                redirection_link: {
                    required: true,
                    url: true,
                },
            }
        });
        $(document).ready(function() {
            $(document).on('submit', '.storeAd', function(form) {
                form.preventDefault();
                var formData = new FormData($('.storeAd')[0]);
                $.ajax({
                    url: "{{ route('save-ad') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response.message);
                        if (response.key == 1) {
                            location.reload();
                        }
                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            $('.error_' + key).html(val)
                        })
                    },
                })
                form.stopImmediatePropagation();
            });
        });
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
