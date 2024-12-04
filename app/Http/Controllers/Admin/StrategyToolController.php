<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrategyToolArticle;
use Illuminate\Http\Request;

class StrategyToolController extends Controller
{
    public function index(Request $request)
    {
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
            'admin.strategy-tools.list',
            [
                'articles' => $articles
            ]
        );
    }

    public function add(Request $request)
    {
        return view('admin.strategy-tools.add');
    }

    public function edit(Request $request, StrategyToolArticle $strategy_tool_article)
    {
        return view('admin.strategy-tools.edit', ['article' => $strategy_tool_article]);
    }

    public function delete(Request $request, StrategyToolArticle $strategy_tool_article)
    {
        $strategy_tool_article->delete();

        return redirect()->route('admin.strategy-tools')->with(['success' => 'Strategy Tool Article Deleted.']);
    }
}
