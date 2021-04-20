<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Message;
use App\Specialization;
use Illuminate\Http\Request;
use App\User;

class PrivateUserController extends Controller
{


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function showMessage($id)
    {
        $userMessages = User::find($id)->messages;
        return view('auth.message', compact('userMessages'));
    }


    public function edit(User $user)
    {
        $specs = Specialization::all();
        return view('auth.edit', compact('user', 'specs'));
    }

    public function update(Request $request, User $user)
    {
        if ($request->hasFile('profile_image')) {
            $img = $request->file('profile_image')->store('public');
            $user->profile_image = $img;
        }
        if ($request->hasFile('curriculum')) {
            $doc = $request->file('curriculum')->store('public');
            $user->curriculum = $doc;
        }
        $user->update($request->all());

        return redirect()->route('dashboard');
    }

    public function destroy(User $user)
    {
        $user->specializations()->detach();
        $user->sponsorships()->detach();
        $user->services()->delete();
        $user->messages()->delete();
        $user->reviews()->delete();
        $user->delete();
        return redirect()->route('homepage');
    }
}
