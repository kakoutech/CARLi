<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentResponse extends Model
{
    use HasFactory;

    public $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function responses()
    {
        return $this->hasMany(AssessmentStatementResponse::class, 'assessment_response_id', 'id');
    }

    public function fetchResponse(AssessmentStatement $statement)
    {
        $current_result = $this->responses()->where('assessment_statement_id', '=', $statement->id)->first();
        //dd($current_result);
        if (! $current_result) {
            return null;
        }

        return $current_result->answer;
    }

    public function getMarking(AssessmentGroup $group)
    {
        $score_breakdown = [];

        $statment_ids = $group->statements()->pluck('id');
        $responses = $this->responses()->whereIn('assessment_statement_id', $statment_ids)->get();
        $group_score = 0;
        if ($responses && $responses->count()) {
            foreach ($responses as $response) {
                $score_breakdown[] = $response->explanation();
                $group_score += $response->score;
            }
        }

        $markings = $group->markings()->where('score_from', '<=', $group_score)->where('score_to', '>=', $group_score)->get();

        $marking_response = [];

        foreach ($markings as $marking) {
            $marking_response[$marking->name] = [
                $marking->pre_explanation,
                $score_breakdown,
                $marking->post_explanation,
            ];
        }

        return $marking_response;
    }

    public function markAsCompleted()
    {
        $this->completed_at = now();
        $this->save();
    }

    public function recordResult(AssessmentStatement $statement, $user_response)
    {
        if ($this->completed_at) {
            return null;
        }

        $current_result = $this->responses()->where('assessment_statement_id', '=', $statement->id)->first();
        if (! $current_result) {
            $current_result = new AssessmentStatementResponse();
            $current_result->assessment_response_id = $this->id;
            $current_result->user_id = $this->user_id;
            $current_result->assessment_id = $statement->assessment_id;
            $current_result->assessment_statement_id = $statement->id;
        }

        $score = $statement->{'scale_'.$statement->user_response};

        $current_result->answer = $user_response;
        $current_result->score = $score;

        $current_result->save();
    }
}
