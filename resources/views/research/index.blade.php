<x-frontend.layout>
    @push('styles')
        <style>
            .d-none {
                display: none;
            }

            #map {
                height: 100%;
            }

        </style>
    @endpush
    <div class="foorbis-penal scrollbar" id="foorbis-penal">
        <div class="foorbis-penal-all foorbis-paenal-bg p-0 ">
            <div class="row m-0">
                <div class="recheche-left p-0">
                    <div class="foorbis-penal-left announce-penal-left w-100">
                        <!--  heading start-->
                        <div class="foorbis-announces">
                            <div class="foorbis-switch">
                                <h5>
                                    RECHERCHE
                                </h5>
                            </div>
                        </div>
                        <!--  heading end-->
                        <div class="form-input icon-input">
                            <input type="text" placeholder="Recherche" class="icon-input">
                            <span><img src="images/search.png" alt=""></span>
                        </div>
                        <!-- search panel End -->
                        <hr>
                        <div class="foorbis-announceses">
                            <div class="row">
                                <div class="col-12">
                                    <div class="right-panal-data">
                                        <input type="text" name="" placeholder="Filters de recherche">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-0">

                        <!-- start 36 resultals section -->
                        <div class="fix-height-entreprise scrollbar mt-3 ml-0">
                            <p class="entreprise-heding">{{ $companies->count() }} resultals</p>
                            @foreach ($companies as $company)
                                <div class="enterprice-slide">
                                    <div class="enterprice-img"><img src="images/sub-thumbe-4.png"></div>
                                    <div class="centerprice-col">
                                        <a class="entreprise-heading" href="">{{ $company->name ?? '-' }}</a>
                                        <span class="ouvert">ouvert</span>
                                        <a class="categorie categorie-recherch" href="#"><img
                                                src="images/pink-menu.png">
                                            {{ $company->category_name ?? '-' }}
                                        </a>
                                        <a href="javascript:;" class="address"
                                            data-id="{{ $company->id ?? 'null' }}"><img
                                                src="images/location-perpal.png">
                                            {{ $company->full_address ?? '-' }}</a>
                                        <a class="favorle-recherch" href="#"><img src="images/favoris.png"> Favorle</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- End start 36 resultals section -->
                    </div>
                </div>
                <div class="recheche-right-map p-0">
                    {{-- <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834"
                        width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen id="map"></iframe> --}}
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')\
        <script>
            $(document).ready(function() {
                initMap(-25.363, 131.044)

                function initMap(latitude, longitude, contentString = "Click the map to get Lat/Lng!") {
                    var lat = parseFloat(latitude);
                    var lng = parseFloat(longitude);
                    const myLatLng = {
                        lat: lat,
                        lng: lng
                    };
                    console.log(myLatLng);
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 8,
                        center: myLatLng,
                    });
                    new google.maps.Marker({
                        position: myLatLng,
                        map,
                        title: "Hello World!",
                    });
                    // Create the initial InfoWindow.
                    let infoWindow = new google.maps.InfoWindow({
                        content: contentString,
                        position: myLatLng,
                    });
                    infoWindow.open(map);
                    // Configure the click listener.
                    map.addListener("click", (mapsMouseEvent) => {
                        // Close the current InfoWindow.
                        infoWindow.close();
                        // Create a new InfoWindow.
                        infoWindow = new google.maps.InfoWindow({
                            position: mapsMouseEvent.latLng,
                            content: contentString,
                        });
                        infoWindow.setContent(
                            // JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                            contentString
                        );
                        infoWindow.open(map);
                    });
                }
                $(document).on('click', '.address', function() {
                    var company_id = $(this).data('id');
                    // $('#pills-tabContent').addClass('d-none');
                    $.ajax({
                        url: "{{ route('get-map-area') }}",
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'company_id': company_id
                        },
                        dataType: 'json',
                        success: function(response) {
                            var latitude = response.data.latitude;
                            var longitude = response.data.longitude;
                            var contentString = response.data.contentString;
                            initMap(latitude, longitude, contentString);
                        },
                    })
                });
            });
        </script>
    @endpush
</x-frontend.layout>
