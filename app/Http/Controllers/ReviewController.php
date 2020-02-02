<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request) {
        return back();
    }

    public function index() {
        return view('review.show');
    }

    public function create() {
        return view('review.create');
    }
}
