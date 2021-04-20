<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Specialization;
use App\Review;

class UserController extends Controller
{
    public function home()
    {
        $specs = Specialization::all();
        return view('public.homepage', compact('specs'));
    }

    public function toIndex(Request $request)
    {
        $selected = $request->input('specialization');

        return view('public.index', compact('selected'));
    }

    public function show(User $user)
    {
        $reviews = Review::all();
        return view('public.show', compact('user', 'reviews'));
    }

    public function create()
    {
        $specs = Specialization::all();
        return view('auth.register', compact('specs'));
    }
}
