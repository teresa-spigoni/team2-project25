<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ApiUserController extends Controller
{
    public function index(Request $request)
    {
        $specialization = $request->query('specialization');
        if (isset($specialization)) {
            $filtered = User::whereHas('specializations', function ($query) use ($specialization) {
                return $query->where('specialization_id', $specialization);
            })->get();
        } else {
            $filtered = User::all();
        }
        return response()->json($filtered);
    }
}
