<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseMultipleChoiceQuestionSet extends Model
{
    use HasFactory;
    public $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'date' => 'date',
    ];

    public function responses()
    {
        return $this->hasMany(UserCourseMultipleChoiceQuestionSetResponse::class, 'user_course_multiple_choice_question_set_id', 'id');
    }

    public function fetchResponse(MultipleChoiceQuestion $question)
    {
        $current_result = $this->responses()->where('multiple_choice_question_id', '=', $question->id)->first();

        if (!$current_result) {
            return null;
        }

        return $current_result->answer;
    }

    public function getAnswer(MultipleChoiceQuestion $question)
    {
        return $this->responses()->where('multiple_choice_question_id', '=', $question->id)->first();
    }

    public function markAsCompleted()
    {
        $this->is_complete = 1;
        $this->completed_at = now();
        $this->save();

        return $this;
    }

    public function recordResult(MultipleChoiceQuestion $question, $user_response)
    {
        if ($this->completed_at) {
            return null;
        }

        $current_result = $this->responses()->where('multiple_choice_question_id', '=', $question->id)->first();
        if (!$current_result) {
            $current_result = new UserCourseMultipleChoiceQuestionSetResponse();
            $current_result->user_id = $this->user_id;
            $current_result->user_course_multiple_choice_question_set_id = $this->id;
            $current_result->multiple_choice_question_id = $question->id;
        }

        $answer = $question->answers()->find($user_response);
        if ($answer) {
            $current_result->score = $answer->is_correct;
        } else {
            $current_result->score = false;
        }
        $current_result->answer = $user_response;

        $current_result->save();
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'id');
    }

    public function mcq()
    {
        return $this->belongsTo(MultipleChoiceQuestionSet::class, 'multiple_choice_question_set_id', 'id');
    }

    public function combinedDateTime()
    {
        return Carbon::parse($this->date->format('Y-m-d') . $this->time);
    }

    public function isFuture()
    {
        if ($this->combinedDateTime() > now()) {
            return true;
        }

        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
