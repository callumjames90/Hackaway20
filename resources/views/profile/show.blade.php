@extends('layouts.app')

@include('layouts.navbar')

@section('content')
    <div class="container">

        @foreach($reviews as $review)
            @if (Auth::user()->_id === $review->user_id)
                <div class="card mb-3">
                    <h5 class="card-header">Review ID: {{ $review->id }}</h5>
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text">{{ $review->details }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

@endsection
