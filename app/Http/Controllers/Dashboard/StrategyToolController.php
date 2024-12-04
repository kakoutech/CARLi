<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\StrategyToolArticle;
use App\Models\StrategyToolTopic;
use Illuminate\Http\Request;

class StrategyToolController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('strategy-tools.index'), 403);

        $builder = StrategyToolArticle::query();

        if ($request->has('search') && $request->input('search')) {
            $search = '%' . $request->input('search') . '%';

            $builder->where(function ($query) use ($search) {
                return $query->where('title', 'LIKE', $search)
                    ->orWhere('content', 'LIKE', $search)
                    ->orWhere('slug', 'LIKE', $search);
            });
        }

        $builder->orderBy('created_at', 'DESC');

        $articles = $builder->paginate(20);

        return view(
            'dashboard.strategy-tools.list',
            [
                'articles' => $articles
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('strategy-tools.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = StrategyToolArticle::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.strategy-tools.articles')->with(['success' => $count . ' Items Deleted.']);
    }

    public function learnerList(Request $request)
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
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('content', 'LIKE', '%' . $search . '%');
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
            'dashboard.strategy-tools.learner-list',
            [
                'articles' => $articles,
                'topics' => $topics,
                'formats' => $formats,
                'current_format' => $current_format,
                'current_topic' => $current_topic,
            ]
        );
    }

    public function learnerView(Request $request, StrategyToolArticle $strategy_tool_article)
    {
        return view(
            'dashboard.strategy-tools.learner-view',
            [
                'article' => $strategy_tool_article,
            ]
        );
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('strategy-tools.add'), 403);

        return view('dashboard.strategy-tools.add');
    }

    public function edit(Request $request, StrategyToolArticle $strategy_tool_article)
    {
        abort_unless(user()->canView('strategy-tools.edit'), 403);

        return view('dashboard.strategy-tools.edit', ['article' => $strategy_tool_article]);
    }

    public function view(Request $request, StrategyToolArticle $strategy_tool_article)
    {
        abort_unless(user()->canView('strategy-tools.view'), 403);

        return view('dashboard.strategy-tools.view', ['article' => $strategy_tool_article]);
    }

    public function delete(Request $request, StrategyToolArticle $strategy_tool_article)
    {
        abort_unless(user()->canView('strategy-tools.delete'), 403);

        $strategy_tool_article->delete();

        return redirect()->route('dashboard.strategy-tools')->with(['success' => 'Strategy Tool Article Deleted.']);
    }
}
