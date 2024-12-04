<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ToolResourceTopic;
use Illuminate\Http\Request;

class ToolResourceTopicController extends Controller
{
    public function index(Request $request)
    {
        $builder = ToolResourceTopic::query();

        if ($request->has('search') && $request->input('search')) {
            $search = '%' . $request->input('search') . '%';

            $builder->where(function ($query) use ($search) {
                return $query->where('title', 'LIKE', $search)
                    ->orWhere('content', 'LIKE', $search)
                    ->orWhere('slug', 'LIKE', $search);
            });
        }

        $topics = $builder->paginate(20);

        return view(
            'admin.tools-and-resources-topics.list',
            [
                'topics' => $topics
            ]
        );
    }

    public function add(Request $request)
    {
        return view('admin.tools-and-resources-topics.add');
    }

    public function edit(Request $request, ToolResourceTopic $tool_resource_topic)
    {
        return view('admin.tools-and-resources-topics.edit', ['topic' => $tool_resource_topic]);
    }

    public function delete(Request $request, ToolResourceTopic $tool_resource_topic)
    {
        $tool_resource_topic->delete();

        return redirect()->route('admin.tools-and-resources-topics')->with(['success' => 'Topic Deleted.']);
    }
}
