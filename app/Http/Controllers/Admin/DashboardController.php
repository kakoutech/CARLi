<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('admin.dashboard');
    }

    public function dashboard(Request $request)
    {
        return view('admin.dashboard');
    }

    public function profile(Request $request)
    {
        $user = auth()->user();

        return view('admin.profile', ['user' => $user]);
    }
}
