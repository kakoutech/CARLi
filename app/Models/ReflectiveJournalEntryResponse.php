<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReflectiveJournalEntryResponse extends Model
{
    use HasFactory;

    public function entry()
    {
        return $this->belongsTo(ReflectiveJournalEntry::class, 'reflective_journal_entry_id', 'id');
    }

    public function step()
    {
        return $this->belongsTo(ReflectiveJournalStep::class, 'reflective_journal_step_id', 'id');
    }

    public function isCompleted()
    {
        return $this->response || $this->file || $this->audio;
    }

    public function getFileUrl()
    {
        return route('dashboard.reflective-journal.file', [$this->id]);
    }

    public function getAudioUrl()
    {
        return route('dashboard.reflective-journal.audio', [$this->id]);
    }
}
