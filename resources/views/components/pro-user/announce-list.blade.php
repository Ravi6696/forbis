<div>
    <div class="foorbis-announces">
        <label>
            {{ count($companyAdvertisement) }} Announces
        </label>
        <br>
        <hr>
        <div class="cards scrollbar">
            @foreach ($companyAdvertisement as $ads)
                <div class="card updateAdDetail" data-id="{{ $ads->id }}">
                    <div class="upr">
                        <img src="{{ $ads->attachment_path ?? 'images/card1.png' }}" alt="">
                    </div>
                    <div class="lower">
                        <h3>{{ $ads->name }}</h3>
                        <h4>{{ $ads->category->title ?? '-' }}</h4>
                        <h5>{{ $ads->description }}</h5>
                        <h6>{{ $ads->start_date ? date('Y-m-d', strtotime($ads->start_date)) : null }}
                        </h6>
                        @if (Auth::user()->hasRole('pro-user'))
                            <button data-id="{{ $ads->id }}" class="card-btn" data-toggle="modal"
                                data-target="#Ne-pas-renouveler">Ne pas renouveler</button>
                        @endif
                    </div>
                </div>
            @endforeach
            <div id="createAnnounce">
            @if (Auth::user()->hasRole('pro-user'))
                <div class="add-card createAd plusCard" id="createBtn2" data-toggle="modal"
                    data-target="#createAnnounceModal">
                    <img src="{{ asset('images/plusCard.png') }}" alt="">
                    <p>
                        Nouvelle
                        annonce
                    </p>
                </div>
            @endif
            </div>
        </div>
    </div>
    @if (Auth::user()->hasRole('pro-user'))
        <div class="createPopup modal fade slider-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" id="createAnnounceModal">
            <div class="card modal-dialog modal-lg scrollbar">
                <div class="modal-content">
                    <!-- modal-body -->
                    <div class="modal-body">
                        <!-- popup-header -->
                        <div class="header">
                            <p> Ne pas renouveler</p>
                            <img src="{{ asset('images/close-icon.png') }}" class="closePopup" alt=""
                                type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </div>
                        <hr>
                        <!-- heder-end -->
                        <div class="row">
                            <div class="col-12">
                                <p class="detail">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus libero ut
                                    lectus porta gravida. Nunc
                                    sit amet tellus imperdiet, dapibus nunc eu, vestibulum quam. Aliquam et tincidunt
                                    sem. Duis molestie
                                    congue ante sed porta. Fusce mauris
                                    felis, malesuada ut sagittis ut, vulputate sed metus. Phasellus sem magna, tristique
                                    ut leo at, dapibus
                                    rhoncus arcu. Fusce ultricies
                                    varius congue. Aliquam quis varius mauris. Suspendisse id placerat justo, commodo
                                    pellentesque massa.
                                </p>

                                <div class="date">
                                    <div class="left">
                                        <p>
                                            Nouvelle annonce : <span> numéro
                                                {{ sprintf('%02d', (Auth::user()->company->companyAdvertisement->count() ?? 0) + 1) }}</span>
                                        </p>
                                    </div>
                                    <div class="right">
                                        <p>
                                            Date de création | Prochain renouvellement
                                        </p>
                                    </div>
                                </div>

                                <div class="transaction">
                                    <div class="left">
                                        <p class="title">
                                            VOTRE SOLDE ACTUEL
                                        </p>
                                        <p class="amount">
                                            {{ Auth::user()->company->companyAdvertisement->sum('ad_amount') ?? 0 }}
                                            EURO
                                        </p>
                                    </div>
                                    <div class="center">
                                        <img src="{{ asset('images/right-aero.png') }}" alt="">
                                    </div>
                                    <div class="right">
                                        <p class="title">
                                            VOTRE NOUVEAU SOLDE
                                        </p>
                                        <p class="amount">
                                            {{ (Auth::user()->company->companyAdvertisement->sum('ad_amount') ?? 0) + Auth::user()->company->ad_amount }}
                                            EURO
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="methods">
                                    <p class="left">
                                        Moyens de paiement
                                    </p>
                                    <div class="right">
                                        <img src="{{ asset('images/plus_Purple.png') }}" alt="">
                                        <a class="text-primary"
                                            onclick="$('#stripePayment').removeClass('hidden'); $('#stripePayment')[0].reset(); $('#card_id').val(''); $('.error').html('')">Ajouter
                                            un
                                            nouveau</a>
                                    </div>
                                </div>
                                <div class="card-list" id="card_list">
                                    @foreach (Auth::user()->cardDetails as $item)
                                        <div class="masterCard-item-check">
                                            <div class="checkbox-Raison checkbox">
                                                <input type="checkbox" id="masterCard-check{{ $item->id }}"
                                                    class="mr-2 card-check" value="{{ $item->id }}">
                                                <label for="masterCard-check{{ $item->id }}"></label>
                                            </div>

                                            <div class="masterCard">
                                                <div class="image">
                                                    <img src="{{ asset('images/mastercard.png') }}" alt="">
                                                </div>
                                                <div class="number">
                                                    <p>
                                                        Se terminant par ... {{ substr($item->card_number, -4) }}
                                                    </p>
                                                </div>
                                                <div class="expiry">
                                                    <p>
                                                        Expire le {{ $item->expires_on }}
                                                    </p>
                                                </div>
                                                <div class="name">
                                                    <p class="mb-0 text-primary update-card" id="updateCard"
                                                        onclick="$('#stripePayment').removeClass('hidden'); $('.error').html('')"
                                                        data-id="{{ $item->id }}"> metter a jour</p>
                                                </div>
                                                <div class="status">
                                                    <p class="mb-0 text-primary delete-card"
                                                        data-id="{{ $item->id }}">
                                                        Suppimer</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="card-from">
                                    <form role="form" id="stripePayment" class="stripePayment hidden">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-5 mb-3">
                                                <div>
                                                    <input class="card_id" type="hidden" name="card_id"
                                                        id="card_id" placeholder="Numero de carte">
                                                    <input class="card_number" type="number" name="card_number"
                                                        id="card_number" placeholder="Numero de carte" maxlength="16">
                                                    <p class="error mt-2" id="error_card_number"></p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <img src="{{ asset('images/mastercard.png') }}" alt="">
                                                <img src="{{ asset('images/mastercard.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <div>
                                                    <input class="card_expiry_month" type="number"
                                                        name="card_expiry_month" id="card_expiry_month"
                                                        placeholder="date d`expiration" maxlength="2">
                                                    <p class="error mt-2" id="error_card_expiry_month"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div>
                                                    <input type="number" class="card_expiry_year"
                                                        name="card_expiry_year" id="card_expiry_year"
                                                        placeholder="date d`expiration" maxlength="4">
                                                    <p class="error mt-2" id="error_card_expiry_year"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div>
                                                    <input type="number" class="card_cvc" name="card_cvc"
                                                        id="card_cvc" placeholder="CVV" maxlength="3">
                                                    <p class="error mt-2" id="error_card_cvc"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mt-3 p-0">
                                            <button type="submit"
                                                class="border-0 w-full rounded px-3 py-2 bg-main-color d-flex align-items-center justify-content-center">Sauvegarder</button>
                                        </div>
                                        <hr>
                                    </form>

                                </div>
                                <form role="form" class="stripe-payment" data-cc-on-file="false"
                                    data-stripe-publishable-key="{{ config('stripe.stripe_key') }}"
                                    id="stripe-payment">
                                    @csrf
                                    <div class="condition">
                                        <div class="left">
                                            <input type="checkbox" id="conditions">
                                            J'accepte les conditions générales de ventes
                                        </div>
                                        <div class="paymnet-card-info row hidden">
                                            <input class="card-id" type="hidden" name="card_id" id="card_id"
                                                placeholder="Numero de carte">
                                            <input type="hidden" name="company_id" id="company_id"
                                                value="{{ Auth::user()->company->id }}">
                                            <input type="number" class="required card-num text-field card_number"
                                                id="card_number" name="card_number" placeholder="Numero de carte"
                                                class="___class_+?3___" maxlength="16" value="">
                                            <input type="number" name="card_expiry_month" id="card_expiry_month"
                                                class="required card-expiry-month card_expiry_month text-field w-100"
                                                placeholder="date d expiration" maxlength="2" value="">
                                            <input type="number" name="card_expiry_year"
                                                wire:model.defer="card_expiry_year"
                                                class="required card-expiry-year card_expiry_year text-field w-100"
                                                placeholder="date d expiration" maxlength="4" value="">
                                            <input type="text" name="card_cvc" id="card_cvc"
                                                class="required card-cvc card_cvc text-field w-100" placeholder="CVV"
                                                maxlength="3" value="">
                                        </div>
                                        <div class="hidden error">
                                            <i class='fas fa-exclamation-circle alert'>
                                                <p>Fix the errors before you begin.</p>
                                            </i>
                                        </div>
                                        <div class="right">
                                            <button type="submit" class="foorbis-btn submitBtn payAdAmount">
                                                Commander
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- modal-body -->
                </div>
            </div>
        </div>

        <!-- popup-2 #Ne-pas-renouveler-->
        <div class="createPopup modal fade slider-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" id="Ne-pas-renouveler">
            <div class="card modal-dialog modal-lg scrollbar">
                <div class="modal-content">
                    <!-- modal-body -->
                    <div class="modal-body">
                        <!-- popup-header -->
                        <div class="header">
                            <p> Ne pas renouveler</p>
                            <img src="{{ asset('images/close-icon.png') }}" class="closePopup" alt=""
                                type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </div>
                        <hr>
                        <!-- heder-end -->
                        <div class="row">
                            <!-- left -->
                            <div class="col-lg-7 col-12 pr-col-5">
                                <p class="detail">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus libero ut
                                    lectus porta gravida. Nunc
                                    sit amet tellus imperdiet, dapibus nunc eu, vestibulum quam. Aliquam et tincidunt
                                    sem. Duis molestie
                                    congue ante sed porta. Fusce mauris
                                    felis, malesuada ut sagittis ut, vulputate sed metus. Phasellus sem magna, tristique
                                    ut leo at, dapibus
                                    rhoncus arcu. Fusce ultricies
                                    varius congue. Aliquam quis varius mauris. Suspendisse id placerat justo, commodo
                                    pellentesque massa.
                                </p>
                                <div class="transaction">
                                    <div class="left">
                                        <p class="title">
                                            VOTRE SOLDE ACTUEL
                                        </p>
                                        <p class="totalAdAmount">
                                            {{ Auth::user()->company->companyAdvertisement->sum('ad_amount') ?? 0 }}
                                            EURO
                                        </p>
                                    </div>
                                    <div class="center">
                                        <img src="{{ asset('images/right-aero.png') }}" alt="">
                                    </div>
                                    <div class="right">
                                        <p class="title">
                                            VOTRE NOUVEAU SOLDE
                                        </p>
                                        <p class="newAdAmount">
                                            {{ (Auth::user()->company->companyAdvertisement->sum('ad_amount') ?? 0) - Auth::user()->company->ad_amount }}
                                            EURO
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <form id="frmRemoveAd" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <input type="hidden" name="company_id" id="company_id"
                                        value="{{ auth()->user()->company->id ?? null }}">
                                    <input type="hidden" name="announceid" id="announceid" value=" ">
                                    <div class="check-pourquoi">
                                        <p>Pourquoi vous ne renouvelez pas votre annonce</p>
                                        <div class="">
                                        <input type=" checkbox"
                                            name="reason[]" id="reason_1" value="reason_1">
                                            <label for="Autres">
                                                <span class="responsive-text"> Reason 1 </span>
                                            </label>
                                        </div>
                                        <div class="">
                                        <input type=" checkbox"
                                            name="reason[]" id="reason_1" value="reason_2"><label for="Autres">
                                                <span class="responsive-text"> Reason 2
                                                </span></label>
                                        </div>
                                        <div class="">
                                        <input type=" checkbox"
                                            name="reason[]" id="reason_1" value="reason_3"><label for="Autres">
                                                <span class="responsive-text"> Reason 3
                                                </span></label>
                                        </div>
                                        <div class="">
                                        <input type=" checkbox"
                                            name="reason[]" id="reason_1" value="reason_4"><label for="Autres">
                                                <span class="responsive-text"> Reason 4
                                                </span></label>
                                        </div>
                                        <div class="">
                                        <input type=" checkbox"
                                            name="reason[]" id="reason_1" value="reason_5"><label for="Autres">
                                                <span class="responsive-text"> Reason 5
                                                </span></label>
                                        </div>
                                        <p class="error" id="error_reason"></p>
                                        {{-- <div class="check-pourquoi">
                                    <p>Pourquoi vous ne renouvelez pas votre annonce</p>
                                    <div class="checkbox-Raison checkbox">
                                        <input type="checkbox" id="1" name="reason[]" value="1">
                                        <label for="Autres"> <span class="responsive-text"> Autres
                                            </span></label><br><br>
                                    </div> --}}
                                    </div>
                                    <div class="">
                                    <button class=" foorbis-btn
                                        poup-sumbit-btn float-right mb-3" type="submit">Ne
                                        pas renouveler</button>
                                    </div>
                                </form>
                            </div>
                            <!-- right -->
                            <div class="col-lg-5 col-12 foorbis-penal-all bg-white popup-right-col">
                                <div class="foorbis-penal-right w-100 p-0">
                                    <div class="card mt-0 announceView">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal-body -->
                </div>
            </div>
        </div>
        <!-- end-popup-2 #Ne-pas-renouveler-->
        @push('scripts')
            <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
            <script type="text/javascript">
                var $form = $(".stripe-payment");
                $(document).ready(function() {
                    getAnnouncesCardList();
                    $(document).on('click', '.updateAdDetail', function(e) {
                        var id = $(this).data('id');
                        $.ajax({
                            url: "{{ route('get-ad') }}",
                            type: 'GET',
                            data: {
                                'id': id,
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
                    // Get Card details on update
                    $(document).on('click', '.card-check', function(e) {
                        var id = $(this).val();
                        $.ajax({
                            url: "{{ route('edit-card') }}",
                            type: 'POST',
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.key == 1) {
                                    var expire = response.data.expires_on;
                                    var expires_on = expire.split('/');
                                    $('.card-id').val(response.data.id);
                                    $('.card-num').val(response.data.card_number);
                                    $('.card-expiry-month').val(expires_on[0]);
                                    $('.card-expiry-year').val(expires_on[1]);
                                    $('.card-cvc').val(response.data.cvv);
                                }
                            },
                        })
                    });
                    $(document).on('click', '.card-btn', function(e) {
                        var id = $(this).data('id');
                        $.ajax({
                            url: "{{ route('get-ad') }}",
                            type: 'GET',
                            data: {
                                'id': id,
                                'is_view': true
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.key == 1) {
                                    $(".announceView").html(response.data.html);
                                    $('.detail').html(response.data.data.description);
                                    $('#announceid').val(id);
                                } else {
                                    $.each(response.message, function(i, val) {
                                        $('.error-' + i).text(val);
                                    });
                                }
                            },
                        })
                    });
                });

                // Remove Advertisment
                $(document).on('submit', '#frmRemoveAd', function(e) {
                    e.preventDefault();
                    var company_id = $('#company_id').val();
                    var formData = new FormData($('#frmRemoveAd')[0]);
                    if (company_id == null || company_id == '') {
                        alert('Please save Comapany Details !!');
                        return false;
                    }
                    formData.append('company_id', company_id);
                    console.log(formData);
                    $.ajax({
                        url: "{{ route('remove-ad') }}",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            toastr.success(response.message);
                            filterAds();
                            $('#Ne-pas-renouveler').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        },
                        error: function(response) {
                            let errors = response.responseJSON.errors;
                            $.each(errors, function(key, val) {
                                $('#error_' + key).html(val)
                            })
                        },
                    })
                });

                // Make Payment
                $(document).on('click', '.payAdAmount', function(form) {
                    form.preventDefault();
                    var $form = $(".stripe-payment"),
                        inputVal = ['input[type=number]',
                            'input[type=text]',
                        ].join(', '),
                        $inputs = $form.find('.required').find(inputVal),
                        $errorStatus = $form.find('div.error'),
                        valid = true;
                    $errorStatus.addClass('hidden');

                    $('.has-error').removeClass('has-error');
                    $inputs.each(function(i, el) {
                        var $input = $(el);
                        if ($input.val() === '') {
                            $input.parent().addClass('has-error');
                            $errorStatus.removeClass('hidden');
                            form.preventDefault();
                        }
                    });

                    if (!$form.data('cc-on-file')) {
                        form.preventDefault();
                        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                        Stripe.createToken({
                            number: $('.card-num').val(),
                            cvc: $('.card-cvc').val(),
                            exp_month: $('.card-expiry-month').val(),
                            exp_year: $('.card-expiry-year').val()
                        }, stripeRes);
                    }
                });

                function stripeRes(status, response) {
                    if (response.error) {
                        console.log(response.error);
                        $('.error')
                            .removeClass('hidden')
                            .find('.alert')
                            .text(response.error.message);
                    } else {
                        var token = response['id'];
                        $form.find('input[type=text]').empty();
                        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                        console.log(token)
                        var formData = new FormData($('#stripe-payment')[0]);
                        $.ajax({
                            url: "{{ route('pay-adamount') }}",
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                $('.loader').show()
                            },
                            complete: function() {
                                $('.loader').hide();
                            },
                            success: function(response) {
                                toastr.success(response.message);
                                if (response.key == 1) {
                                    filterAds();
                                    $('#createAnnounceModal').modal('hide');
                                    $('body').removeClass('modal-open');
                                    $('.modal-backdrop').remove();
                                    $("#announce_div").html(response.data);
                                    $(".saveAnnounce").html('Créer');
                                }
                            },
                        })
                    }
                }

                // Save or Update Card Details
                // Make payment
                // $('#stripePayment').validate({
                //     rules: {
                //         card_number: {
                //             required: true,
                //             minlength: 16,
                //             maxlength: 16
                //         },
                //         card_expiry_month: {
                //             required: true,
                //             min: 1,
                //             max: 12,
                //             minlength: 1,
                //             maxlength: 2
                //         },
                //         card_expiry_year: {
                //             required: true,
                //             minlength: 4,
                //             maxlength: 4
                //         },
                //         card_cvc: {
                //             required: true,
                //             minlength: 3,
                //             maxlength: 3
                //         },
                //     }
                // });
                $(document).on('submit', '#stripePayment', function(form) {
                    form.preventDefault();
                    var formData = new FormData($('#stripePayment')[0]);
                    console.log(formData);
                    $.ajax({
                        url: "{{ route('save-card') }}",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.key == 1) {
                                toastr.success(response.message);
                                getAnnouncesCardList();
                                $('#stripePayment')[0].reset();
                                $('#stripePayment').addClass('hidden');
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

                function getAnnouncesCardList() {
                    $.ajax({
                        url: "{{ route('announces-card') }}",
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.key == 1) {
                                $('#card_list').html(response.data);
                            }
                        }
                    })
                }

                $(document).on('click', '.update-card', function(e) {
                    var id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('edit-card') }}",
                        type: 'POST',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.key == 1) {
                                var expire = response.data.expires_on;
                                var expires_on = expire.split('/');
                                $('#card_id').val(response.data.id);
                                $('#card_number').val(response.data.card_number);
                                $('#card_expiry_month').val(expires_on[0]);
                                $('#card_expiry_year').val(expires_on[1]);
                                $('#card_cvc').val(response.data.cvv);
                            }
                        },
                    })
                });

                $(document).on('click', '.delete-card', function(e) {
                    var id = $(this).data('id');
                    var that = $(this);
                    $.ajax({
                        url: "{{ route('delete-card') }}",
                        type: 'POST',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(response) {
                            toastr.success(response.message);
                            if (response.key == 1) {
                                getAnnouncesCardList()
                                $('#stripePayment')[0].reset();
                            }
                        },
                    })
                });
            </script>
        @endpush
    @endif
</div>
