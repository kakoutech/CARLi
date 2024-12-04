<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function view(Request $request, $stub_1 = null, $stub_2 = null, $stub_3 = null, $stub_4 = null)
    {
        $stubs = [];
        if ($stub_1) {
            $stubs[] = $stub_1;
        }
        if ($stub_2) {
            $stubs[] = $stub_2;
        }
        if ($stub_3) {
            $stubs[] = $stub_3;
        }
        if ($stub_4) {
            $stubs[] = $stub_4;
        }

        $stub = implode('/', $stubs);

        $page = Page::where('path', '=', $stub)->first();
        if (!$page) {
            abort(404);
        }

        if (!$page->active) {
            abort(404);
        }

        return view('page', ['page' => $page]);
    }
}
