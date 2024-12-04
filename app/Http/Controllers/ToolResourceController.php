<?php

namespace App\Http\Controllers;

use App\Models\ToolResourceArticle;
use App\Models\ToolResourceTopic;
use Illuminate\Http\Request;

class ToolResourceController extends Controller
{
    public function index(Request $request)
    {
        $current_topic = null;
        if ($request->has('topic') && $request->input('topic') && $request->input('topic') != 'all') {
            $current_topic = ToolResourceTopic::where('slug', '=', $request->input('topic'))->first();
        }

        $current_format = null;
        if ($request->has('format') && $request->input('format') && $request->input('format') != 'all') {
            $current_format = strtolower($request->input('format'));
        }

        $builder = ToolResourceArticle::query();

        if ($request->has('search') && $request->input('search')) {
            $search = $request->input('search');
            $builder->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('content', 'LIKE', '%'.$search.'%');
            });
        }

        if ($current_topic) {
            $builder->where('tool_resource_topic_id', '=', $current_topic->id);
        }

        $builder->orderBy('created_at', 'DESC');

        $articles = $builder->paginate(12);

        $topics = ToolResourceTopic::all();

        $formats = getFormats();

        return view(
            'tool-resource.list',
            [
                'articles' => $articles,
                'topics' => $topics,
                'formats' => $formats,
                'current_format' => $current_format,
                'current_topic' => $current_topic,
            ]
        );
    }

    public function add(Request $request)
    {
        $this->middleware('checkAccountType:trainer');

        return view('tool-resource.add');
    }

    public function edit(Request $request, ToolResourceArticle $tool_resource_article)
    {
        $this->middleware('checkAccountType:trainer');

        return view('tool-resource.edit', ['article' => $tool_resource_article]);
    }

    public function view(Request $request, ToolResourceArticle $tool_resource_article)
    {
        return view(
            'tool-resource.view',
            [
                'article' => $tool_resource_article,
            ]
        );
    }
}
