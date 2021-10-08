<div>
    <div class="adresse-input col-xl-7">
        <input type="hidden" name="address_id" id="address_id" class="form-control w-100"
            value="{{ $companyData->address->id ?? null }}">
        <input type="text" name="address" id="autocomplete" placeholder="Adresse"
            value="{{ $companyData->address->address_line_1 ?? null }}">
        <p class="error" id="error_address"></p>
    </div>
    <div class="form-group" id="latitudeArea">
        <label>Latitude</label>
        <input type="text" id="latitude" name="latitude" class="form-control" value="{{ $companyData->latitude }}">
    </div>
    <div class="form-group" id="longtitudeArea">
        <label>Longitude</label>
        <input type="text" name="longitude" id="longitude" class="form-control" value="{{ $companyData->longitude }}">
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#latitudeArea").addClass("d-none");
                $("#longtitudeArea").addClass("d-none");
            });
        </script>
        <script>
            google.maps.event.addDomListener(window, 'load', initialize);

            function initialize() {
                var input = document.getElementById('autocomplete');
                var autocomplete = new google.maps.places.Autocomplete(input);

                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    $('#latitude').val(place.geometry['location'].lat());
                    $('#longitude').val(place.geometry['location'].lng());
                });
            }
        </script>
    @endpush
</div>
