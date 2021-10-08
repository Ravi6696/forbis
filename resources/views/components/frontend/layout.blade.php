<!DOCTYPE html>
<html>

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css">

    {{-- Toastr Css --}}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/foorbis-custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/foorbis-responive.css') }}" type="text/css">

    <!-- font-awsome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
    <!-- google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <!-- multipal-menu -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    @stack('styles')
    <style>
        .loader {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 40px;
            height: 40px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .toast-top-right {
            margin-top: 100px !important;
        }

        .foorbis-profile img {
            border-radius: 50% !important;
        }

    </style>
    <title>Header-Professionnel</title>
</head>

<body>
    <!-- Whole login -->
    <section id="foorbis-col">
        <!-- foorbis-header -->
        <x-frontend.header />
        <!-- foorbis-header-end -->
        <div class="foorbis-section">
            <!-- foorbis-sidebar -->
            <x-frontend.sidebar />
            <!-- foorbis-sidebar-end -->
            <input type="hidden" name="baseUrl" id="baseUrl" value="{{ url('/') }}">
            <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
            {{ $slot }}
        </div>
    </section>
    <!-- Bootstrap js -->
    <script src="{{ asset('js/jquery-slim.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places"></script>
    <!-- Custom Js -->
    {{-- <script src="{{ asset('js/foorbis-custom.js') }}"></script> --}}
    <script src="{{ asset('js/announces.js') }}"></script>

    {{-- For Broadcasting live Chat --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    {{-- Toastr js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- foorbis-sidebar-menu-bar -->
    <script type="text/javascript">
        $(function() {
            toastr.options = {
                "closeButton": false,
                "debug": true,
                "newestOnTop": true,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        });
        var baseUrl = $('#baseUrl').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.loader').hide();
        $('.responive-left-menu').click(function() {
            $(".foorbis-sidebar").addClas
            s("foorbis-sidebar-open");
        });

        $('.foorbis-sidebar-close').click(function() {
            $(".foorbis-sidebar").removeClass("foorbis-sidebar-open");
        });
        $('.loader').bind('ajaxStart', function() {
            $(this).show();
        }).bind('ajaxStop', function() {
            $(this).hide();
        });

        // notifications-bar-right 
        $('.notification-popup').click(function() {
            $("#notifications-bar-right").addClass("drawer-bar-open");
        });

        $('.drawer-close').click(function() {
            $("#notifications-bar-right").removeClass("drawer-bar-open");
        });

        // message-bar-right 
        $('.message-popup').click(function() {
            $("#message-bar-right").addClass("drawer-bar-open");
        });

        $('.drawer-close').click(function() {
            $("#message-bar-right").removeClass("drawer-bar-open");
        });
    </script>
    @stack('scripts')
    <script>
        // Echo.private(`chat`)
        //     .listenForWhisper('typing', (e) => {
        //         console.log(e.name);
        //     });
    </script>


</body>

</html>l>
