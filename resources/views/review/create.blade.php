@extends('layouts.app')

@include('layouts.navbar')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

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

            <form class="rating">
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
                    <textarea class="form-control" placeholder="Description"></textarea>
                    <button class="submit btn btn-primary">Submit Review</button>
                </div>
            </form>
        </div>
    </div>


@endsection
