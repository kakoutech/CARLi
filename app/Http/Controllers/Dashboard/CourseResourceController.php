<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class CourseResourceController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('courses.resources.index'), 403);

        $builder = Resource::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->type('course');

        $builder->latest();

        return view(
            'dashboard.course-resources.list',
            [
                'resources' => $builder->paginate(25)
            ]
        );
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('courses.resources.add'), 403);

        return view('dashboard.course-resources.add');
    }

    public function delete(Request $request, Resource $resource)
    {
        abort_unless(user()->canView('courses.resources.delete'), 403);

        $resource->delete();

        return redirect()->route('dashboard.courses.resources')->with(['success' => 'Resource Deleted.']);
    }
}
