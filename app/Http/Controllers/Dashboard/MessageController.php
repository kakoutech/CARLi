<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Message Controller
 * 
 * @author Benjamin Hall <ben@conobe.co.uk>
 */
class MessageController extends Controller
{
    public function list(Request $request)
    {
        return view('dashboard.messages.list');
    }
}
