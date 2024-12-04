<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentStatement extends Model
{
    use HasFactory;

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(AssessmentGroup::class, 'assessment_group_id', 'id');
    }

    public function result(User $user)
    {
        return $user->assessmentPersonalityResults()->where('assessment_personality_statement_id', '=', $this->id)->first();
    }
}
