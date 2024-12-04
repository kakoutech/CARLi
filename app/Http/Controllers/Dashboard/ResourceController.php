<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{

    public function view(Request $request, Resource $resource)
    {
        //abort_unless(user()->canView('courses.resources.view'), 403);

        $response = Response::make(Storage::get($resource->path), 200);

        $response->header('Content-Type', $resource->mime);

        return $response;
    }
}
