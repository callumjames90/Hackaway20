@extends('layouts.app')

@extends('layouts.navbar')

@section('content')

    <style>
        #map {
            //height: 80%;
            margin-top: -2.5%;
        }
    </style>

<div id="map" class="container-fluid" style="height: 80%">
    <script>
        var map;

        function initMap() {
            var center = {lat: 51.4, lng: -0.56};

            map = new google.maps.Map(document.getElementById('map'), {
                center: center,
                zoom: 15,
                draggable: true,
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: false,
                rotateControl: false,
                fullscreenControl: true,
                streetViewControl: false,
            });
            var marker = new google.maps.Marker({position: center, map: map});

            if (navigator.geolocation) {
                /*
                navigator.geolocation.getCurrentPosition(function (position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(pos);*/

                var heatmapData = [
                    new google.maps.LatLng(37.782, -122.447),
                    new google.maps.LatLng(37.782, -122.445),
                    new google.maps.LatLng(37.782, -122.443),
                    new google.maps.LatLng(37.782, -122.441),
                    new google.maps.LatLng(37.782, -122.439),
                    new google.maps.LatLng(37.782, -122.437),
                    new google.maps.LatLng(37.782, -122.435),
                    new google.maps.LatLng(37.785, -122.447),
                    new google.maps.LatLng(37.785, -122.445),
                    new google.maps.LatLng(37.785, -122.443),
                    new google.maps.LatLng(37.785, -122.441),
                    new google.maps.LatLng(37.785, -122.439),
                    new google.maps.LatLng(37.785, -122.437),
                    new google.maps.LatLng(37.785, -122.435)
                ];

                heatmap = new google.maps.visualisation.HeatmapLayer({
                    data: heatmapData
                });
                heatmap.setMap(map)
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPhnYv7qqmn9NK7IweTP07rggklVMCc2U&callback=initMap" async defer></script>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/review"><button class="current btn-lg btn-info">Review Current Area</button></a>
        </div>
    </div>
</div>
@endsection
