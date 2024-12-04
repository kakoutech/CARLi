<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReflectiveJournalStep;
use Illuminate\Http\Request;

class ReflectiveJournalStepController extends Controller
{
    public function index(Request $request)
    {
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

        $steps = $builder->paginate(20);

        return view(
            'admin.reflective-journal.list',
            [
                'steps' => $steps
            ]
        );
    }

    public function add(Request $request)
    {
        return view('admin.reflective-journal.add');
    }

    public function edit(Request $request, ReflectiveJournalStep $reflective_journal_step)
    {
        return view('admin.reflective-journal.edit', ['step' => $reflective_journal_step]);
    }

    public function delete(Request $request, ReflectiveJournalStep $reflective_journal_step)
    {
        $reflective_journal_step->delete();

        return redirect()->route('admin.reflective-journal')->with(['success' => 'Reflective Journal Step Deleted.']);
    }
}
