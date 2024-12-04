<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function homepage(Request $request)
    {
        return view('homepage');
    }

    public function welcome(Request $request)
    {
        return view('welcome');
    }
}
