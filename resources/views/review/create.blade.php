@extends('layouts.app')

@include('layouts.navbar')

@section('content')

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
                    zoom: 8,
                    draggable: false,
                });
                var marker = new google.maps.Marker({position: center, map: map});
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPhnYv7qqmn9NK7IweTP07rggklVMCc2U&callback=initMap" async defer></script>
    </div>

    <script>
        function getPosition(position, errorHandler) {
            userLatitude = position.coords.latitude;
            userLongitude = position.coords.longitude;
            latlng = google.maps.LatLng(userLatitude, userLongitude);
            document.getElementById("map").setCenter(latlng);
        }

        function setCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(getPosition);
            }
        }
    </script>
    <button onclick="setCurrentLocation()">Set Location</button>

    <div class="container">
        <div class = "row justify-content-center">
            <form class="form-style" method="POST" action="/">
                <section id="rate" class="rating">
                    <input type="radio" id="face_1" name="like" value="1" />
                    <label for="heart_1" title="One">1
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </label>

                    <input type="radio" id="face_2" name="like" value="2" />
                    <label for="heart_2" title="Two">2
                        <i class="fa fa-frown-o" aria-hidden="true"></i>
                    </label>

                    <input type="radio" id="face_3" name="like" value="3" />
                    <label for="heart_3" title="Three">3
                        <i class="fa fa-meh-o" aria-hidden="true"></i>
                    </label>

                    <input type="radio" id="face_4" name="like" value="4" />
                    <label for="heart_4" title="Four">4
                        <i class="fa fa-smile-o" aria-hidden="true"></i>
                    </label>

                    <input type="radio" id="face_5" name="like" value="5" />
                    <label for="face_5" title="Five">5
                        <i class="fa fa-heart" aria-hidden="true"></i>
                    </label>
                </section>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    </div>

@endsection
