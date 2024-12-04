<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageManagementController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('cms.index'), 403);

        $builder = Page::query();

        $builder->maybePerformSearch($request->input('search'));

        $pages = $builder->paginate(20);

        return view(
            'dashboard.cms.list',
            [
                'pages' => $pages
            ]
        );
    }
    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('cms.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = Page::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.cms')->with(['success' => $count . ' Items Deleted.']);
    }

    public function deleted(Request $request)
    {
        abort_unless(user()->canView('cms.deleted'), 403);

        $builder = Page::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->withTrashed();

        $builder->where('deleted_at', '!=', null);

        $pages = $builder->paginate(20);

        return view(
            'dashboard.cms.deleted',
            [
                'pages' => $pages
            ]
        );
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('cms.add'), 403);

        return view('dashboard.cms.add');
    }

    public function edit(Request $request, Page $page)
    {
        abort_unless(user()->canView('cms.edit'), 403);

        return view('dashboard.cms.edit', ['page' => $page]);
    }

    public function delete(Request $request, Page $page)
    {
        abort_unless(user()->canView('cms.delete'), 403);

        $page->delete();

        return redirect()->route('dashboard.cms')->with(['success' => 'Page Deleted.']);
    }

    public function restore(Request $request, Page $page)
    {
        abort_unless(user()->canView('cms.restore'), 403);

        $page->restore();

        return redirect()->route('dashboard.cms')->with(['success' => 'Page Restored.']);
    }
}
