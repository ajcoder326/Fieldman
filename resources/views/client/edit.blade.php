{{-- @php
    $title = 'Edit Client';

@endphp
@section('title')
    {{ $title }}
@endsection
@extends('layout')
@section('main-content')

    <form action="{{ route('client.update',['id' => $client->id]) }}" method="post">
        @csrf
        <div class="card shadow">
            <div class="card-body">
                <div class="card card-primary mt-2">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col">
                                <h6> Client Details</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="form-group col-md-4">
                                <label for="name" class="control-label">Name</label>
                                <input id="name" name="name" class="form-control" value="{{ $client->name}}" />
                                <span class="text-danger">{{ $errors->first('name', ':message') }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address" class="control-label">Address</label>
                                <input id="address" name="address" class="form-control" value="{{ $client->address }}" />
                                <span class="text-danger">{{ $errors->first('address', ':message') }}</span>
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="form-group col-md-2">
                                <label for="city" class="control-label">City</label>
                                <input id="city" name="city" class="form-control" value="{{ $client->city}}" />
                                <span class="text-danger">{{ $errors->first('city', ':message') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="latitude" class="control-label">Latitude</label>
                                <input id="latitude" name="latitude" class="form-control" value="{{ $client->latitude }}" />
                                <span class="text-danger">{{ $errors->first('latitude', ':message') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="longitude" class="control-label">Longitude</label>
                                <input id="longitude" name="longitude" class="form-control"
                                    value="{{ $client->longitude }}" />
                                <span class="text-danger">{{ $errors->first('longitude', ':message') }}</span>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="radius" class="control-label">Radius</label>
                                <input id="radius" name="radius" class="form-control" value="{{ $client->radius }}" />
                                <span class="text-danger">{{ $errors->first('radius', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-primary mt-2">
                    <div class="card-header">
                        <h6> Personal Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="form-group col-md-4 ">
                                <label for="phone" class="control-label">Phone Number</label>
                                <input id="phone" name="phone" type="number" class="form-control"
                                    value="{{ $client->phone }}" />
                                <span class="text-danger">{{ $errors->first('phone', ':message') }}</span>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="email" class="control-label">Email</label>
                                <input id="email" name="email" type="email" class="form-control"
                                    value="{{ $client->email }}" />
                                <span class="text-danger">{{ $errors->first('email', ':message') }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contactPersonName" class="control-label">Contact Person Name</label>
                                <input id="contactPersonName" name="contactPersonName" class="form-control"
                                    value="{{ $client->contact_person_name }}" />
                                <span class="text-danger">{{ $errors->first('contactPersonName', ':message') }}</span>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group col-md-12 ">
                                <label for="remarks" class="control-label">Remarks</label>
                                <textarea id="remarks" rows="5" name="remarks" class="form-control" >{{ $client->remarks }}</textarea>
                                <span class="text-danger">{{ $errors->first('remarks', ':message') }}</span>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
        </div>

    </form>
@endsection --}}


@php
    use App\Models\Settings;
    $settings = Settings::first();
    $title = 'Edit Client';
@endphp
@section('title')
    {{ $title }}
@endsection
@extends('layout')
@section('main-content')
    <div class="row mb-3">
        <div class="col">
            <div class="float-start">
                <h4 class="mt-2">{{ $title }}</h4>
            </div>
        </div>
    </div>
    <div class = "card mb-3">
        <div class = "card-body">
            <div class="row">
                <div class="col-6">
                    <form action="{{ route('client.update', ['id' => $client->id]) }}" method="post">
                        <input id="latitude" name="latitude" type="hidden" />
                        <input id="longitude" name="longitude" type="hidden" />
                        @csrf
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="card card-primary mt-2">
                                    <div class="card-header">
                                        <h6> Client Details</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="form-group col-md-4">
                                                <label for="name" class="control-label">Name</label>
                                                <input id="name" name="name" class="form-control"
                                                    value="{{ $client->name }}" />
                                                <span class="text-danger">{{ $errors->first('name', ':message') }}</span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="address" class="control-label">Address</label>
                                                <input id="address" name="address" class="form-control"
                                                    value="{{ $client->address }}" />
                                                <span class="text-danger">{{ $errors->first('address', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="form-group col-md-6">
                                                <label for="city" class="control-label">City</label>
                                                <input id="city" name="city" class="form-control"
                                                    value="{{ $client->city }}" />
                                                <span class="text-danger">{{ $errors->first('city', ':message') }}</span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="radius" class="control-label">Radius</label>
                                                <input id="radius" name="radius" class="form-control"
                                                    value="{{ $client->radius }}" />
                                                <span class="text-danger">{{ $errors->first('Radius', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-primary mt-2">
                                    <div class="card-header">
                                        <h6> Personal Details</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="form-group col-md-4">
                                                <label for="phone" class="control-label">Phone Number</label>
                                                <input id="phone" name="phone" type="number" class="form-control"
                                                    value="{{ $client->phone }}" />
                                                <span class="text-danger">{{ $errors->first('phone', ':message') }}</span>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email" class="control-label">Email</label>
                                                <input id="email" name="email" type="email" class="form-control"
                                                    value="{{ $client->email }}" />
                                                <span class="text-danger">{{ $errors->first('email', ':message') }}</span>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="contactPersonName" class="control-label">Contact Person
                                                    Name</label>
                                                <input id="contactPersonName" name="contactPersonName" class="form-control"
                                                    value="{{ $client->contactPersonName }}" />
                                                <span
                                                    class="text-danger">{{ $errors->first('contactPersonName', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="form-group col-md-12">
                                                <label for="remarks" class="control-label">Remarks</label>
                                                <textarea id="remarks" rows="5" name="remarks" class="form-control">{{ $client->remarks }}</textarea>
                                                <span
                                                    class="text-danger">{{ $errors->first('remarks', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <div class="form-group row mb-3">
                        <div class="form-group col-md-12">
                            <label for="locationSearch" class="control-label">Location Search</label>
                            <input id="locationSearch" name="locationSearch" class="form-control "
                                placeholder="Search for a location" />
                        </div>
                    </div>
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"
        async defer></script>

    <script>
        let map;
        let marker;
        let circle;
        let autocomplete;

        function initMap() {
            const latitude = '{{ $client->latitude }}';
            const longitude = '{{ $client->longitude }}';
            const radius = '{{ $client->radius }}';
            const zoomLevel = '15';

            const defaultLocation = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude),
                radius: parseFloat(radius)
            };

            // Initialize the map
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: parseInt(zoomLevel),
            });

            // Initialize marker
            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true
            });

            // Initialize circle with a default radius of 100 meters
            circle = new google.maps.Circle({
                map: map,
                radius: parseFloat(radius),
                fillColor: '#AA0000',
                strokeColor: '#AA0000'
            });
            circle.bindTo('center', marker, 'position');

            // Add event listener for marker drag
            marker.addListener("dragend", () => {
                updateLatLng(marker.getPosition());
            });

            // Update marker position and fields on map click
            map.addListener("click", (event) => {
                marker.setPosition(event.latLng);
                updateLatLng(event.latLng);
            });

            // Initialize autocomplete for search box
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById("locationSearch"), {
                    types: ["geocode"]
                }
            );

            // Add listener for place selection
            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();

                if (place.geometry) {
                    map.panTo(place.geometry.location);
                    marker.setPosition(place.geometry.location);
                    updateLatLng(place.geometry.location);
                    //set zoom level
                    map.setZoom(15);
                } else {
                    alert("No details available for the selected location!");
                }
            });

            // Set default radius to 100 meters
            document.getElementById("radius").value = {{ $client->radius }};

            // Update the circle radius based on input change
            document.getElementById("radius").addEventListener("input", function() {
                const radius = parseFloat(this.value);
                circle.setRadius(radius);
            });
        }

        // Update Latitude and Longitude input fields
        function updateLatLng(location) {
            document.getElementById("latitude").value = location.lat();
            document.getElementById("longitude").value = location.lng();
        }
    </script>
@endsection