<?php

namespace App\Http\Controllers;

use App\Review;
use App\Helpers\ClusterHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function store(Request $request) {
        $review = new Review();
        $location = explode(',', $request->input('location'));
        $review->longitude = $location[1];
        $review->latitude = $location[0];
        $review->user_id = Auth::user()->_id;
        $review->rating = $request->input('ratings');
        $review->details = $request->input('description');
        $review->user_id = Auth::id();
        $review->save();

        // Check if can be stored into a cluster
        ClusterHelper::get_cluster($review);
        return back();
    }

    public function index() {
        return view('review.show');
    }

    public function create() {
        return view('review.create');
    }
}
