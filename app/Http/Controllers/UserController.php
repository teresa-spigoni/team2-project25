<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $specialization = $request->query('specialization');
        // if (isset($specialization)) {
        //     $filtered = User::whereHas('specializations', function ($query) use ($specialization) {
        //         return $query->where('specialization_id', $specialization);
        //     })->get();
        // } else {
        //     $filtered = User::all();
        // }
        // return response()->json($filtered);
        $users = User::all();
        return view('public.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('public.show', compact('user'));
    }
}
