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
        $users = User::all();
        // ritorno solo le specializzazioni che hanno un medico
        $specializations = Specialization::has('users')->get();

        return view('public.homepage', compact('users', 'specializations'));
    }

    public function toIndex(Request $request)
    {
        $selected = $request->input('specialization');
        $specializations = Specialization::has('users')->get();

        return view('public.index', compact('selected', 'specializations'));
    }

    public function saveMessage(Request $request, User $user)
    {
        $this->messageValidation($request);
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

    // validazione messaggi

    protected function messageValidation(Request $request)
    {
        $request->validate([
            'msg_name' => 'required|string|min:3|max:50',
            'msg_lastname' => 'required|string|min:3|max:50',
            'msg_email' => 'required|email',
            'msg_phone_number' => 'required|string|min:9|max:10',
            'msg_content' => 'required|string|min:30'
        ]);
    }
}
