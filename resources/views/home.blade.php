@extends('layouts.app')

@extends('layouts.navbar')

@section('content')
<div class="container">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <style>
        #map {
            height: 80%;
        }
    </style>
    <div id="map" class="container-fluid">
        <script>
            var map;

            function initMap() {
                var center = {lat: 0, lng: 0};
                map = new google.maps.Map(document.getElementById('map'), {
                    center: center,
                    zoom: 4,
                    draggable: true,
                });

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        map.setCenter(pos);
                    });
                }

                @foreach($reviews as $review)
                    var marker = new google.maps.Marker({position: { lat: {{ $review->latitude }}, lng: {{ $review->longitude }} }, map: map});
                @endforeach
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPhnYv7qqmn9NK7IweTP07rggklVMCc2U&callback=initMap" async defer></script>
    </div>
</div>
@endsection
