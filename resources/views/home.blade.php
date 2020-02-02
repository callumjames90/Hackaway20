@extends('layouts.app')

@extends('layouts.navbar')

@section('content')

    <style>
        #map {
            margin-top: -1.5%;
        }
    </style>

<div id="map" class="container-fluid" style="height: 80%">
    <script>
        var map;

        function initMap() {
            var center = {lat: 51.4215, lng: -0.5668};

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
                    @foreach ($clusters as $cluster)
                    {location: new google.maps.LatLng({{$cluster->latitude}}, {{$cluster->longitude}}), weight: {{$cluster->rating_avg}}},
                    @endforeach
                ]

                heatmap = new google.maps.visualization.HeatmapLayer({
                    data: heatmapData
                });
                heatmap.setOptions({
                    radius: 100,
                    gradient: ["rgba(255,104,203,0)",
                                "rgba(252,66,50,0)",
                                "rgba(252,179,55,20)",
                                "rgba(252,255,105,20)",
                                "rgba(89,238,69,0.5)"]
                });
                heatmap.setMap(map);
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPhnYv7qqmn9NK7IweTP07rggklVMCc2U&callback=initMap&libraries=visualization" async defer></script>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/review"><button class="current btn-lg btn-info">Review Current Area</button></a>
        </div>
    </div>
</div>
@endsection
