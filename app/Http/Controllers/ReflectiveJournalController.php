<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Frontend\ReflectiveJournal;
use App\Models\ReflectiveJournalEntry;
use App\Models\ReflectiveJournalEntryResponse;
use App\Models\ReflectiveJournalStep;
use App\Models\StrategyToolArticle;
use App\Models\StrategyToolTopic;
use Illuminate\Http\Request;

class ReflectiveJournalController extends Controller
{
    public function index(Request $request)
    {
        $entries = auth()->user()->journals()->paginate(20);

        return view(
            'reflective-journal.index',
            [
                'user' => auth()->user(),
                'entries' => $entries
            ]
        );
    }

    public function edit(Request $request, ReflectiveJournalEntry $reflective_journal_entry)
    {
        if (auth()->user()->id != $reflective_journal_entry->user_id) {
            abort(404);
        }

        $journal_steps = ReflectiveJournalStep::orderBy('order')->get();
        
        return view(
            'reflective-journal.edit',
            [
                'user' => auth()->user(),
                'journal_steps' => $journal_steps,
                'journal_entry' => $reflective_journal_entry
            ]
        );
    }

    public function viewAudio(Request $request, ReflectiveJournalEntryResponse $reflective_journal_entry)
    {
        if (auth()->user()->id != $reflective_journal_entry->user_id) {
            abort(404);
        }

        return response()->file(storage_path('app/' . $reflective_journal_entry->audio));
    }

    public function viewFile(Request $request, ReflectiveJournalEntryResponse $reflective_journal_entry)
    {
        if (auth()->user()->id != $reflective_journal_entry->user_id) {
            abort(404);
        }

        return response()->file(storage_path('app/' . $reflective_journal_entry->audio));
    }

    public function create(Request $request)
    {
        $journal_steps = ReflectiveJournalStep::orderBy('order')->get();
        $journal_record = ReflectiveJournalEntry::where('user_id', '=', auth()->user()->id)->where('completed_at', '=', null)->orderBy('created_at', 'DESC')->first();
        if (!$journal_record) {
            $journal_record = new ReflectiveJournalEntry();
            $journal_record->user_id = auth()->user()->id;
            $journal_record->save();
        }

        return view(
            'reflective-journal.main',
            [
                'user' => auth()->user(),
                'journal_steps' => $journal_steps,
                'journal_entry' => $journal_record
            ]
        );
    }
}
