<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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


    public function edit(User $user)
    {
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('show', compact('user'));
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
