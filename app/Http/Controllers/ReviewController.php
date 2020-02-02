<?php

namespace App\Http\Controllers;

use App\Review;
use App\Helpers\ClusterHelper;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function store(Request $request) {
        $review = new Review();
        $location = explode(',', $request->input('location'));
        $review->longitude = $location[0];
        $review->latitude = $location[1];
        $review->rating = $request->input('rating');
        $review->details = $request->input('description');
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
