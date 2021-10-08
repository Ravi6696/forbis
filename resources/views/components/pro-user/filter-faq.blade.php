<div>
    <a href="{{ route('create-forum') }}" class="foorbis-btn d-inline-block mt-3 wr-btn w-100 py-3">Poser une
        question</a>

    <!-- filter reserach start -->
    <div class="filter-research back-white my-5">
        <!-- title start -->
        <div class="fr-title">
            <h5>FIlters researches</h5>
            <button class="send-message-btn refresh-btn"><img src="{{ asset('images/refresher.png') }}"
                    class="mr-2">Refresh</button>
        </div>
        <!-- title end -->

        <!-- form start -->
        <div class="form-input icon-input my-3">
            <input type="text" id="search_filter" value="{{ $search_filter }}" placeholder="Recherche"
                class="icon-input" style="border:none !important;">
            <span><img src="{{ asset('images/search.png') }}" alt=""></span>
        </div>

        <!-- Category panel Start  -->
        <div class="foorbis-category fr-cat">
            <div class="category-btn d-flex align-items-center" style="border:none;">
                <img src="{{ asset('images/category.png') }}" class="categoryImg" alt="">
                <form class="w-100">
                    <div class="form-group d-flex mb-0 justify-content-between w-100">
                        <select class="border-0" id="categories_filter" name="sellist1" style="width:auto">
                            <option value="" selected disabled hidden>Catégorie</option>
                            @foreach ($categories as $id => $name)
                            <option value="{{ $id }}" {{ $category_id == $id ? 'selected' : '' }}>
                                {{ $name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="border-0 p-0"><img src="{{ asset('images/right.png') }}"
                                class="rightImg" alt=""></button>
                    </div>
                </form>
            </div>
            <div id="displaydiv" class=""></div>
        </div>

        <!-- category panel end -->
        <!-- form end -->
    </div>
    <!-- filter reserach end -->

    <!-- mes favoris start -->
    <div class="
                filter-research back-white my-5">
        <!-- title start -->
        <div class="fr-title">
            <h5>Mes Favoris</h5>
            <p class="d-flex favoris-text align-items-center mb-0">
                {{ $myFavourites->count() }} favories
                <img src="{{ asset('images/favoris.png') }}" alt="">
            </p>
        </div>
        <!-- title end -->

        <!-- reserach start -->
        <div class="form-input icon-input my-3">
            <input type="text" placeholder="Recherche" id="filterSearch" class="icon-input">
            <span><img src="{{ asset('images/search.png') }}" alt=""></span>
        </div>
        <!-- reserach end -->

        <!-- mf-content start -->
        <div class="mf-content">
            <div class="mfc-box">
                <div class="row full-entreprises">
                    <div class="fix-height-entreprise scrollbar">
                        @foreach ($myFavourites as $fav)
                        <div class="enterprice-slide">
                            <div class="enterprice-img"><img src="{{ $fav->faq->attachment_url ?? '' }}">
                            </div>
                            <div class="centerprice-col">
                                <a class="entreprise-heading" href="">{{ $fav->faq->question ?? '-' }} :
                                </a>
                                <p class="mfc-colr-text">
                                    Question pose par
                                    <span>{{ $fav->faq->user->full_name ?? '-' }}</span>
                                    le
                                    <span>{{ $fav->faq->created_at->diffForHumans() ?? '-' }}</span>
                                    a
                                    <span>{{ $fav->faq->user->address->city ?? '-' }}</span>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <!-- mf-content end -->


    </div>
    <!-- mes favoris end -->

</div>
<!-- foorbis-penal-right ENd -->
</div>
</div>
