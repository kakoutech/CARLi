<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMultipleChoiceQuestionSet extends Model
{
    use HasFactory;

    public function mcq()
    {
        return $this->belongsTo(MultipleChoiceQuestionSet::class, 'multiple_choice_question_set_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
