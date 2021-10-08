<x-frontend.layout>
    @push('styles')
        <style>
            input.error,
            textarea.error,
            select.error {
                border-color: red !important;
            }

            label.error,
            p.error {
                color: red !important;
            }

        </style>
    @endpush
    <!-- foorbis-sidebar-end -->
    <div class="foorbis-penal scrollbar admin-foorbis-col" id="foorbis-penal">
        <div class="foorbis-penal-all ">
            <div class="row pt-4">
                <!-- foorbis-penal-left Start  -->
                <div class="col-md-8 pt-0 faq-col-8">
                    <div id="list1" class="content">
                        <!-- Mes offres d'emploi start -->
                        <div class="foorbis-intitule-box">
                            <div class="header-col-input">
                                <div class="row">
                                    <form class="w-100" id="frmFaqAdd" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-input icon-input col-12">
                                            <div class="foorbis-question-head foorbis-announces">
                                                <label>
                                                    <p style="color:#C2C2C2;"> NOUVELLE QUESTIONA</p>
                                                </label>
                                            </div>
                                            <div class="admin-actualite-col mb-4">
                                                <div class="card blog-info-col mb-3 border-0 title-que-col foorbis-boxshadow"
                                                    style="border-radius: 10px;">
                                                    <input type="text" name="question" id="question" value=""
                                                        placeholder="Titre Question">
                                                </div>
                                            </div>
                                            <p class="error mt-2" id="error_question"></p>
                                            <div class="Header-Recrutement admin-categorie-col mb-0">
                                                <textarea name="description" id="description" class="scrollbar"
                                                    placeholder="Poser votre question"></textarea>
                                                <p class="error mt-2" id="error_description"></p>
                                                <div class="subtitle mt-3"
                                                    style="display: flex;flex-wrap: wrap;justify-content:space-between;">
                                                    <div style="position: relative;">
                                                        <select class="border-0" id="category" name="category[]"
                                                            class="foorbis-boxshadow" multiple
                                                            style="width:auto;background-color: transparent;">
                                                            {{-- <select name="Categorie" id="Categorie"
                                                            class="foorbis-boxshadow"> --}}
                                                            <option value="">Categorie/ nouvelleCategorie</option>
                                                            @foreach ($categories as $id => $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <p class="error mt-2" id="error_category"></p>
                                                        <span class="select-icon"><img
                                                                src="{{ asset('images/right.png') }}" alt=""></span>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit"
                                                            class="nav-link parpal-btn float-right text-center">Creer</button>
                                                        {{-- <a class="nav-link parpal-btn float-right text-center" href="#"
                                                        style="width:170px;font-size: 18px;height: 50px;">Creer</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-5">
                                <div class="col-md-6 mt-2">
                                    <div class="faq-search">
                                        <img src="{{ asset('images/search-icon.png') }}" width="20px" height="20px"
                                            alt="">
                                        <input type="text" id="search_filter" name="search_filter"
                                            placeholder="Recherche">
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-center justify-content-end mt-2">
                                    <p class="mb-0" style="color: #707070;">Dernière mise à jour le date</p>
                                </div>
                            </div>
                        </div>
                        <div class="faq-list"></div>
                        <div class="col-12 foorbis-boxshadow my-5">
                            <h3 class="border-bottom pb-3">Votre reponse</h3>
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
                                    <button class="pink-btn-md p-0 mt-4 border-0">Poser votre question</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Mes offres d'emploiend -->
                    <div id="list2" class="content d-none">
                    </div>
                    <div id="list3" class="content d-none">
                    </div>
                    @if (!Auth::user()->hasRole('admin'))
                        <div id="list4" class="content d-none">
                            <div class="foorbis-question-res-box scrollbar">
                                <div class="DonnerVotreAvis-col">
                                    <h6>Donner votre avis et aider nous </h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tincidunt
                                        augue
                                        accumsan,
                                        ultricies nulla quis, dignissim magna. Nunc pellentesque augue at metus
                                        pulvinar,
                                        mollis venenatis
                                    </p>
                                </div>

                                <div>
                                    <textarea type="text" placeholder="Donner votre avis"
                                        class="scrollbar"></textarea>
                                    <div class="add-file">
                                        <img id="blah" src="{{ asset('images/add-file.png') }}" class="mt-3">
                                        <input type="file" onchange="readURL(this);">
                                        <button class="add-file-poser">Envoyer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- foorbis-penal-left ENd -->
                <!-- foorbis-penal-right start -->
                <div class="foorbis-penal-right">
                    <div class="list-group" id="ListScrollSpy">
                        <a class="list-group-item fs-22 px-3 faq-right-panel-btn shadow my-2 border-0 rounded pl-2 fs-2 list-group-item-action active"
                            href="javascript:;"
                            onclick="$('.content').addClass('d-none'); $('#list1').removeClass('d-none'); $('.active').removeClass('active'); $(this).addClass('active');">
                            <img class="mr-4" src="{{ asset('images/dual-messanger.png') }}" alt="">
                            FAQ</a>
                        <a class="list-group-item my-2 fs-22 px-3 faq-right-panel-btn shadow rounded border-0 pl-2 fs-2 list-group-item-action"
                            href="javascript:;"
                            onclick="$('.content').addClass('d-none'); $('#list2').removeClass('d-none'); $('.active').removeClass('active'); $(this).addClass('active');">
                            <img class="mr-4" src="{{ asset('images/report.png') }}" alt="">
                            Mention legal</a>
                        <a class="list-group-item my-2 fs-22 px-3 rounded fs-2 faq-right-panel-btn border-0 pl-2 list-group-item-action"
                            href="javascript:;"
                            onclick="$('.content').addClass('d-none'); $('#list3').removeClass('d-none'); $('.active').removeClass('active'); $(this).addClass('active');">
                            <img class="mr-4" src="{{ asset('images/report.png') }}" alt="">
                            CGU</a>
                        @if (!Auth::user()->hasRole('admin'))
                            <a class="list-group-item my-2 fs-22 px-3 rounded border-0 faq-right-panel-btn pl-2 list-group-item-action"
                                href="javascript:;"
                                onclick="$('.content').addClass('d-none'); $('#list4').removeClass('d-none'); $('.active').removeClass('active'); $(this).addClass('active');">
                                <img class="mr-4" src="{{ asset('images/user-sms.png') }}" alt="">

                                Donner votre avis
                            </a>
                        @endif
                    </div>
                </div>
                <!-- foorbis-penal-right ENd -->
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function getFaqList() {
                var search_filter = $('#search_filter').val();
                $.ajax({
                    url: "{{ route('faq-list') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'search_filter': search_filter,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.key == 1) {
                            $('.faq-list').html(response.data.html);
                        }
                    }
                })
            }
            $(document).ready(function() {
                getFaqList();
                $(document).on('keyup', '#search_filter', function(e) {
                    getFaqList();
                });
                $(document).on('submit', '#frmFaqAdd', function(form) {
                    form.preventDefault();
                    var formData = new FormData($('#frmFaqAdd')[0]);
                    $.ajax({
                        url: "{{ route('save-faq-question') }}",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            toastr.success(response.message);
                            if (response.key == 1) {
                                // location.href = "{{ route('forum') }}";
                            }
                        },

                        error: function(response) {
                            let errors = response.responseJSON.errors;
                            $.each(errors, function(key, val) {
                                $('#error_' + key).html(val)
                            })
                        },
                    })
                });
            })
        </script>
    @endpush
</x-frontend.layout>
