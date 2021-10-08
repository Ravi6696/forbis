<div>
    @if ($companyAdvertisement && (($companyAdvertisement->name && !$updateData) || $companyAdvertisement->is_view))
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
                @if (auth()->user()->hasRole('pro-user') && !$companyAdvertisement->is_view)
                <div class="btnbox">
                    <button class="foorbis-btn updateAdDetail" data-id="{{ $companyAdvertisement->id ?? null }}">Mettre
                        à
                        jour</button>
                </div>
                @endif
                @if (auth()->user()->hasRole('user'))
                <div class="btnbox">
                    @if ($companyAdvertisement->is_send_dashboard)
                    <a href="{{ $companyAdvertisement->redirection_link }}" class="foorbis-btn">En
                        savoir
                        plus</a>
                    @else
                    <a href="{{ route('dashboard') }}" class="foorbis-btn">En savoir plus</a>
                    @endif
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
                    {{-- <div class="box fb"> --}}
                    <iframe
                        src="https://www.facebook.com/plugins/share_button.php?href=http://3.108.83.2/forbis%2F&layout=button&size=large&width=77&height=28&appId"
                        width="77" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                    {{-- </div>--}}
                    {{-- <div class="box fb">
                        <a class="shareBtn"> <img src="{{ asset('images/fb.png') }}" alt="">
                    </a>
                    12
                </div> --}}
                <div class="box insta">
                    <a href="">
                        <img src="{{ asset('images/insta.png') }}" alt="">
                    </a>
                    15
                </div>
                <div class="box twitter">
                    <a href="https://twitter.com/intent/tweet?text=http://3.108.83.2/forbis">
                        <img src="{{ asset('images/twiter.png') }}" alt="">
                    </a>
                    24
                </div>
                <div class="box linkedin">
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=http://3.108.83.2/forbis">
                        <img src="{{ asset('images/linkdin.png') }}" alt="">
                    </a>
                    {{-- <a href="{{ route('share-to-linkedin') }}">
                    <img src=" {{ asset('images/linkdin.png') }}" alt="">
                    </a> --}}
                    35
                </div>
            </div>
        </div>
    </div>
    @else
    @if ($companyAdvertisement)
    <form enctype="multipart/form-data" id="storeAd" class="storeAd" method="POST" data-toggle="validator"
        novalidate="novalidate">
        @csrf
        <div class="card">
            <div class="upr right-imges-upload">
                <div class="right-imges-upload-col">
                    <img src="{{ asset('images/right-img-upload.png') }}">
                    <input type="file" name="attachment" onchange="loadFile(event)" accept="image/*">
                </div>
                <img id="output" src="{{ $companyAdvertisement->attachment_path ?? asset('images/card1.png') }}">
            </div>
            <div class="lower">
                <!-- top-section -->
                <div class="header">
                    <div class="first">
                        <img src="{{ $companyAdvertisement->company->company_logo_path ?? asset('images/sqare-img.png') }}"
                            alt="">
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
                    @if (Auth::user()->hasRole('pro-user'))
                    <a class="nav-link foorbis-btn Modifier-button" href="{{ route('pro.dashboard') }}">Modifier</a>
                    @endif
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
                                    value="{{ $companyAdvertisement->name ?? null }}" placeholder="Titre de l'annonce">
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
                        <input type="text" name="redirection_link" placeholder="redirection" class="redirection_link"
                            value="{{ $companyAdvertisement->redirection_link }}">
                        <p class="error error_redirection_link"></p>
                    </div>

                    <div class="btnbox">
                        <button type="submit"
                            class="foorbis-btn mb-2 mt-3 saveAnnounce">{{ $updateData ? 'Mettre à jour' : 'Créer' }}</button>
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
                        <iframe
                            src="https://www.facebook.com/plugins/share_button.php?href=http://3.108.83.2/forbis%2F&layout=button&size=large&width=77&height=28&appId"
                            width="77" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                            allowfullscreen="true"
                            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                        </iframe>
                        {{-- </div>
                        <div class="box fb"> --}}
                        <a
                            href="https://www.facebook.com/plugins/share_button.php?href=http://3.108.83.2/forbis%2F&layout=button&size=large&width=77&height=28&appId">
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
                        <a href="https://twitter.com/intent/tweet?text=http://3.108.83.2/forbis">
                            <img src="{{ asset('images/twiter.png') }}" alt="">
                        </a>
                        24
                    </div>
                    <div class="box linkedin">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=http://3.108.83.2/forbis">
                            <img src="{{ asset('images/linkdin.png') }}" alt="">
                        </a>
                        35
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
    @endif
</div>
@push('scripts')
{{-- <script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script> --}}
{{-- <script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>
    <script>
        function statusChangeCallback(response) {
          console.log('statusChangeCallback');
          console.log(response);
          if (response.status === 'connected') {
            testAPI();

          } else if (response.status === 'not_authorized') {
            FB.login(function(response) {
              statusChangeCallback2(response);
            }, {scope: 'public_profile,email'});

          } else {
            alert("not connected, not logged into facebook, we don't know");
          }
        }

        function statusChangeCallback2(response) {
          console.log('statusChangeCallback2');
          console.log(response);
          if (response.status === 'connected') {
            testAPI();

          } else if (response.status === 'not_authorized') {
            console.log('still not authorized!');

          } else {
            alert("not connected, not logged into facebook, we don't know");
          }
        }

        function checkLoginState() {
          FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
          });
        }

        function testAPI() {
          console.log('Welcome!  Fetching your information.... ');
          FB.api('/me', function(response) {
            console.log('Successful login for: ' + response.name);
            document.getElementById('status').innerHTML =
              'Thanks for logging in, ' + response.name + '!';
          });
        }

        $(document).ready(function() {
            $('.shareBtn').click(function() {
                FB.ui({
                    display: 'popup',
                    method: 'share',
                    href: 'http://3.108.83.2/forbis',
                }, function(response){});
            });
          FB.init({
            appId      : '394294622251822',
            autoLogAppEvents: true,
            xfbml: true,
            version: 'v4.0'
          });
          checkLoginState();
        });
    </script> --}}
<script>
    $('.storeAd').validate({
            rules: {
                name: 'required',
                category_id: "required",
                description: {
                    required: true,
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
                        toastr.success(response.message);
                        if (response.key == 1) {
                            filterAds()
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
        // https://www.linkedin.com/developers/apps/verification/9c0baeef-e161-478a-a450-b7b834f7c102

</script>
@endpush
