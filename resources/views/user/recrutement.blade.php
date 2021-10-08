<x-frontend.layout>
    @push('styles')
        <style>
            p.error {
                color: red;
            }

            .d-none {
                display: none;
            }

        </style>
    @endpush
    <div class="foorbis-penal scrollbar" id="foorbis-penal">

        <div class="foorbis-penal-all ">
            <div class="row">
                <!-- foorbis-penal-left Start  -->
                <div class="foorbis-penal-left pt-5">
                    <!-- Mes offres d'emploi start -->
                    <div class="foorbis-intitule-box">
                        <!-- active-button-col -->
                        <div class="foorbis-btn-group-col">
                            <a class="foorbis-btn cadidate-btn">Candidat</a>
                            <a class="foorbis-btn-active foorbis-btn mr-0 recruiter-btn">Recruteur</a>
                        </div>
                        <!-- Créer une offre d'emploi-button -->
                        @if (Auth::user()->hasRole('pro-user'))
                            <a class="nav-link foorbis-btn creare-offre-btn d-none">
                                <img src="{{ asset('images/plus-round.png') }}" class="mr-4">Créer une offre
                                d'emploi
                            </a>
                        @endif
                        <!-- intitule-post-list -->
                        <div class="offers-list"></div>
                    </div>
                    <!-- Mes offres d'emploiend -->
                </div>
                <!-- foorbis-penal-left ENd -->


                <!-- foorbis-penal-right start -->
                <div class="foorbis-penal-right">


                    <!-- filter reserach start -->
                    <div class="filter-research back-white mb-5 Rechercher-panal">
                        <!-- title start -->
                        <div class="fr-title mb-3">
                            <h5>Recherche</h5>
                            <button class="send-message-btn refresh-btn"
                                onclick="$('#frmFilterJobOffer')[0].reset(); $('.rechercher-btn').trigger('click')"><img
                                    src="{{ asset('images/refresher.png') }}" class="mr-2">Refresh</button>
                        </div>
                        <!-- title end -->
                        <form enctype="multipart/form-data" id="frmFilterJobOffer" method="post">
                            @csrf
                            <!--Recherche-input -->
                            <div class="form-input icon-input">
                                <input type="text" id="jobName" name="jobName" placeholder="Poste"
                                    class="icon-input">
                                <span><img src="{{ asset('images/search.png') }}" alt=""></span>
                            </div>
                            <div class="form-input icon-input">
                                <input type="text" name="jobLocation" id="jobLocation" placeholder="où ?"
                                    class="icon-input">
                                <span><img src="{{ asset('images/Rechercher-location.png') }}" alt=""></span>
                            </div>
                            <div class="form-input icon-input date-publication">
                                <input type="date" id="jobDate" name="jobDate" placeholder="Date de publication"
                                    class="icon-input">
                                <span><img src="{{ asset('images/Rechercher-date.png') }}" alt=""></span>
                            </div>
                            <!--Recherche-input end -->
                            <hr>
                            <!-- contrat-check -->
                            <div class="contrat-check">
                                <p class="contrat-check-title">Contrat</p>
                                <div class="checkbox-Raison checkbox">
                                    <input type="checkbox" id="CDI" name="contract_type[]" value="CDI">
                                    <label for="CDI"> <span class="responsive-text">CDI</span></label><br>
                                </div>
                                {{-- 'CDI','CSD','Provider','Internship','Alternating' --}}
                                <div class="checkbox-Raison checkbox">
                                    <input type="checkbox" id="Alternance" name="contract_type[]" value="Alternating">
                                    <label for="Alternance"> <span class="responsive-text">Alternance</span></label><br>
                                </div>
                                <div class="checkbox-Raison checkbox">
                                    <input type="checkbox" id="CSD" name="contract_type[]" value="CSD">
                                    <label for="CSD"> <span class="responsive-text">CSD</span></label><br>
                                </div>
                                <div class="checkbox-Raison checkbox">
                                    <input type="checkbox" id="Internship" name="contract_type[]" value="Internship">
                                    <label for="Internship"> <span class="responsive-text">Stage</span></label><br>
                                </div>
                                <div class="checkbox-Raison checkbox">
                                    <input type="checkbox" id="Provider" name="contract_type[]" value="Provider">
                                    <label for="Provider"> <span class="responsive-text">Prestataire</span></label><br>
                                </div>
                            </div>
                            <!-- end-contrat-check -->
                            <hr>
                            <!-- rythme-check -->
                            <div class="contrat-check rythme-check">
                                <p class="contrat-check-title">Rythme</p>
                                <div class="checkbox-Raison checkbox">
                                    <input type="checkbox" id="face_to_face" name="pace[]" value="face_to_face">
                                    <label for="face_to_face"> <span
                                            class="responsive-text">Présentiel</span></label><br>
                                </div>
                                <div class="checkbox-Raison checkbox">
                                    <input type="checkbox" id="partial_teleworking" name="pace[]"
                                        value="partial_teleworking">
                                    <label for="partial_teleworking"> <span class="responsive-text">Télétravail
                                            partiel</span></label><br>
                                </div>
                                <div class="checkbox-Raison checkbox">
                                    <input type="checkbox" id="telecomputing" name="pace[]" value="telecomputing">
                                    <label for="telecomputing"> <span
                                            class="responsive-text">Télétravail</span></label><br>
                                </div>
                            </div>
                            <!-- end-rythme-check -->
                            <div class="btnbox text-center my-5">
                                <button type="submit" class="foorbis-btn rechercher-btn"><img
                                        src="{{ asset('images/search-white.png') }}"
                                        class="mr-3">Rechercher</button>
                            </div>
                        </form>
                    </div>
                    <!-- filter reserach end -->
                </div>
                <!-- foorbis-penal-right ENd -->
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            var page = 1;
            var type = 'candidate';
            $(document).ready(function() {
                filterOffers();
                $(document).on('click', '.cadidate-btn', function(e) {
                    type = 'candidate';
                    filterOffers();
                    $('.foorbis-btn').toggleClass('foorbis-btn-active');
                    $('.creare-offre-btn').addClass('d-none');
                });
                $(document).on('click', '.recruiter-btn', function(e) {
                    type = 'recruitment';
                    filterOffers();
                    $('.foorbis-btn').toggleClass('foorbis-btn-active');
                    $('.creare-offre-btn').removeClass('d-none');
                });
                $(document).on('click', '.creare-offre-btn', function(e) {
                    $.ajax({
                        url: "{{ route('create-job-offer') }}",
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            $(".offers-list").html(response.data);
                            // validateCreateJobForm();
                        },
                    })
                });
                $(document).on('click', '.btn-setting', function(e) {
                    let id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('create-job-offer') }}",
                        type: 'GET',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            $(".offers-list").html(response.data);
                            // validateCreateJobForm();
                        },
                    })
                });
                $(document).on('click', '.btn-apply', function(e) {
                    var id = $(this).data('id')
                    var action = $(this).data('action')
                    $.ajax({
                        url: "{{ route('job-apply') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            action: action,
                        },
                        dataType: 'json',
                        success: function(response) {
                            $(".offers-list").html(response.data);
                            // validateJobApplyForm();
                        },
                    })
                });
                $(document).on('click', '.btn-remove', function(e) {
                    var id = $(this).data('id')
                    $.ajax({
                        url: "{{ route('job-delete') }}",
                        type: 'POST',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            toastr.success(response.message);
                            if (response.key == 1) {
                                filterOffers();
                            }
                        },
                    })
                });
                $(document).on('keyup', '#search_filter', function(e) {
                    filterOffers();
                });
                $(document).on('submit', '#frmFilterJobOffer', function(form) {
                    form.preventDefault();
                    filterOffers();
                });
                $(document).on('submit', '#frmAddJobOffer', function(form) {
                    form.preventDefault();
                    $('.error').html('');
                    var formData = new FormData($('#frmAddJobOffer')[0]);
                    $.ajax({
                        url: "{{ route('save-job-offer') }}",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            toastr.success(response.message);
                            if (response.key == 1) {
                                filterOffers();
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
                $(document).on('submit', '#frmApplyJob', function(form) {
                    form.preventDefault();
                    $('.error').html('');
                    var formData = new FormData($('#frmApplyJob')[0]);
                    $.ajax({
                        url: "{{ route('save-job-application') }}",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            toastr.success(response.message);
                            if (response.key == 1) {
                                filterOffers();
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

            function validateCreateJobForm() {
                $('#frmAddJobOffer').validate({
                    rules: {
                        name: 'required',
                        address_line_1: 'required',
                        address_line_2: "required",
                        city: "required",
                        postalcode: {
                            required: true,
                            number: true,
                            minlength: 6,
                            maxlength: 6,
                        },
                        contract_type: "required",
                        pace: "required",
                        publication_date: "required",
                        description: "required",
                        presentation: "required",
                        profile_sought: "required",
                    }
                });
            }

            function validateJobApplyForm() {
                $('#frmApplyJob').validate({
                    rules: {
                        first_name: 'required',
                        last_name: 'required',
                        address_line_1: 'required',
                        address_line_2: "required",
                        city: "required",
                        postalcode: {
                            required: true,
                            number: true,
                            minlength: 6,
                            maxlength: 6,
                        },
                        cv: "required",
                        cover_letter: "required",
                    }
                });
            }

            function filterOffers() {
                var categories = $(".catName").map(function() {
                    return this.id;
                }).get()
                var formData = new FormData($('#frmFilterJobOffer')[0]);
                formData.append('type', type);
                $.ajax({
                    url: "{{ route('filter-offers') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".offers-list").html(`<div class="loader"></div>`);
                    },
                    complete: function() {
                        $('.loader').hide();
                    },
                    success: function(response) {
                        $(".offers-list").html(response.data);
                    },
                })
            }
        </script>
    @endpush
</x-frontend.layout>
