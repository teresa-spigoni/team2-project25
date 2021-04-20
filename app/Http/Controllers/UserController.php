<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Message;
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

    public function newMessage(User $user)
    {
        return view('public.newmessage', compact('user'));
    }

    public function saveMessage(Request $request, User $user)
    {
        $newMessage = new Message();
        $newMessage->fill($request->all());
        $newMessage->user_id = $user->id;
        // dd($newMessage);
        $newMessage->save();
        return view('public.show', compact('user'));
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
