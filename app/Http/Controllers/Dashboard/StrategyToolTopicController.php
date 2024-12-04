<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\StrategyToolTopic;
use Illuminate\Http\Request;

class StrategyToolTopicController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('strategy-tools.topics.index'), 403);

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
            'dashboard.strategy-tools-topics.list',
            [
                'topics' => $topics
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('strategy-tools.topics.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = StrategyToolTopic::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.strategy-tools.topics')->with(['success' => $count . ' Items Deleted.']);
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('strategy-tools.topics.add'), 403);

        return view('dashboard.strategy-tools-topics.add');
    }

    public function edit(Request $request, StrategyToolTopic $strategy_tool_topic)
    {
        abort_unless(user()->canView('strategy-tools.topics.edit'), 403);

        return view('dashboard.strategy-tools-topics.edit', ['topic' => $strategy_tool_topic]);
    }

    public function delete(Request $request, StrategyToolTopic $strategy_tool_topic)
    {
        abort_unless(user()->canView('strategy-tools.topics.delete'), 403);

        $strategy_tool_topic->delete();

        return redirect()->route('dashboard.strategy-tools.topics')->with(['success' => 'Topic Deleted.']);
    }
}
