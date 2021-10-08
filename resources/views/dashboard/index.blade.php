<x-frontend.layout>
    <div class="foorbis-penal scrollbar" id="foorbis-penal">

        <div class="foorbis-penal-all scrollbar">
            <div class="row">
                <!-- foorbis-penal-left Start  -->
                <div class="foorbis-penal-left">
                    <div class="foorbis-switch">
                        <h5>
                            MES ANNOUNCES
                        </h5>
                        <div class="btnbox">
                            <div id="announces" class="btn notactive">
                                Announces
                            </div>
                            <div id="mes" class="btn active">
                                Mes announces
                            </div>
                        </div>
                    </div>


                    <!-- Search panel Start -->
                    <div class="foorbis-search">
                        <div class="searchbox">
                            <img class="searchImg" src="images/search.png" alt="">
                            <input type="text" placeholder="Recherche " class="searchField">
                        </div>
                        <div class="btn" id="createBtn1">
                            <img class="plusImg" src="images/plus-round.png" alt="">
                            Créer une Annonces
                        </div>
                    </div>
                    <!-- search panel End -->

                    <hr>

                    <a href="" class="nav-link foorbis-btn filter">
                        Filter
                    </a>

                    <!-- Category panel Start  -->
                    <div class="foorbis-category">
                        <label>
                            Categories announces
                        </label>
                        <br>
                        <div class=" category-btn">
                            <img src="images/category.png" class="categoryImg" alt="">
                            <select name="cars" id="category-select">
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                                {{-- <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option> --}}
                            </select>
                            <img src="images/right.png" class="rightImg" alt="">
                        </div>
                        <div class="selectedCategories">
                            @foreach ($companyData->companyCategory as $id => $category)
                            <div class="category" id="{{ $category->category->id }}">
                                {{ $category->category->title }}
                                <img src="images/remove.png" class="removeImg" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- category panel end -->

                    <!-- ANNOUNCES Panel Start  -->
                    <div class="foorbis-announces">
                        <label>
                            {{ count($companyData->companyAdvertisement) }} Announces
                        </label>
                        <br>
                        <hr>

                        <div class="cards scrollbar">
                            @foreach ($companyData->companyAdvertisement as $ads)
                            <div class="card updateAd" data-id="{{ $ads->id }}">
                                <div class="upr">
                                    <img src="{{ $ads->attachment_path ?? 'images/card1.png' }}" alt="">
                                </div>
                                <div class="lower">
                                    <h4>{{ $ads->name }}</h4>
                                    <h5>{{ $ads->description }}</h5>
                                    <h6>{{ $ads->start_date ? date('Y-m-d', strtotime($ads->start_date)) : null }}
                                    </h6>
                                </div>
                            </div>
                            @endforeach

                            <div class="add-card" id="createBtn2">
                                <img src="images/plusCard.png" class="plusCard" alt="">
                                <p>
                                    Nouvelle
                                    annonce
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- ANNOUNCES Panel End  -->
                </div>
                <!-- foorbis-penal-left ENd -->


                <!-- foorbis-penal-right start -->
                <div class="foorbis-penal-right">
                    <div class="card">
                        <div class="upr">
                            <img src="images/card1.png" alt="">
                        </div>
                        <div class="lower">
                            <div class="header">
                                <div class="first">
                                    <img src="images/logo.png" alt="">
                                </div>
                                <div class="second">
                                    <h5 class="company_name">-</h5>
                                    <p>
                                        <img src="images/location2.png" alt="">
                                        <span class="company_address"></span>
                                    </p>
                                </div>
                                <div class="label">
                                    Ouvert
                                </div>
                            </div>
                            <hr>
                            <div class="content">
                                <h4 class="adTitle">
                                    Titre de l'annonce
                                </h4>
                                <h6 class="category_name">
                                    Catégorie annonce
                                </h6>
                                <p class="adDesc">-</p>
                                <div class="btnbox">
                                    <a href="" class="foorbis-btn">Mettre à jour</a>
                                </div>
                            </div>
                        </div>
                        <div class="cardFooter">
                            <div class="btnbox">
                                <a href="">
                                    <img src="images/share.png" alt="">
                                    Partager
                                </a>
                            </div>
                            <div class="social">
                                <div class="box fb">
                                    <a href="">
                                        <img src="images/fb.png" alt="">
                                    </a>
                                    12
                                </div>
                                <div class="box insta">
                                    <a href="">
                                        <img src="images/insta.png" alt="">
                                    </a>
                                    15
                                </div>
                                <div class="box twitter">
                                    <a href="">
                                        <img src="images/twiter.png" alt="">
                                    </a>
                                    24
                                </div>
                                <div class="box linkedin">
                                    <a href="">
                                        <img src="images/linkdin.png" alt="">
                                    </a>
                                    35
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- foorbis-penal-right ENd -->
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function() {
                $(document).on('click', '.category', function(e) {
                    var id = $(this).attr('id');
                    var div = this;
                    $.ajax({
                        url: "{{ route('remove-category') }}",
                        type: 'POST',
                        data: {
                            'id': id
                        },
                        dataType: 'json',
                        // processData: false,
                        // contentType: false,
                        success: function(response) {
                            console.log(response.message);
                            if (response.key == 1) {
                                toastr.success(response.message);
                                div.remove();
                            } else {
                                $.each(response.message, function(i, val) {
                                    $('.error-' + i).text(val);
                                });
                            }
                        },
                    })
                });
                $(document).on('click', '.updateAd', function(e) {
                    var id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('get-ad') }}",
                        type: 'GET',
                        data: {
                            'id': id
                        },
                        dataType: 'json',
                        // processData: false,
                        // contentType: false,
                        success: function(response) {
                            console.log(response.message);
                            if (response.key == 1) {
                                $('.company_name').text(response.data.company.name);
                                $('.company_address').text(response.data.company.address);
                                $('.category_name').text(response.data.category.title);
                                $('.adTitle').text(response.data.name);
                                $('.adDesc').text(response.data.description);
                            } else {
                                $.each(response.message, function(i, val) {
                                    $('.error-' + i).text(val);
                                });
                            }
                        },
                    })
                });
            });
    </script>
    @endpush
</x-frontend.layout>
