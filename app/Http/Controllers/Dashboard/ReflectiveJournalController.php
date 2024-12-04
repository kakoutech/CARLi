<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ReflectiveJournalEntryResponse;
use App\Models\ReflectiveJournalStep;
use Illuminate\Http\Request;

class ReflectiveJournalController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(user()->canView('reflective-journal.index'), 403);

        $builder = ReflectiveJournalStep::query();

        if ($request->has('search') && $request->input('search')) {
            $search = '%' . $request->input('search') . '%';

            $builder->where(function ($query) use ($search) {
                return $query->where('title', 'LIKE', $search)
                    ->orWhere('content', 'LIKE', $search)
                    ->orWhere('slug', 'LIKE', $search);
            });
        }

        $builder->orderBy('order', 'ASC');

        $steps = $builder->paginate(100);

        return view(
            'dashboard.reflective-journal.list',
            [
                'steps' => $steps
            ]
        );
    }

    public function massDelete(Request $request)
    {
        abort_unless(user()->canView('reflective-journal.delete'), 403);

        $count = 0;
        $ids = explode(',', $request->input('ids'));
        foreach ($ids as $id) {
            $item = ReflectiveJournalStep::find($id);
            if ($item) {
                $count++;
                $item->delete();
            }
        }

        return redirect()->route('dashboard.reflective-journal')->with(['success' => $count . ' Items Deleted.']);
    }

    public function viewAudio(Request $request, ReflectiveJournalEntryResponse $reflective_journal_entry)
    {
        if (auth()->user()->isLearner() && auth()->user()->id != $reflective_journal_entry->user_id) {
            abort(403);
        }

        if (auth()->user()->isTrainer() && $reflective_journal_entry->entry->user->trainer_id != auth()->user()->id) {
            abort(403);
        }

        return response()->file(storage_path('app/' . $reflective_journal_entry->audio));
    }

    public function viewFile(Request $request, ReflectiveJournalEntryResponse $reflective_journal_entry)
    {
        if (auth()->user()->isLearner() && auth()->user()->id != $reflective_journal_entry->user_id) {
            abort(403);
        }

        if (auth()->user()->isTrainer() && $reflective_journal_entry->entry->user->trainer_id != auth()->user()->id) {
            abort(403);
        }

        return response()->file(storage_path('app/' . $reflective_journal_entry->file));
    }

    public function add(Request $request)
    {
        abort_unless(user()->canView('reflective-journal.add'), 403);

        return view('dashboard.reflective-journal.add');
    }

    public function edit(Request $request, ReflectiveJournalStep $reflective_journal_step)
    {
        abort_unless(user()->canView('reflective-journal.edit'), 403);

        return view('dashboard.reflective-journal.edit', ['step' => $reflective_journal_step]);
    }

    public function delete(Request $request, ReflectiveJournalStep $reflective_journal_step)
    {
        abort_unless(user()->canView('reflective-journal.delete'), 403);

        $reflective_journal_step->delete();

        return redirect()->route('dashboard.reflective-journal')->with(['success' => 'Reflective Journal Step Deleted.']);
    }
}
