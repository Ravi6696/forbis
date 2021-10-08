<x-frontend.layout>
    @push('styles')
        <style>
            .d-none {
                display: none;
            }

        </style>
    @endpush
    <div class="foorbis-penal scrollbar" id="foorbis-penal">
        <div class="foorbis-penal-all ">
            <div class="row">
                <!-- foorbis-penal-left Start  -->
                <div class="foorbis-penal-left">
                    <div class="foorbis-switch">
                        <h5>
                            {{ Auth::user()->hasRole('pro-user') ? 'MES ANNOUNCES' : 'ANNOUNCES' }}
                        </h5>
                        @if (Auth::user()->hasRole('pro-user'))
                        <div class="btnbox">
                            <div id="announces" class="btn btnAnnounce notactive">
                                Announces
                            </div>
                            <div id="mes" class="btn btnAnnounce active">
                                Mes announces
                            </div>
                        </div>
                        @endif
                    </div>
                    <!--  heading end-->

                    <!-- Search panel Start -->
                    <div class="foorbis-search announce-search">
                        <div class="searchbox">
                            <img class="searchImg" src="{{ asset('images/search.png') }}" alt="">
                            <input type="text" id="search_filter" placeholder="Recherche " class="searchField">
                        </div>
                    </div>
                    <!-- search panel End -->
                    <hr>

                    <!-- foorbis nav tab start -->
                    <div class="favoris-filtre-tab">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link foorbis-btn btn-filter">Filtres</a>
                                {{-- <a class="nav-link foorbis-btn btn-filter" id="pills-filtre-tab" data-toggle="pill"
                                    href="#pills-filtre" role="tab" aria-controls="pills-filtre"
                                    aria-selected="false">Filtres</a> --}}
                            </li>
                            <li class="nav-item ml-5" role="presentation">
                                <a class="nav-link foorbis-btn active btn-myfav">Mes favoris</a>
                            </li>

                        </ul>
                        <div class="tab-content d-none" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-mesFavoris" role="tabpanel"
                                aria-labelledby="pills-mesFavoris-tab">

                                <!-- range panel start -->
                                <div class="slider-range mt-5 position-relative">
                                    <label class="w-100">Distance de recherche</label>
                                    <div class="range-slider">
                                        <div class="box-minmax">
                                            <span>0</span><span>200</span>
                                        </div>
                                        <span id="rs-bullet" class="rs-label">0</span>
                                        <input id="rs-range-line" class="rs-range" type="range" value="0" min="0"
                                            max="200">

                                    </div>
                                </div>

                                <!-- range panel end -->

                                <!-- Category panel Start  -->
                                <div class="foorbis-category mt-4">
                                    <label class="w-100">Catégories annonces</label>
                                    <div class="category-btn d-flex align-items-center">
                                        <img src="{{ asset('images/category.png') }}" class="categoryImg" alt="">
                                        <form>
                                            <div class="form-group d-flex mb-0">
                                                <select class="border-0" id="categories_filter"
                                                    name="categories_filter" style="width:auto"
                                                    onchange="getSelectedValue()">
                                                    <option value="" selected disabled hidden>Catégorie</option>
                                                    @foreach ($categories as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="border-0 p-0 bg-white"><img
                                                        src="{{ asset('images/right.png') }}" class="rightImg"
                                                        alt=""></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="displaydiv"></div>
                                </div>
                                <!-- category panel end -->
                            </div>

                        </div>
                    </div>
                    <!-- foorbis nav tab end -->

                    <!-- ANNOUNCES Panel Start  -->
                    <div class="announce_div"></div>
                    <!-- ANNOUNCES Panel End  -->

                </div>
                <!-- foorbis-penal-left ENd -->
                <!-- foorbis-penal-right start -->
                <div class="foorbis-penal-right">
                    <div id="announceCreateDiv">
                        <x-pro-user.create-announce :companyAdvertisement="$companyAdvertisement" />
                    </div>
                </div>
                <!-- foorbis-penal-right ENd -->
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                var page = 1;
                filterAnnounce();
                $(document).on('click', '.btn-myfav', function(e) {
                    $('.btn-myfav').removeClass('active');
                    $('#pills-tabContent').addClass('d-none');
                    $.ajax({
                        url: "{{ route('fav-announces') }}",
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: 'json',
                        success: function(response) {
                            $(".announce_div").html(response.data);
                        },
                    })
                });
                $(document).on('click', '.btn-filter', function(e) {
                    $('.btn-filter').addClass('active');
                    $('#pills-tabContent').removeClass('d-none');
                    filterAnnounce();
                });
                $(document).on('keyup', '#search_filter', function(e) {
                    filterAnnounce();
                });
                $(document).on('click', '.updateAdDetail', function(e) {
                    var id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('get-ad') }}",
                        type: 'GET',
                        data: {
                            'id': id,
                            'is_view': 1
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.key == 1) {
                                $("#announceCreateDiv").html(response.data.html);
                            } else {
                                $.each(response.message, function(i, val) {
                                    $('.error-' + i).text(val);
                                });
                            }
                        },
                    })
                });
            });

            function getSelectedValue() {
                var e = document.getElementById("categories_filter");
                var choiceValue = e.value; // to get value only
                var choicetext = e.options[e.selectedIndex].text;
                // alert(id + " " + choicetext);
                var newDiv = document.createElement('span');
                newDiv.setAttribute("class", "col-items catName");
                newDiv.setAttribute("id", choiceValue);
                newDiv.innerHTML = choicetext + " ";
                var spanDiv = document.createElement('i');
                spanDiv.setAttribute("class", "fas fa-times-circle");
                spanDiv.setAttribute("onclick", 'closeDiv(this)');
                //clsbtn.appendChild(spanDiv)
                newDiv.appendChild(spanDiv);
                var displaydiv = document.getElementById('displaydiv');
                displaydiv.appendChild(newDiv);

                filterAnnounce();
            }

            function closeDiv(x) {
                var parentDiv = x.parentNode.parentNode;
                parentDiv.removeChild(x.parentNode);
                filterAnnounce();
            }
            function filterAnnounce() {
                var categories = $(".catName").map(function() {
                    return this.id;
                }).get()
                var search_filter = $('#search_filter').val();
                $.ajax({
                    url: "{{ route('filter-announces') }}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'search_filter': search_filter,
                        'categories': categories,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $(".announce_div").html(response.data);
                    },
                })
            }
        </script>
    @endpush
</x-frontend.layout>
