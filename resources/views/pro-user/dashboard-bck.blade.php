<x-frontend.layout>
    <!-- Dashboard-Pro-parameter start -->
    <div class="foorbis-penal scrollbar" id="foorbis-penal">
        <div class="foorbis-penal-all scrollbar">
            <div class="foorbis-penal-left w-100">

                <div class="foorbis-switch dashbord-switch-col">
                    <h5>
                        MON DASHBOARD
                    </h5>
                    <div class="dashbord-right-swichbutton">
                        <div class="btnbox">
                            <div id="announces" class="btn notactive">
                                Vu Client
                            </div>
                            <div id="mes" class="btn active">
                                Vu Pro
                            </div>
                        </div>
                        <div class="bg-pink d-flex px-3 border-rounded ml-4 align-items-center py-2">
                            <i class="far fa-question-circle"></i>
                            <a href="{{route('pro-annonces')}}" class="text-white ml-2">Aide</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 rounded bg-white my-4 py-2 shadow-lg box-shadow-col">
                <div class="border-bottom row">
                    <div class="col-md-9">
                        <ul class="list-unstyled pb-2">
                            <li class="border-right d-inline mr-3 pr-2"><a href="#"
                                    class="fs-2 text-decoration-none pr-2 text-sub-title">Mon
                                    profil entreprise</a></li>
                            <li class="d-inline"><a href="#" class="fs-2 text-decoration-none pr-3 text-sub-title">A
                                    propos</a></li>
                            <li class="d-inline"><a href="#"
                                    class="fs-2 text-decoration-none pr-3 text-sub-title">Coordonnées</a>
                            </li>
                            <li class="d-inline"><a href="#"
                                    class="fs-2 text-decoration-none pr-3 text-sub-title">Horaires</a></li>
                            <li class="d-inline"><a href="#"
                                    class="fs-2 text-decoration-none pr-3 text-sub-title">Avis</a></li>
                            <li class="d-inline"><a href="#"
                                    class="fs-2 text-decoration-none pr-3 text-sub-title">Annonces</a></li>
                            <li class="d-inline"><a href="#"
                                    class="fs-2 text-decoration-none pr-3 text-sub-title">Statistiques</a>
                            </li>
                            <li class="d-inline"><a href="#"
                                    class="fs-2 font-weight-bold text-decoration-none pr-3 text-pink">Paramêtres</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 mb-3 d-flex justify-content-end">
                        <div class="d-inline">
                            <i class="fa fa-star text-warning"></i>
                            <p class="d-inline">36 follow</p>
                        </div>
                    </div>

                </div>
                <a href="{{route('pro.dashboard')}}">
                    <div class="d-flex align-items-center my-2">
                        <i class="fas fa-chevron-left text-primary"></i>
                        <p class="text-primary mb-0 mx-3">Dashboard pro</p>
                    </div>
                </a>
            </div>

            <div class="col-md-12">
                <p class="col-12 text-sub-title">Parametres</p>
                <div class="row">
                    <div class="col-md-3 px-0">
                        <div class="list-group" id="ListScrollSpy">
                            <a class="list-group-item shadow my-2 border-0 rounded pl-2 fs-2 list-group-item-action"
                                href="#list1">Mes abonnements</a>
                            <a class="list-group-item my-2 shadow rounded border-0 pl-2 fs-2 list-group-item-action"
                                href="#list2">Factures</a>
                            <a class="list-group-item my-2 rounded fs-2 border-0 pl-2 list-group-item-action"
                                href="#list3">Information de paiements</a>
                            <a class="list-group-item my-2 fs-2 rounded border-0 pl-2 list-group-item-action"
                                href="#list4">Liste
                                client</a>
                        </div>
                    </div>
                    <div class="col-md-9 item-content scrollbar" data-spy="scroll" data-target="#ListScrollSpy"
                        data-offset="0">
                        <div id="list1" class="box-shadow-col">
                            <div class="bg-white rounded p-3 py-5">
                                <div class="col-12 d-flex justify-content-between p-0 border-bottom mb-4">
                                    <div>
                                        <h6 class="text-sub-title">Mes abonnements</h6>
                                    </div>
                                    <div>
                                        <ul class="list-unstyled d-flex">
                                            <li class="pr-3 border-right">
                                                <p class="m-0 text-sub-title">
                                                    {{ $companyData->companyAdvertisement->count() }} Annonces
                                                </p>
                                            </li>
                                            <li class="ml-2">
                                                <p class="mb-0 text-sub-title">Soldes :</p>
                                            </li>
                                            <li>
                                                <h5 class="text-pink mb-0 font-weight-bold">
                                                    &nbsp;{{ $companyData->companyAdvertisement->sum('ad_amount') }}
                                                </h5>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive scrollbar">
                                            <table class="table">
                                                <thead class="foorbis-table bg-main-color fs-2">
                                                    <tr class="border-rounded">
                                                        <th scope="col">
                                                            <input type="checkbox">
                                                        </th>
                                                        <th scope="col">Titre annonces</th>
                                                        <th scope="col">Date creation</th>
                                                        <th scope="col">Date prochain renouvellement</th>
                                                        <th scope="col">PRIX</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($companyData->companyAdvertisement as $item)
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <input type="checkbox">
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}
                                                        </td>
                                                        <td>{{ Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}
                                                        </td>
                                                        <td>{{ $item->ad_amount }}</td>
                                                        <td class="d-flex justify-content-center"><img
                                                                class="cursor-pointer"
                                                                src="{{ asset('images/down-arrow.png') }}" width="18px"
                                                                alt=""></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="list2" class="box-shadow-col">
                            <div class="bg-white px-3 rounded my-5 py-5">
                                <div class="col-12 d-flex justify-content-between p-0 border-bottom mb-4">
                                    <h6 class="text-sub-title">Factures</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive scrollbar">
                                            <table class="table">
                                                <thead class="foorbis-table bg-main-color fs-2">
                                                    <tr class="border-rounded">
                                                        <th scope="col">
                                                            <input type="checkbox">
                                                        </th>
                                                        <th scope="col">Numero de factures</th>
                                                        <th scope="col">Date facture</th>
                                                        <th scope="col">Prix unitaire</th>
                                                        <th scope="col">Quantite</th>
                                                        <th scope="col">PRIX TOTAL</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($companyData->companyAdvertisement as $key => $item)
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <input type="checkbox">
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->invoice_number }}</td>
                                                        <td>{{ Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}
                                                        </td>
                                                        <td>{{ $item->ad_amount }}</td>
                                                        <td>{{ $item->ad_amount }}</td>
                                                        <td>{{ $item->ad_amount * ($key + 1) }}</td>
                                                        <td class="d-flex justify-content-center">
                                                            <img class="mr-2 cursor-pointer"
                                                                src="{{ asset('images/view.png') }}" width="18px"
                                                                alt="">
                                                            <img class="cursor-pointer remove-invoice"
                                                                data-id="{{ $item->id }}"
                                                                src="{{ asset('images/remove.png') }}" width="18px"
                                                                alt="">
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="list3" class="box-shadow-col">
                            <div class="bg-white px-3 rounded my-5 py-5">
                                <div class="col-12 d-flex justify-content-between p-0 border-bottom mb-4">
                                    <h6 class="text-sub-title">Moyen de paiement</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h6>Mes informations de paiements</h6>
                                        <form enctype="multipart/form-data" id="frmCompanyDetails" method="post">
                                            <div class="row my-3">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <x-pro-user.company-profile />
                                                <div class="col-lg-12">
                                                    <button type="submit" class="parpal-btn">
                                                        <span class="___class_+?78___">Sauvegarder</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div>
                                                        <h6>Moynes de paiement</h6>
                                                        <p class="text-danger">Nous acceptons les carets Visa,
                                                            MasterCard et PayPal</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end py-4">
                                                    <div>
                                                        <img src="{{ asset('images/plus_Purple.png') }}"
                                                            alt="">&nbsp;&nbsp;
                                                        {{-- <button class="text-primary add-card">Ajouter un
                                                            nouveau</button> --}}
                                                        <a href="#payment-info" class="text-primary">Ajouter un
                                                            nouveau</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <x-pro-user.card-list />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white px-3 rounded my-5 py-5" id="payment-info">
                                <div class="col-12 d-flex justify-content-between p-0 border-bottom mb-4">
                                    <h6 class="text-sub-title">Moyen de paiement</h6>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="#" class="text-primary pb-3">
                                            <i class="fas fa-chevron-left text-primary"></i>
                                            Precedent
                                        </a>
                                        <h6 class="mt-3">Mettre a jour un moyen de paiement</h6>
                                        <hr>
                                        <form role="form" id="stripePayment" class="stripePayment">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div>
                                                        <input type="hidden" name="card_id" id="card_id"
                                                            placeholder="Numero de carte">
                                                        <input type="number" name="card_number" id="card_number"
                                                            placeholder="Numero de carte">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <img src="{{ asset('images/mastercard.png') }}" alt="">
                                                    <img src="{{ asset('images/mastercard.png') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div>
                                                        <input type="number" name="card_expiry_month"
                                                            id="card_expiry_month" placeholder="date d`expiration">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div>
                                                        <input type="number" name="card_expiry_year"
                                                            id="card_expiry_year" placeholder="date d`expiration">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div>
                                                        <input type="number" name="card_cvc" id="card_cvc"
                                                            placeholder="CVV">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 mt-3 p-0">
                                                <button type="submit"
                                                    class="border-0 w-full rounded px-3 py-2 bg-main-color d-flex align-items-center justify-content-center">Sauvegarder</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="list4" class="box-shadow-col">
                            <div class="bg-white px-3 rounded py-5">
                                <div class="col-12 d-flex justify-content-between p-0 border-bottom mb-4">
                                    <div>
                                        <h6 class="text-sub-title">Liste clients</h6>
                                    </div>
                                    <div>
                                        <ul class="list-unstyled d-flex">
                                            <li class="pr-3 border-right">
                                                <p class="m-0">36 clients</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive scrollbar">
                                            <table class="table">
                                                <thead class="foorbis-table bg-main-color fs-2">
                                                    <tr class="border-rounded">
                                                        <th scope="col">
                                                            <input type="checkbox">
                                                        </th>
                                                        <th scope="col">Nom client</th>
                                                        <th scope="col">Date de suivi</th>
                                                        <th scope="col">Address mail</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <input type="checkbox">
                                                            </div>
                                                        </td>
                                                        <td class="d-flex">
                                                            <!-- <img src="{{ asset('images/coffee-shop.png') }}" alt=""> -->
                                                            <p class="mb-0">Nom client</p>
                                                        </td>
                                                        <td>01/07/2021</td>
                                                        <td>contact@contact.fr</td>
                                                        <td>
                                                            <img class="cursor-pointer"
                                                                src="{{ asset('images/close-icon.png') }}" width="10px"
                                                                height="10px" alt="">
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
    $(document).ready(function() {
        $(document).on('click', '.remove-invoice', function() {
            var id = $(this).data('id');
            var that = $(this);
            $.ajax({
                url: "{{ route('remove-invoice') }}",
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    toastr.success(response.message);
                    if (response.key == 1) {
                        that.parents('tr').remove();
                    }
                },
            })
        });
    });
    $('#frmCompanyDetails').validate({
        rules: {
            first_name: 'required',
            last_name: 'required',
            company_name: 'required',
            email: {
                required: true,
                email: true,
            },
            address_line_1: 'required',
            address_line_2: 'required',
            city: 'required',
            postal_code: {
                required: true,
                minlength: 5,
                maxlength: 5
            }
        }
    });
    $(document).on('submit', '#frmCompanyDetails', function(form) {
        form.preventDefault();
        var formData = new FormData($('#frmCompanyDetails')[0]);
        $.ajax({
            url: "{{ route('save-company-details') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                // toastr.success(response.message);
                if (response.key == 1) {
                    toastr.success(response.message);
                }
            },
        })
    });
    $('#stripePayment').validate({
        rules: {
            card_number: {
                required: true,
                minlength: 16,
                maxlength: 16
            },
            card_expiry_month: {
                required: true,
                min: 1,
                max: 12,
                minlength: 1,
                maxlength: 2
            },
            card_expiry_year: {
                required: true,
                minlength: 4,
                maxlength: 4
            },
            card_cvc: {
                required: true,
                minlength: 3,
                maxlength: 3
            },
        }
    });

    // Save or Update Card Details
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
                    location.reload();
                }
            },
        })
    });

    // Get Card details on update
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
                    location.href = '#payment-info';
                    console.log(response.data);
                }
            },
        })
    });

    // Delete Card details
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
                    that.parents('.table-responsive').remove();
                }
            },
        })
    });
    </script>
    <script>
    let foorbisPenal1 = document.getElementById('foorbis-penal');
    let createPopup1 = document.getElementById('createPopup');
    let popupCard1 = document.getElementById('popupCard');

    const popUp1 = () => {
        foorbisPenal1.style.overflow = "hidden";
        createPopup1.style.display = "flex";
        setTimeout(() => {
            popupCard1.style.transform = "translateY(0%)";
        }, 100);
    }

    const closeFun1 = () => {
        foorbisPenal1.style.overflow = "auto";
        popupCard1.style.transform = "translateY(-200%)";
        setTimeout(() => {
            createPopup1.style.display = "none";
        }, 500);
    }
    $(document).on('click', '.closePopup', function(e) {
        closeFun1();
    });
    $(document).on('click', '.add-card', function(e) {
        popUp1();
    });
    </script>
    @endpush
</x-frontend.layout>