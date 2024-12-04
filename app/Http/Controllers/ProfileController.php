<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $user = auth()->user();

        return view('profile', ['user' => $user]);
    }
}
