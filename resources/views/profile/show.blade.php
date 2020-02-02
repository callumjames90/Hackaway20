@extends('layouts.app')

@include('layouts.navbar')

@section('content')
    <div class="container">
        <div class="icon-header">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
        </div>

        <h2 class="info-display">{{ Auth::user()->name }}</h2>
        <h5 class="info-display">{{ Auth::user()->email }}</h5>

        @foreach(Auth::user()->reviews as $review)
            @if (Auth::user()->_id === $review->user_id)
                <div class="card mb-3 border-dark">
                    <h5 class="card-header">Review {{ count(Auth::user()->reviews) - $loop->index }} - Rated: {{ $review->rating }}</h5>
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text">{{ $review->details }}</p>
                    </div>
                    <div class="card-footer rev">Reviewed: {{ $review->created_at }}</div>
                    <div class="card-footer">ID: {{ $review->id }}</div>
                </div>
            @endif
        @endforeach
    </div>

@endsection
