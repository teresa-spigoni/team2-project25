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

    public function create(Request $request)
    {
        $this->reviewValidation($request);
        $data = $request->all();
        $newReview = new Review();
        $newReview->fill($data);
        $newReview->save();

        $reviewStored = Review::orderBy('id', 'desc')->first();
        return redirect()->route('homepage', $reviewStored);
    }

    // validazione review

    protected function reviewValidation(Request $request)
    {
        $request->validate([
            'rv_name' => 'string|min:3|max:50',
            'rv_lastname' => 'nullable|string|min:3|max:50',
            'rv_vote' => 'required|numeric|min:1|max:5',
            'rv_title' => 'required|string|min:4|max:30',
            'rv_content' => 'required|string|min:10'
        ]);
    }
}
