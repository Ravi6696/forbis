@extends('admin_layouts.main')
@section('content')
    <div class="foorbis-penal scrollbar">
        <div class="foorbis-penal-all scrollbar">
            <div class="top-bar row">
                <p class="dashbord-name col-12">mon profil</p>
                <div class="col-xl-6 col-sm-12">
                    <div class="">
                        <div class="col-12 profile-select px-0">

                            <form id="editProfileFrm" method="post" action="{{ route('save-profile') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="monprofil-main">
                                    <div class="monprofile-img">
                                        <i class="fas fa-plus"></i>
                                        {{-- onchange="readURL(this);" --}}
                                        <input type="file" name="profile_pic" value="{{ $user->profile_pic }}">
                                        @if ($user->profile_pic)
                                            <img id="monprofile-img-id" src="{{ asset('uploads/' . $user->profile_pic) }}"
                                                alt="your image">
                                        @else
                                            <img id="monprofile-img-id" src="images/profile.png" alt="your image">
                                        @endif
                                    </div>
                                    <div class="monprofile-info-cols">
                                        <div class="">
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <div class="mon-input">
                                                <div class="reqired-star"></div>
                                                <input type="text" name="name" value="{{ $user->full_name }}"
                                                    placeholder="Pseudo">
                                            </div>
                                            <div class="mon-input">
                                                <div class="reqired-star-two"></div>
                                                <input type="text" name="email" value="{{ $user->email }}"
                                                    placeholder="Adresse mail">
                                            </div>
                                            <div class="mon-input">
                                                <input type="text" name="postal_code" value="{{ $user->postal_code }}"
                                                    placeholder="ZIP CODE">
                                            </div>
                                            <div class="mon-input">
                                                <input type="text" name="city" value="{{ $user->city }}"
                                                    placeholder="Ville">
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
                                        <p class="comment-total">3 commentaires</p>
                                    </div>
                                </div>
                                <div class="row monprofile-comment-sec"></div>
                                <div class="comment-box-row scrollbar">
                                    <div class="hr-mon-profile">
                                        <div class="img-two-profile">
                                            <img src="images/profile.png">
                                        </div>
                                        <div class="heading">
                                            <p> <span class="pink-highlight">Nom Prénom&nbsp;</span>depuis 2 jours</p>
                                            <p class="monprofile-sec-2">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Phasellus tincidunt augue accumsan, ultricies nulla quis, dignissim
                                                magna. Nunc pellentesque augue at metus pulvinar, mollis venenatis libero
                                                aliquam. Sed viverra ligula in
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hr-mon-profile">
                                        <div class="img-two-profile">
                                            <img src="images/profile.png">
                                        </div>
                                        <div class="heading">
                                            <p> <span class="pink-highlight">Nom Prénom&nbsp;</span>depuis 2 jours</p>
                                            <p class="monprofile-sec-2">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Phasellus tincidunt augue accumsan, ultricies nulla quis, dignissim
                                                magna. Nunc pellentesque augue at metus pulvinar, mollis venenatis libero
                                                aliquam. Sed viverra ligula in
                                            </p>
                                        </div>
                                    </div>

                                    <div class="hr-mon-profile">
                                        <div class="img-two-profile">
                                            <img src="images/profile.png">
                                        </div>
                                        <div class="heading">
                                            <p> <span class="pink-highlight">Nom Prénom&nbsp;</span>depuis 2 jours</p>
                                            <p class="monprofile-sec-2">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Phasellus tincidunt augue accumsan, ultricies nulla quis, dignissim
                                                magna. Nunc pellentesque augue at metus pulvinar, mollis venenatis libero
                                                aliquam. Sed viverra ligula in
                                            </p>
                                        </div>
                                    </div>

                                    <div class="hr-mon-profile">
                                        <div class="img-two-profile">
                                            <img src="images/profile.png">
                                        </div>
                                        <div class="heading">
                                            <p> <span class="pink-highlight">Nom Prénom&nbsp;</span>depuis 2 jours</p>
                                            <p class="monprofile-sec-2">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Phasellus tincidunt augue accumsan, ultricies nulla quis, dignissim
                                                magna. Nunc pellentesque augue at metus pulvinar, mollis venenatis libero
                                                aliquam. Sed viverra ligula in
                                            </p>
                                        </div>
                                    </div>

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
                            <p class="entreprises-total"> 25 Favories </p>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="fix-height-entreprise scrollbar">
                            <div class="enterprice-slide">
                                <div class="enterprice-img"><img src="images/r-company.png"></div>
                                <div class="centerprice-col">
                                    <a class="entreprise-heading" href="">Nom de l'entreprise</a>
                                    <a class="address" href="#"><img src="images/location-perpal.png"> Adresse</a>
                                    <a class="categorie" href="#"><img src="images/pink-menu.png"> Catégorie</a>
                                </div>
                                <div class="col-1 elose-btn-enterprice">
                                    <a href="#" class="close-enterprice"><img src="images/close.png"></a>
                                </div>
                            </div>
                            <div class="enterprice-slide">
                                <div class="enterprice-img"><img src="images/r-company.png"></div>
                                <div class="centerprice-col">
                                    <a class="entreprise-heading" href="">Nom de l'entreprise</a>
                                    <a class="address" href="#"><img src="images/location-perpal.png"> Adresse</a>
                                    <a class="categorie" href="#"><img src="images/pink-menu.png"> Catégorie</a>
                                </div>
                                <div class="col-1 elose-btn-enterprice">
                                    <a href="#" class="close-enterprice"><img src="images/close.png"></a>
                                </div>
                            </div>
                            <div class="enterprice-slide">
                                <div class="enterprice-img"><img src="images/r-company.png"></div>
                                <div class="centerprice-col">
                                    <a class="entreprise-heading" href="">Nom de l'entreprise</a>
                                    <a class="address" href="#"><img src="images/location-perpal.png"> Adresse</a>
                                    <a class="categorie" href="#"><img src="images/pink-menu.png"> Catégorie</a>
                                </div>
                                <div class="col-1 elose-btn-enterprice">
                                    <a href="#" class="close-enterprice"><img src="images/close.png"></a>
                                </div>
                            </div>
                            <div class="enterprice-slide">
                                <div class="enterprice-img"><img src="images/r-company.png"></div>
                                <div class="centerprice-col">
                                    <a class="entreprise-heading" href="">Nom de l'entreprise</a>
                                    <a class="address" href="#"><img src="images/location-perpal.png"> Adresse</a>
                                    <a class="categorie" href="#"><img src="images/pink-menu.png"> Catégorie</a>
                                </div>
                                <div class="col-1 elose-btn-enterprice">
                                    <a href="#" class="close-enterprice"><img src="images/close.png"></a>
                                </div>
                            </div>
                            <div class="enterprice-slide">
                                <div class="enterprice-img"><img src="images/r-company.png"></div>
                                <div class="centerprice-col">
                                    <a class="entreprise-heading" href="">Nom de l'entreprise</a>
                                    <a class="address" href="#"><img src="images/location-perpal.png"> Adresse</a>
                                    <a class="categorie" href="#"><img src="images/pink-menu.png"> Catégorie</a>
                                </div>
                                <div class="col-1 elose-btn-enterprice">
                                    <a href="#" class="close-enterprice"><img src="images/close.png"></a>
                                </div>
                            </div>
                            <div class="enterprice-slide">
                                <div class="enterprice-img"><img src="images/r-company.png"></div>
                                <div class="centerprice-col">
                                    <a class="entreprise-heading" href="">Nom de l'entreprise</a>
                                    <a class="address" href="#"><img src="images/location-perpal.png"> Adresse</a>
                                    <a class="categorie" href="#"><img src="images/pink-menu.png"> Catégorie</a>
                                </div>
                                <div class="col-1 elose-btn-enterprice">
                                    <a href="#" class="close-enterprice"><img src="images/close.png"></a>
                                </div>
                            </div>
                            <div class="enterprice-slide">
                                <div class="enterprice-img"><img src="images/r-company.png"></div>
                                <div class="centerprice-col">
                                    <a class="entreprise-heading" href="">Nom de l'entreprise</a>
                                    <a class="address" href="#"><img src="images/location-perpal.png"> Adresse</a>
                                    <a class="categorie" href="#"><img src="images/pink-menu.png"> Catégorie</a>
                                </div>
                                <div class="col-1 elose-btn-enterprice">
                                    <a href="#" class="close-enterprice"><img src="images/close.png"></a>
                                </div>
                            </div>
                            <div class="enterprice-slide">
                                <div class="enterprice-img"><img src="images/r-company.png"></div>
                                <div class="centerprice-col">
                                    <a class="entreprise-heading" href="">Nom de l'entreprise</a>
                                    <a class="address" href="#"><img src="images/location-perpal.png"> Adresse</a>
                                    <a class="categorie" href="#"><img src="images/pink-menu.png"> Catégorie</a>
                                </div>
                                <div class="col-1 elose-btn-enterprice">
                                    <a href="#" class="close-enterprice"><img src="images/close.png"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-12">
                    <div class="messages">
                        <div class="col-12">
                            <p class="messages-top-heading">mEs messages</p>
                            <hr>
                        </div>
                        <div class="all-msg-fix scrollbar">

                            <div class=" singal-message unread-msg ">
                                <div class="innner-singal">
                                    <div class="msg-profile-img online">
                                        <img class="online-img" src="images/profile-pink.png">
                                    </div>
                                    <div class="meg-info">
                                        <div class="row msg-description">
                                            <div class="messager-name">Entreprise</p>
                                            </div>
                                            <div class="message-time">30 min</p>
                                            </div>
                                            <div class="close-message">
                                                <a class="message-close" href="#"><img src="images/close.png"></a>
                                            </div>
                                            <div class="col-12">
                                                <p class="messages-topic">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    Donec tempor massa vitae egestas porttitor.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" singal-message unread-msg">
                                <div class="innner-singal">
                                    <div class="msg-profile-img online">
                                        <img class="online-img" src="images/y-profile.png">
                                    </div>
                                    <div class="meg-info">
                                        <div class="row msg-description">
                                            <div class="messager-name">Entreprise</p>
                                            </div>
                                            <div class="message-time">30 min</p>
                                            </div>
                                            <div class="close-message">
                                                <a class="message-close" href="#"><img src="images/close.png"></a>
                                            </div>
                                            <div class="col-12">
                                                <p class="messages-topic">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    Donec tempor massa vitae egestas porttitor.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" singal-message reeded-msg">
                                <div class="innner-singal">
                                    <div class="msg-profile-img online">
                                        <img class="online-img" src="images/g-profile.png">
                                    </div>
                                    <div class="meg-info">
                                        <div class="row msg-description">
                                            <div class="messager-name">Entreprise</p>
                                            </div>
                                            <div class="message-time">30 min</p>
                                            </div>
                                            <div class=" close-message">
                                                <a class="message-close" href="#"><img src="images/close.png"></a>
                                            </div>
                                            <div class="col-12">
                                                <p class="messages-topic">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    Donec tempor massa vitae egestas porttitor.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" singal-message reeded-msg">
                                <div class="innner-singal">
                                    <div class="msg-profile-img online">
                                        <img class="online-img" src="images/g-profile.png">
                                    </div>
                                    <div class="meg-info">
                                        <div class="row msg-description">
                                            <div class="messager-name">Entreprise</p>
                                            </div>
                                            <div class="message-time">30 min</p>
                                            </div>
                                            <div class="close-message">
                                                <a class="message-close" href="#"><img src="images/close.png"></a>
                                            </div>
                                            <div class="col-12">
                                                <p class="messages-topic">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    Donec tempor massa vitae egestas porttitor.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" singal-message reeded-msg">
                                <div class="innner-singal">
                                    <div class="msg-profile-img online">
                                        <img class="online-img" src="images/g-profile.png">
                                    </div>
                                    <div class="meg-info">
                                        <div class="row msg-description">
                                            <div class="messager-name">Entreprise</p>
                                            </div>
                                            <div class="message-time">30 min</p>
                                            </div>
                                            <div class="close-message">
                                                <a class="message-close" href="#"><img src="images/close.png"></a>
                                            </div>
                                            <div class="col-12">
                                                <p class="messages-topic">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                    Donec tempor massa vitae egestas porttitor.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-sm-12">
                    <div class="full-text-msg">
                        <div class="fix-height-text-msg scrollbar">
                            <div class="row text-msg">
                                <div class="text-msg-profile">
                                    <img src="images/g-profile.png">
                                </div>
                                <div class="perpal-text-msg">
                                    <p class="text-inmsg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                        semper aliquet semper. Quisque dapibus elit sit amet tortor porta eleifend. </p>
                                </div>
                            </div>

                            <div class="row text-msg receive-message">
                                <div class="perpal-text-msg">
                                    <p class="text-inmsg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                        semper aliquet semper. Quisque dapibus elit sit amet tortor porta eleifend. </p>
                                </div>
                                <div class="text-msg-profile ">
                                    <img src="images/gray-profile-girl.png">
                                </div>
                            </div>

                            <div class="row text-msg">
                                <div class="text-msg-profile">
                                    <img src="images/g-profile.png">
                                </div>
                                <div class="perpal-text-msg">
                                    <p class="text-inmsg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                        semper aliquet semper. Quisque dapibus elit sit amet tortor porta eleifend. </p>
                                </div>
                            </div>

                            <div class="row text-msg receive-message">
                                <div class="perpal-text-msg">
                                    <p class="text-inmsg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                        semper aliquet semper. Quisque dapibus elit sit amet tortor porta eleifend. </p>
                                </div>
                                <div class="text-msg-profile ">
                                    <img src="images/gray-profile-girl.png">
                                </div>
                            </div>
                        </div>

                        <div class="sms-text-input">
                            <div class="col-12 p-0">
                                <hr style="width: 97%;margin-left: 0px;margin-bottom: 0px;">
                            </div>
                            <div class="row" style="padding: 0px 15px">
                                <div class="send-message-input">
                                    <input type="text" name="" placeholder="Message ...">
                                </div>
                                <div class="">
                                    <button class="send-message-btn"><img src="images/send-message-icon.png"
                                            class="mr-2">Envoyer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('submit', '#editProfileFrm', function(form) {
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
                        console.log(response);

                    },
                })
            });
        });
    </script>
@endpush
