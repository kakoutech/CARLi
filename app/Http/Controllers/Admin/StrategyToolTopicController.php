<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrategyToolTopic;
use Illuminate\Http\Request;

class StrategyToolTopicController extends Controller
{
    public function index(Request $request)
    {
        $builder = StrategyToolTopic::query();

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
            'admin.strategy-tools-topics.list',
            [
                'topics' => $topics
            ]
        );
    }

    public function add(Request $request)
    {
        return view('admin.strategy-tools-topics.add');
    }

    public function edit(Request $request, StrategyToolTopic $strategy_tool_topic)
    {
        return view('admin.strategy-tools-topics.edit', ['topic' => $strategy_tool_topic]);
    }

    public function delete(Request $request, StrategyToolTopic $strategy_tool_topic)
    {
        $strategy_tool_topic->delete();

        return redirect()->route('admin.strategy-tools-topics')->with(['success' => 'Topic Deleted.']);
    }
}
