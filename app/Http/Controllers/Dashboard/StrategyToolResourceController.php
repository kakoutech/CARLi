<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class StrategyToolResourceController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('strategy-tools.resources.index'), 403);

        $builder = Resource::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->type('strategy');

        $builder->latest();

        return view(
            'dashboard.strategy-tool-resources.list',
            [
                'resources' => $builder->paginate(25)
            ]
        );
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('strategy-tools.resources.add'), 403);

        return view('dashboard.strategy-tool-resources.add');
    }

    public function view(Request $request, Resource $resource)
    {
        abort_unless(user()->canView('strategy-tools.resources.view'), 403);

        $response = Response::make(Storage::get($resource->path), 200);
        $response->header('Content-Type', $resource->mime);
        return $response;
    }

    public function delete(Request $request, Resource $resource)
    {
        abort_unless(user()->canView('strategy-tools.resources.delete'), 403);

        $resource->delete();

        return redirect()->route('dashboard.strategy-tools.resources')->with(['success' => 'Resource Deleted.']);
    }
}
