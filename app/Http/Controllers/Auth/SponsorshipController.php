<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Sponsorship;

class SponsorshipController extends Controller
{
    public function buySponsorship(User $user)
    {
        $sponsorships = Sponsorship::all();
        return view('auth.sponsorships', compact('user', 'sponsorships'));
    }

}
