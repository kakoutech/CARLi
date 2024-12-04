<?php

namespace App\Http\Controllers;

use App\Models\StrategyToolArticle;
use App\Models\StrategyToolTopic;
use Illuminate\Http\Request;

class StrategyToolController extends Controller
{
    public function index(Request $request)
    {
        $current_topic = null;
        if ($request->has('topic') && $request->input('topic') && $request->input('topic') != 'all') {
            $current_topic = StrategyToolTopic::where('slug', '=', $request->input('topic'))->first();
        }

        $current_format = null;
        if ($request->has('format') && $request->input('format') && $request->input('format') != 'all') {
            foreach (getFormats() as $format) {
                if (strtolower($format) == strtolower($request->input('format'))) {
                    $current_format = $format;
                }
            }
        }

        $builder = StrategyToolArticle::query();

        if ($request->has('search') && $request->input('search')) {
            $search = $request->input('search');
            $builder->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('content', 'LIKE', '%'.$search.'%');
            });
        }

        if ($current_topic) {
            $builder->where('strategy_tool_topic_id', '=', $current_topic->id);
        }

        if ($current_format) {
            $builder->where('format', '=', $current_format);
        }

        $builder->orderBy('created_at', 'DESC');

        $articles = $builder->paginate(12);

        $topics = StrategyToolTopic::all();

        $formats = getFormats();

        return view(
            'strategy-tool.list',
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

        return view('strategy-tool.add');
    }

    public function edit(Request $request, StrategyToolArticle $strategy_tool_article)
    {
        $this->middleware('checkAccountType:trainer');

        return view('strategy-tool.edit', ['article' => $strategy_tool_article]);
    }

    public function view(Request $request, StrategyToolArticle $strategy_tool_article)
    {
        return view(
            'strategy-tool.view',
            [
                'article' => $strategy_tool_article,
            ]
        );
    }
}
