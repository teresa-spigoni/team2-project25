<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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


    public function edit(User $user)
    {
        $specs = Specialization::all();
        return view('auth.edit', compact('user', 'specs'));
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
