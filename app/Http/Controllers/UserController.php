<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Specialization;
use App\Review;
use Faker\Provider\ar_JO\Internet;

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
        $specializations = Specialization::all();

        return view('public.index', compact('selected', 'specializations'));
    }

    public function saveMessage(Request $request, User $user)
    {
        $newMessage = new Message();
        $newMessage->fill($request->all());
        $newMessage->user_id = $user->id;
        $newMessage->save();
        return redirect()->route('homepage');
    }

    public function show(User $user, $spec)
    {
        $reviews = Review::all();
        return view('public.show', compact('user', 'reviews', 'spec'));
    }

    public function create()
    {
        $specs = Specialization::all();
        return view('auth.register', compact('specs'));
    }
}
