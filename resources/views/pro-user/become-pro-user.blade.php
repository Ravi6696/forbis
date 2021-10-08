<x-frontend.layout>
    @push('styles')
        <style>
            .error {
                color: red;
            }

            .hidden {
                display: none;
            }

            .alert{
                font-size:25px;
                color:rgb(253, 13, 13)
            }

        </style>
    @endpush
    <div class="foorbis-penal scrollbar">
        <div class="foorbis-penal-all scrollbar">
            <section class="become-cols">
                <div class="become-pro-item ">
                    <!-- title -->
                    <p class="become-title">
                        <span>PASSER A LA VERSION PRO</span>
                        <i class="fas fa-times"></i>
                    </p>
                    <!-- step-ul -->
                    <div class="steps">
                        <ul>
                            <li>
                                <span>1</span>
                            </li>
                            <li>
                                <span>2</span>
                            </li>
                            <li>
                                <span>3</span>
                            </li>
                        </ul>
                    </div>
                    <!-- step-ul-end -->
                    <div class="myContainer">
                        <!-- step-1 -->
                        <div class="become-container animated active">
                            <!-- information-step-1 -->
                            <div class="information-step-height scrollbar">
                                <div class="become-col-section">
                                    <h6>PASSER A LA VERSION PRO</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus libero ut
                                        lectus porta gravida. Nunc sit amet tellus imperdiet, dapibus nunc eu,
                                        vestibulum quam. Aliquam et tincidunt sem. Duis molestie congue ante sed porta.
                                        Fusce mauris felis, malesuada ut sagittis ut, vulputate sed metus. Phasellus sem
                                        magna, tristique ut leo at, dapibus rhoncus arcu. Fusce ultricies varius congue.
                                        Aliquam quis varius mauris. Suspendisse id placerat justo, commodo pellentesque
                                        massa.</p>
                                </div>

                                <div class="become-col-section">
                                    <!-- col-1 -->
                                    <div class="become-row">
                                        <div class="left-icon mr-3"><img
                                                src="{{ asset('images/Dashbord-become.png') }}"></div>
                                        <div class="right-icon-info">
                                            <h5>Dashbord</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus
                                                libero ut lectus porta gravida. Nunc sit amet tellus imperdiet, dapibus
                                                nunc eu, vestibulum quam. Aliquam et tincidunt sem. Duis molestie congue
                                                ante sed porta. Fusce mauris felis, malesuada ut sagittis ut, vulputate
                                                sed metus. Phasellus sem magna, tristique ut leo at, dapibus rhoncus
                                                arcu. Fusce ultricies varius congue. Aliquam quis varius mauris.
                                                Suspendisse id placerat justo, commodo pellentesque massa.</p>
                                        </div>
                                    </div>
                                    <!-- col-2 -->
                                    <div class="become-row">
                                        <div class="left-icon mr-3"><img
                                                src="{{ asset('images/message-becon-icon.png') }}"></div>
                                        <div class="right-icon-info">
                                            <h5>Vos annonces</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus
                                                libero ut lectus porta gravida. Nunc sit amet tellus imperdiet, dapibus
                                                nunc eu, vestibulum quam. Aliquam et tincidunt sem. Duis molestie congue
                                                ante sed porta. Fusce mauris felis, malesuada ut sagittis ut, vulputate
                                                sed metus. Phasellus sem magna, tristique ut leo at, dapibus rhoncus
                                                arcu. Fusce ultricies varius congue. Aliquam quis varius mauris.
                                                Suspendisse id placerat justo, commodo pellentesque massa.</p>
                                        </div>
                                    </div>
                                    <!-- col-3 -->
                                    <div class="become-row">
                                        <div class="left-icon mr-3"><img
                                                src="{{ asset('images/text-becon-icon.png') }}"></div>
                                        <div class="right-icon-info">
                                            <h5>Forum</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus
                                                libero ut lectus porta gravida. Nunc sit amet tellus imperdiet, dapibus
                                                nunc eu, vestibulum quam. Aliquam et tincidunt sem. Duis molestie congue
                                                ante sed porta. Fusce mauris felis, malesuada ut sagittis ut, vulputate
                                                sed metus. Phasellus sem magna, tristique ut leo at, dapibus rhoncus
                                                arcu. Fusce ultricies varius congue. Aliquam quis varius mauris.
                                                Suspendisse id placerat justo, commodo pellentesque massa.</p>
                                        </div>
                                    </div>
                                    <!-- col-4 -->
                                    <div class="become-row">
                                        <div class="left-icon mr-3"><img
                                                src="{{ asset('images/mail-becon-icon.png') }}"></div>
                                        <div class="right-icon-info">
                                            <h5>Messagerie</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus
                                                libero ut lectus porta gravida. Nunc sit amet tellus imperdiet, dapibus
                                                nunc eu, vestibulum quam. Aliquam et tincidunt sem. Duis molestie congue
                                                ante sed porta. Fusce mauris felis, malesuada ut sagittis ut, vulputate
                                                sed metus. Phasellus sem magna, tristique ut leo at, dapibus rhoncus
                                                arcu. Fusce ultricies varius congue. Aliquam quis varius mauris.
                                                Suspendisse id placerat justo, commodo pellentesque massa.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="become-col-section border-bottom-0">
                                    <h6>VOTRE PREMIERE ANNONCE</h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus libero ut
                                        lectus porta gravida. Nunc sit amet tellus imperdiet, dapibus nunc eu,
                                        vestibulum quam. Aliquam et tincidunt sem. Duis molestie congue ante sed porta.
                                        Fusce mauris felis, malesuada ut sagittis ut, vulputate sed metus. Phasellus sem
                                        magna, tristique ut leo at, dapibus rhoncus arcu. Fusce ultricies varius congue.
                                        Aliquam quis varius mauris. Suspendisse id placerat justo, commodo pellentesque
                                        massa.</p>
                                </div>
                            </div>
                            <!-- step-btn -->
                            <div class="pt-4" style="overflow: hidden;">
                                <button class="parpal-btn">
                                    <a href="javascript:;" data-step="conformation"
                                        class="___class_+?78___ next">Suivant</a>
                                </button>
                            </div>
                            <!-- step-btn end -->
                        </div>

                        <!-- end step-1 -->
                        <!-- step-2 -->
                        <div class="become-container animated payment-2">
                            <!-- information-step-2 -->
                            <form enctype="multipart/form-data" id="frmCompanyDetails" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="information-step-height scrollbar">
                                    <div class="become-col-section mb-3">
                                        <h6 class="mb-0">MES INFORMATIONS DE PAIEMENTS</h6>
                                    </div>
                                    <div class="information-step-row row">
                                        <x-pro-user.company-profile />
                                    </div>
                                </div>
                                <!-- step-btn end -->
                                <!-- step-btn -->
                                <div class="pt-4" style="overflow: hidden;padding-left: 12px;">
                                    <button class="parpal-btn precedent-btn">
                                        <a href="#" class="___class_+?59___ back">precedent</a>
                                    </button>
                                    <button type="submit" class="parpal-btn">
                                        <span class="___class_+?78___">Suivant</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--end step-2 -->
                        <!-- step-3 -->
                        <div class="become-container animated">
                            <!-- information-step-3 -->
                            <div class="information-step-height scrollbar">
                                <div class="become-col-section mb-3">
                                    <h6 class="mb-0">MON MOYEN DE PAIEMENT</h6>
                                </div>
                                <form role="form" class="stripe-payment" data-cc-on-file="false"
                                    data-stripe-publishable-key="{{ config('stripe.stripe_key') }}"
                                    id="stripe-payment">
                                    @csrf
                                    <div class="information-step-row">
                                        <div class="paymnet-card-info row">
                                            <div class="col-sm-12">
                                                <input type="number" class="required card-num text-field"
                                                    id="card_number" name="card_number" placeholder="Numero de carte"
                                                    class="___class_+?3___" maxlength="16">
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <input type="number" name="card_expiry_month" id="card_expiry_month"
                                                    class="required card-expiry-month text-field w-100"
                                                    placeholder="date d expiration" maxlength="2">

                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <input type="number" name="card_expiry_year"
                                                    wire:model.defer="card_expiry_year"
                                                    class="required card-expiry-year text-field w-100"
                                                    placeholder="date d expiration" maxlength="4">
                                            </div>
                                            <div class="col-sm-6 col-6 mb-3">
                                                <input type="text" name="card_cvc" id="card_cvc"
                                                    class="required card-cvc text-field w-100" placeholder="CVV"
                                                    maxlength="3">
                                                <i class="fas fa-info-circle ml-2"
                                                    style="font-size: 12px;color: #ff6e92;line-height: 35px;position: absolute;top: 0;right:0px;"></i>
                                            </div>
                                            <div class="hidden error">
                                                <i class='fas fa-exclamation-circle alert p-0' 
                                                style="font-size:14px;padding-left:15px;">
                                                    <p>Fix the errors before you begin.</p>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 px-0 mb-3">
                                            <img src="{{ asset('images/payment-becon-icon.png') }}">
                                        </div>
                                        <div class="col-12 px-0">
                                            <button class="parpal-btn precedent-btn">
                                                <a href="#" class="___class_+?59___ back">precedent</a>
                                            </button>
                                            <button type="submit" class="parpal-btn">
                                                <span class="___class_+?78___"><div class="loader"></div> Suivant</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- information-step-3 -->
                        </div>
                        <!--end step-3 -->
                    </div>
                </div>
            </section>
        </div>
    </div>
    @push('scripts')
        <!-- step-tab-script -->
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script type="text/javascript">
            var totalSteps = $(".steps li").length;
            var $form = $(".stripe-payment");
            $(".steps li:nth-of-type(1)").addClass("active");
            $(".myContainer .form-container:nth-of-type(1)").addClass("active");

            // Store Company Details
            $(document).on('submit', '#frmCompanyDetails', function(form) {
                form.preventDefault();
                var formData = new FormData($('#frmCompanyDetails')[0]);
                $.ajax({
                    url: "{{ route('store-company') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.key == 1) {
                            $(".steps li").eq($('#frmCompanyDetails').parents(".become-container").index() +
                                    1)
                                .addClass(
                                    "active");
                            $('#frmCompanyDetails').parents(".become-container").removeClass("active")
                                .next()
                                .addClass(
                                    "active flipInX");
                        }
                    },
                    error: function(response){
                        let errors = response.responseJSON.errors;
                        $.each(errors,function(key,val){
                            $('#error_'+key).html(val)
                        })
                    },
                })
            });

            // Step-3 add subscription
            $('#stripe-payment').validate({
                rules: {
                    card_number: {
                        required: true,
                        minlength: 16,
                        maxlength: 16
                    },
                    expire_on: {
                        required: true
                    },
                    cvv: {
                        required: true,
                        minlength: 3,
                        maxlength: 3
                    },
                }
            });
            $(document).on('submit', '#stripe-payment', function(form) {
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
                        url: "{{ route('store-card') }}",
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        beforeSend: function(){
                            $('.loader').show()
                        },
                        complete: function(){
                            $('.loader').hide();
                        },
                        success: function(response) {
                            if (response.key == 1) {
                                location.href = "{{ route('pro.dashboard') }}";
                            }
                        },
                    })
                }
            }

            $(".become-container").on("click", ".next", function() {
                let step = $(this).data('step');
                $(".steps li").eq($(this).parents(".become-container").index() + 1).addClass("active");
                $(this).parents(".become-container").removeClass("active").next().addClass("active flipInX");
            });

            $(".become-container").on("click", ".back", function() {
                $(".steps li").eq($(this).parents(".become-container").index() - totalSteps).removeClass("active");
                $(this).parents(".become-container").removeClass("active flipInX").prev().addClass("active flipInY");
            });


            /*=========================================================
            *     If you won't to make steps clickable, Please comment below code
            =================================================================*/
            // $(".steps li").on("click", function() {
            //     var stepVal = $(this).find("span").text();
            //     $(this).prevAll().addClass("active");
            //     $(this).addClass("active");
            //     $(this).nextAll().removeClass("active");
            //     $(".myContainer .become-container").removeClass("active flipInX");
            //     $(".myContainer .become-container:nth-of-type(" + stepVal + ")").addClass("active flipInX");
            // });
        </script>
    @endpush
</x-frontend.layout>
