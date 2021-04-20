<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Specialization;

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

    public function show(User $user)
    {
        return view('public.show', compact('user'));
    }

    public function create()
    {
        $specs = Specialization::all();
        return view('auth.register', compact('specs'));
    }
}
