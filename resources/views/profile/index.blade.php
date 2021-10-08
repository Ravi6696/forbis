<x-frontend.layout>
    @push('styles')
    <style>
        img {
            border-radius: 50%;
        }
    </style>
    @endpush
    <div class="foorbis-penal scrollbar">
        <div class="foorbis-penal-all scrollbar">
            <div class="top-bar row">
                <p class="dashbord-name col-12">mon profil</p>
                <div class="col-xl-6 col-sm-12">
                    <div class="___class_+?5___">
                        <div class="col-12 profile-select px-0">

                            <form id="editProfileFrm" method="post" action="{{ route('save-profile') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="monprofil-main">
                                    <div class="monprofile-img">
                                        <i class="fas fa-plus"></i>
                                        {{-- onchange="readURL(this);" --}}
                                        <input type="file" name="profile_pic" id="profile_pic"
                                            onchange="loadFile(event)" value="{{ $user->profile_pic }}">
                                        @if ($user->profile_pic)
                                        <img id="monprofile-img-id" src="{{ asset('uploads/' . $user->profile_pic) }}"
                                            alt="your image">
                                        @else
                                        <img id="monprofile-img-id" src="images/profile.png" alt="your image">
                                        @endif
                                    </div>
                                    <div class="monprofile-info-cols">
                                        <div class="___class_+?11___">
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <div class="mon-input">
                                                <div class="reqired-star"></div>
                                                <input type="text" name="name" value="{{ $user->full_name }}"
                                                    placeholder="Pseudo">
                                                <p class="error" id="error_name"></p>
                                            </div>
                                            <div class="mon-input">
                                                <div class="reqired-star-two"></div>
                                                <input type="text" name="email" value="{{ $user->email }}"
                                                    placeholder="Adresse mail">
                                                <p class="error" id="error_email"></p>
                                            </div>
                                            <div class="mon-input">
                                                <input type="text" name="postal_code"
                                                    value="{{ $user->address->postalcode ?? null }}"
                                                    placeholder="ZIP CODE">
                                                <p class="error" id="error_postal_code"></p>
                                            </div>
                                            <div class="mon-input">
                                                <input type="text" name="city"
                                                    value="{{ $user->address->city ?? null }}" placeholder="Ville">
                                                <p class="error" id="error_city"></p>
                                            </div>
                                            <div class="profile-btn parpal-btn">
                                                {{-- <a href="#" class="">Sauvegarder</a> --}}
                                                <button type="submit">Sauvegarder</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 px-0">
                            <div class="mon-pro-comment">
                                <div style="display: flex;flex-wrap: wrap;">
                                    <div class="col-6">
                                        <p class="comment-heding">mEs COMMENTAIRES</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="comment-total">{{$user->companyComments->count()??0}} commentaires</p>
                                    </div>
                                </div>
                                <div class="row monprofile-comment-sec"></div>
                                <div class="comment-box-row scrollbar">
                                    @foreach ($user->companyComments as $comment)
                                    <div class="hr-mon-profile">
                                        <div class="img-two-profile">
                                            <img src="images/profile.png">
                                        </div>
                                        <div class="heading">
                                            <p> <span
                                                    class="pink-highlight">{{$comment->company->name ??'-'}}&nbsp;</span>depuis
                                                {{$comment->created_at->diffForHumans()}}
                                            </p>
                                            <p class="monprofile-sec-2">{{$comment->comment??'-'}}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-12">
                    <div class="row full-entreprises">
                        <div class="col-8">
                            <p class="entreprises-heading">mEs entreprises favorites </p>
                        </div>
                        <div class="col-4">
                            <p class="entreprises-total"> {{$user->favourites->count() ?? 0}} Favories </p>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="fix-height-entreprise scrollbar">
                            @foreach ($user->favourites as $favCompany)
                            <div class="enterprice-slide">
                                <div class="enterprice-img"><img
                                        src="{{$favCompany->company->company_logo_path ?? null}}">
                                </div>
                                <div class="centerprice-col">
                                    <a class="entreprise-heading" href="">{{$favCompany->company->name ?? '-'}}</a>
                                    <a class="address" href="#"><img src="images/location-perpal.png">
                                        {{$favCompany->company->full_address ?? '-'}}</a>
                                    <a class="categorie" href="#"><img src="images/pink-menu.png">
                                        @isset($favCompany->company->companyCategory)
                                        @foreach ($favCompany->company->companyCategory as $item)
                                        {{ $item->category->title ?? null }}
                                        @endforeach
                                        @endisset</a>
                                </div>
                                <div class="col-1 elose-btn-enterprice">
                                    <a href="#" class="close-enterprice"><img src="images/close.png"></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-12 show-conversation">
                    <x-conversation></x-conversation>
                </div>
                <div class="col-xl-8 col-sm-12 show-chat">
                    <x-chat></x-chat>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('monprofile-img-id');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        function getConversations(e) {

        }
        $(document).ready(function() {
            $(".show-msgs").animate({ scrollTop: $('.show-msgs').prop("scrollHeight")}, 1000);
            $(document).on('click','#send-message-btn',function(params) {
                var message = $('#message').val();
                var conversation_id = $('#conversation_id').val();
                var user_id = $('#user_id').val();
                $.ajax({
                    url: "{{ route('send-message') }}",
                    type: 'POST',
                    data: {
                        message:message,
                        conversation_id:conversation_id,
                        user_id:user_id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        toastr.success(response.message);
                        if (response.key == 1) {
                            $('.show-msgs').append(response.data.send_msg);
                            $('.show-conversation').html(response.data.conversation);
                            $(".show-msgs").animate({ scrollTop: $('.show-msgs').prop("scrollHeight")}, 1000);
                            $('#message').val('');
                        }
                    },
                })
            });
            $(document).on('submit', '#editProfileFrm', function(form) {
                $('.error').html('');
                form.preventDefault();
                var formData = new FormData($('#editProfileFrm')[0]);
                $.ajax({
                    url: form.currentTarget.action,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function(response) {
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            $('#error_' + key).html(val)
                        })
                    },
                })
            });
        });
    </script>
    @endpush
</x-frontend.layout>
