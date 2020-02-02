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
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -34.397, lng: 150.644},
                    zoom: 8,
                    draggable: false
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPhnYv7qqmn9NK7IweTP07rggklVMCc2U&callback=initMap" async defer></script>
    </div>

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
