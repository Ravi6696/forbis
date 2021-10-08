<x-frontend.layout>
    @push('styles')
    <style>
        .btn-submit {
            text-align: right;
            margin-top: 30px;
        }

        .hidden {
            display: none;
        }

        .error {
            color: red;
        }
    </style>
    @endpush
    <input type="hidden" name="company_id" id="company_id" value="{{ $companyData->id ?? null }}">
    <div class="foorbis-penal scrollbar" id="foorbis-penal">
        <div class="foorbis-penal-all scrollbar">
            <div class="py-4 dashboard-list row m-0">
                <p class="dashbord-name col-md-6 p-0">mon DASHBOARD</p>
                <div class="toggle-btns col-md-6 col-12 d-flex justify-content-end p-0">
                    <div class="dashboard-pro">
                        <div class="btnbox">
                            <div id="dashboardButton1"
                                class="btn d-flex align-items-center justify-content-center notactive company_details">
                                Vu Client
                            </div>
                            <div id="dashboardButton2"
                                class="btn d-flex align-items-center justify-content-center active create_company">
                                Vu Pro
                            </div>
                        </div>
                    </div>
                    <div class="pink-btn d-flex justify-content-center align-items-center">
                        <img src="{{ asset('images/aide.png')}}" width="20px" height="20px">
                        <a class="text-decoration-none text-white ml-1" href="#">Aide</a>
                    </div>
                </div>
            </div>
            <div class="show_div create-company">
                <div class="view_dashboard"> </div>
                {{-- <x-create-company></x-create-company> --}}
            </div>
            <div class="show_div company-detail hidden">
                <div class="view_dashboard"> </div>
                {{-- <x-company-preview></x-company-preview> --}}
            </div>
            <div class="show_div pro-user-dashboard" id="parametres12">
                <x-pro-user-dashboard></x-pro-user-dashboard>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        viewCompanyDetails('create');
    $(document).on('click', '#parametres', function(e) {
        $('.show_div').addClass('hidden');
        $('.pro-user-dashboard').removeClass('hidden');
    });
    $(document).on('click', '.create_company', function(e) {
        $('.show_div').addClass('hidden');
        $('.create-company').removeClass('hidden');
        viewCompanyDetails('create');
    });
    $(document).on('click', '.company_details', function(e) {
        $('.show_div').addClass('hidden');
        $('.company-detail').removeClass('hidden');
        viewCompanyDetails('details');
    });

    function viewCompanyDetails(type) {
        $.ajax({
            // url: "{{ route('company-details') }}",
            url: "{{ route('view-create-company') }}" + '/' + type,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $(".view_dashboard").html(response.data);
                if (type == 'create') {
                    getCompanyDetails();
                }
            },
        });
    }

    function getCompanyDetails() {
        $.ajax({
            url: "{{ route('get-company-details') }}",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $(".company-details").html(response.data);
            },
        })
    }
    </script>
    <script>
        $('#frmAddProfile').validate({
        rules: {
            company_name: 'required',
            "category[]": "required",
            collect_link: {
                required: true,
                url: true,
            },
            delivery_link: {
                required: true,
                url: true,
            },
        }
    });
    $('#frmContactDetails').validate({
        rules: {
            telephone: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            mobile_no: {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            email: {
                required: true,
                email: true,
            },
            address: 'required',
            city: 'required',
            postal_code: {
                required: true,
                minlength: 5,
                maxlength: 5
            }
        }
    });
    $('#frmaddCompanyTime').validate({
        rules: {
            "mon_start_time[]": "required",
            "mon_end_time[]": "required",
            "tues_start_time[]": "required",
            "tues_end_time[]": "required",
            "wednes_start_time[]": "required",
            "wednes_end_time[]": "required",
            "thurs_start_time[]": "required",
            "thurs_end_time[]": "required",
            "fri_start_time[]": "required",
            "fri_end_time[]": "required",
            "satur_start_time[]": "required",
            "satur_end_time[]": "required",
            "sun_start_time[]": "required",
            "sun_end_time[]": "required",
        }
    });
    $(document).on('submit', '#frmAddProfile', function(form) {
        form.preventDefault();
        var formData = new FormData($('#frmAddProfile')[0]);
        $.ajax({
            url: "{{ route('save-company') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message);
                if (response.key == 1) {
                    getCompanyDetails();
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
    $(document).on('click', '#saveAboutUs', function(e) {

        var about_us = $('textarea#about_us').val();
        var company_id = $('#company_id').val();
        if (company_id == null || company_id == '') {
            alert('Please save Comapany Details !!');
            return false;
        }
        $.ajax({
            url: "{{ route('save-aboutus') }}",
            type: 'POST',
            data: {
                'about_us': about_us,
                'company_id': company_id
            },
            dataType: 'json',
            // processData: false,
            // contentType: false,
            success: function(response) {
                console.log(response.message);
                toastr.success(response.message);
            },
            error: function(response) {
                let errors = response.responseJSON.errors;
                $.each(errors, function(key, val) {
                    $('#error_' + key).html(val)
                })
            },
        })
    });
    $(document).on('submit', '#frmContactDetails', function(form) {
        form.preventDefault();
        var company_id = $('#company_id').val();
        if (company_id == null || company_id == '') {
            alert('Please save Comapany Details !!');
            return false;
        }
        var formData = new FormData($('#frmContactDetails')[0]);
        formData.append('company_id', company_id);
        $.ajax({
            url: "{{ route('save-contactdetails') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(response) {
                let errors = response.responseJSON.errors;
                $.each(errors, function(key, val) {
                    $('#error_' + key).html(val)
                })
            },
        })
    });
    $(document).on('submit', '#frmaddCompanyTime', function(form) {
        form.preventDefault();
        var company_id = $('#company_id').val();
        var formData = new FormData($('#frmaddCompanyTime')[0]);
        if (company_id == null || company_id == '') {
            alert('Please save Comapany Details !!');
            return false;
        }
        formData.append('company_id', company_id);
        console.log(formData);
        $.ajax({
            url: "{{ route('save-companytime') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(response) {
                let errors = response.responseJSON.errors;
                $.each(errors, function(key, val) {
                    $('#error_' + key).html(val)
                })
            },
        })
    });
    $(document).on('click', '.delete-gallery', function(e) {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('remove-gallery') }}",
            type: 'post',
            data: {
                'id': id,
            },
            dataType: 'json',
            success: function(response) {
                toastr.success(response.message);
                getCompanyDetails();
            },
        })
    });
    $(document).on('click', '.btn-respond', function(e) {
        var id = $(this).data('id');
        var message = $('#respond_message' + id).val();
        var company_id = "{{ $companyData->id ?? null }}";
        if (company_id == null || company_id == '') {
            alert('Please save Comapany Details !!');
            return false;
        }
        $.ajax({
            url: "{{ route('save-comment') }}",
            type: 'POST',
            data: {
                'id': id,
                'message': message,
                'company_id': company_id
            },
            dataType: 'json',
            // processData: false,
            // contentType: false,
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(response) {
                let errors = response.responseJSON.errors;
                $.each(errors, function(key, val) {
                    $('#error_' + key).html(val)
                })
            },
        })
    });
    $(document).on('click', '#saveReserveLink', function(e) {
        var reservation_link = $('#reservation_link').val();
        var company_id = $('#company_id').val();
        if (company_id == null || company_id == '') {
            alert('Please save Comapany Details !!');
            return false;
        }
        $.ajax({
            url: "{{ route('save-reservation_link') }}",
            type: 'POST',
            data: {
                'reservation_link': reservation_link,
                'company_id': company_id
            },
            dataType: 'json',
            // processData: false,
            // contentType: false,
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(response) {
                let errors = response.responseJSON.errors;
                $.each(errors, function(key, val) {
                    $('#error_' + key).html(val)
                })
            },
        })
    });
    $(document).on('click', '.plus-box', function(e) {
        var day = $(this).data('day');
        $(`<div class="` + day + ` row col-12 plusDiv">
                        <div class="col-2"></div>
                            <div class="col-4">
                                <div class="input-type box-hora seprete">
                                    <input class="regular-input" type="time" name="` + day + `_start_time[]" placeholder="Overturture">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-type box-hora seprete">
                                    <input class="regular-input" type="time" name="` + day + `_end_time[]" placeholder="Fermature">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="close-box ">
                                    <img src="{{ asset('images/close.png') }}">
                                </div>
                            </div>
                        </div>
                    </div>`)
            .appendTo('.' + day + 'dayDiv');
        // alert(day);
    });
    $(document).on('click', '.close-box', function(e) {
        $(this).parents('.plusDiv').remove();
    });

    var changeLogo = function(event) {
        var image = document.getElementById('btn-input');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    </script>
    @endpush
</x-frontend.layout>
