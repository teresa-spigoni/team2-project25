<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{

    public function index()
    {
        return response()->json(Review::all());
    }

    public function create(Request $review)
    {
        $data = $review->all();
        $newReview = new Review();
        $newReview->fill($data);
        $newReview->save();

        $reviewStored = Review::orderBy('id', 'desc')->first();
        return redirect()->route('homepage', $reviewStored);
    }
}
