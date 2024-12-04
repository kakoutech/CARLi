<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReflectiveJournalEntry extends Model
{
    use HasFactory;

    public $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hasCompleted(ReflectiveJournalStep $step)
    {
        $response = $this->responses()->where('reflective_journal_step_id', '=', $step->id)->first();
        if (!$response) {
            return false;
        }

        return $response->isCompleted();
    }

    public function responses()
    {
        return $this->hasMany(ReflectiveJournalEntryResponse::class, 'reflective_journal_entry_id', 'id');
    }

    public function getResponse(ReflectiveJournalStep $step)
    {
        $response = $this->responses()->where('reflective_journal_step_id', '=', $step->id)->first();
        if (!$response) {
            $response = new ReflectiveJournalEntryResponse();
            $response->reflective_journal_entry_id = $this->id;
            $response->user_id = auth()->user()->id;
            $response->reflective_journal_step_id = $step->id;
            $response->save();
        }

        return $response;
    }
}
