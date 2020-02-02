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
                var center = {lat: 51.4, lng: -0.56};
                map = new google.maps.Map(document.getElementById('map'), {
                    center: center,
                    zoom: 15,
                    draggable: false,
                    zoomControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    rotateControl: false,
                    fullscreenControl: false,
                    streetViewControl: false,
                });
                var marker = new google.maps.Marker({position: center, map: map});

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        map.setCenter(pos);
                        document.getElementById('latAndLon').value = pos.lat + "," + pos.lng;
                    });
                }

                google.maps.event.addListener(map, "click", function(event) {
                    placeMarker(event.latLng);
                });

                function placeMarker(location) {
                    marker.setPosition(location);
                    document.getElementById("latlng").innerHTML = location.toString();
                }
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPhnYv7qqmn9NK7IweTP07rggklVMCc2U&callback=initMap" async defer></script>
    </div>

    <p id="latlng" style="text-align: center"></p>
    <div class="container-fluid mx-auto">
        <div class="row justify-content-center">
            <div class="top-section col-xl-8 col-lg-9 col-md-10 col-12 text-center mb-5">
                <div class="current-rating">
                    <h2 class="average-rating">(avg rating)</h2>
                    <h2 class="out-of">out of 5</h2>
                </div>
                <div class="review-for text-center">
                    <h3 class="reviews-for">Reviews for (enter area here)</h3>
                    <h4 class="reviews-by">Reviewed by (enter user count)</h4>
                </div>
            </div>

            <form class="rating" method="post" action="/review">
                @csrf
                <input type="hidden" value="" id="latAndLon" name="location"/>
                <h3 class="rating-title text-center">Please review:
                    <div class="rating-list">
                        <input class="rating__input rating-1" id="rating-1-2" type="radio" value="1" name="rating" /><label class="rating__label rating--1" for="rating-1-2"><i class="fa fa-times" aria-hidden="true"></i></label>
                        <input class="rating__input rating-2" id="rating-2-2" type="radio" value="2" name="rating" /><label class="rating__label rating--2" for="rating-2-2"><i class="fa fa-frown-o" aria-hidden="true"></i></label>
                        <input class="rating__input rating-3" id="rating-3-2" type="radio" value="3" name="rating" /><label class="rating__label rating--3" for="rating-3-2"><i class="fa fa-meh-o" aria-hidden="true"></i></label>
                        <input class="rating__input rating-4" id="rating-4-2" type="radio" value="4" name="rating" /><label class="rating__label rating--4" for="rating-4-2"><i class="fa fa-smile-o" aria-hidden="true"></i></label>
                        <input class="rating__input rating-5" id="rating-5-2" type="radio" value="5" name="rating" /><label class="rating__label rating--5" for="rating-5-2"><i class="fa fa-heart" aria-hidden="true"></i></label>
                    </div>
                </h3>
                <div class="form-group text-center">
                    <label for="description"> Describe the safety of the area: </label>
                    <textarea class="form-control" placeholder="Description" name="description"></textarea>
                    <button class="submit btn btn-primary">Submit Review</button>
                </div>
            </form>
        </div>
    </div>

@endsection
