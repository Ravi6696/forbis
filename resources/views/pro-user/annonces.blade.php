<x-frontend.layout>
    @push('styles')
    <style>
        .btn-submit {
            text-align: right;
            margin-top: 30px;
        }
        .error {
            color: red;
        }

        .hidden {
            display: none;
        }

        .alert {
            font-size: 25px;
            color: rgb(253, 13, 13)
        }
    </style>
    @endpush
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
                            <div id="announces" class="btn btnAnnounce notactive">
                                Announces
                            </div>
                            <div id="mes" class="btn btnAnnounce active">
                                Mes announces
                            </div>
                        </div>
                    </div>

                    <!-- Search panel Start -->
                    <div class="foorbis-search">
                        <div class="searchbox">
                            <img class="searchImg" src="{{ asset('images/search.png') }}" alt="">
                            <input type="text" id="search_filter" name="search_filter" placeholder="Recherche "
                                class="searchField">
                        </div>
                        <div class="btn" id="createBtn1" data-toggle="modal" data-target="#createPopup">
                            <img class="plusImg" src="{{ asset('images/plus-round.png') }}" alt="">
                            Créer une Annonces
                        </div>
                    </div>
                    <!-- search panel End -->

                    <hr>
                    
                    <button class="nav-link foorbis-btn filter">
                        Filter
                    </button>

                    <!-- Category panel Start  -->
                    <div class="foorbis-category">
                        <label class="w-100">Catégories annonces</label>
                        <div class="category-btn d-flex align-items-center">
                            <img src="{{ asset('images/category.png') }}" class="categoryImg" alt="">
                            <form>
                                <div class="form-group d-flex mb-0" onchange="getSelectedValue()">
                                    <select class="border-0" id="sel1" name="sellist1" style="width:auto">
                                        <option value="" selected disabled hidden>Catégorie</option>
                                        @foreach ($categories as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="border-0 p-0 bg-white"><img
                                            src="{{ asset('images/right.png') }}" class="rightImg" alt=""></button>
                                </div>
                            </form>
                        </div>
                        <div id="displaydiv"></div>
                    </div>

                    <!-- category panel end -->

                    <!-- ANNOUNCES Panel Start  -->
                    <div id="announce_div">
                        <x-pro-user.announce-list :companyAdvertisement="$companyAdvertisement" />
                    </div>
                    <!-- ANNOUNCES Panel End  -->
                </div>
                <!-- foorbis-penal-left ENd -->


                <!-- foorbis-penal-right start -->
                <div class="foorbis-penal-right">
                    <div id="announceCreateDiv">
                        <x-pro-user.create-announce :companyAdvertisement="$companyAdvertisement->last()" />
                    </div>
                </div>
                <!-- foorbis-penal-right ENd -->
            </div>
        </div>
    </div>
    @push('scripts')
    <!-- multipal-menu design-js -->
    <script>
        var search_filter = null;
        var categories = null;

        $('#frmAddAd').validate({
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

        function getSelectedValue() {
            var e = document.getElementById("sel1");
            var choiceValue = e.value; // to get value only
            var choicetext = e.options[e.selectedIndex].text;
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
            displaydiv.appendChild(newDiv)
            filterAds();
        }

        function closeDiv(x) {
            var parentDiv = x.parentNode.parentNode;
            parentDiv.removeChild(x.parentNode);
            filterAds();
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#MesAnnonces-img')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('keyup', '#search_filter', function(e) {
            filterAds();
        });

        // function filterAds() {
        //     var search_filter = $('#search_filter').val();
        //     var categories = $(".catName").map(function() {
        //         return this.id;
        //     }).get();
        //     $.ajax({
        //         url: "{{ route('filter-by-category') }}",
        //         type: 'POST',
        //         data: {
        //             'search_filter': search_filter,
        //             'categories': categories,
        //             'company_id': '{{ $companyData->id }}'
        //         },
        //         success: function(response) {
        //             $("#announce_div").html(response);
        //         },
        //     })
        // }

        $(document).ready(function() {

            filterAds();
            $(document).on('click', '.createAd', function() {
                $('#createPopup').modal('show');
            });
            $(document).on('click', '.btnAnnounce', function() {
                var type = $(this).attr('id');
                $('.btnAnnounce').not(this).toggleClass("noactive active");
                $(this).toggleClass('active noactive');
                if (type == 'announces') {
                    $.ajax({
                        url: "{{ route('pro.filter-announces') }}",
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: 'json',
                        success: function(response) {
                            $("#announce_div").html(response.data);
                        },
                    })
                } else {
                    filterAds();
                }
            });
            $(document).on('click', '.filter', function() {
                $(".foorbis-category").toggle();
            });

            $(document).on('submit', '#frmAddAd', function(form) {
                form.preventDefault();
                var formData = new FormData($('#frmAddAd')[0]);
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
                            // filterAds()
                            location.reload();
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
        });
    </script>
    @endpush
</x-frontend.layout>
