<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $builder = Page::query();

        if ($request->has('search') && $request->input('search')) {
            $search = '%' . $request->input('search') . '%';

            $builder->where(function ($query) use ($search) {
                return $query->where('name', 'LIKE', $search)
                    ->orWhere('path', 'LIKE', $search)
                    ->orWhere('slug', 'LIKE', $search);
            });
        }

        $pages = $builder->paginate(20);

        return view(
            'admin.pages.list',
            [
                'pages' => $pages
            ]
        );
    }

    public function add(Request $request)
    {
        return view('admin.pages.add');
    }

    public function edit(Request $request, Page $page)
    {
        return view('admin.pages.edit', ['page' => $page]);
    }

    public function delete(Request $request, Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages')->with(['success' => 'Page Deleted.']);
    }
}
