<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.show');
    }
}
