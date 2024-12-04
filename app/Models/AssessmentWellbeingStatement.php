<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentWellbeingStatement extends Model
{
    use HasFactory;

    public function result(User $user)
    {
        return $user->assessmentWellbeingResults()->where('assessment_wellbeing_statement_id', '=', $this->id)->first();
    }

    public function recordResult(User $user)
    {
        $current_result = $this->result($user);
        if (!$current_result) {
            $current_result = new AssessmentWellbeingStatementResult();
            $current_result->user_id = $user->id;
            $current_result->assessment_wellbeing_id = $this->assessment_wellbeing_id;
            $current_result->assessment_wellbeing_statement_id = $this->id;
        }

        $score = $this->{'scale_' . $this->result};

        $current_result->answer = $this->result;
        $current_result->score = $score;
        $current_result->save();
    }
}
