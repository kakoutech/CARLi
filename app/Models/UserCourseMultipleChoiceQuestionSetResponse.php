<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseMultipleChoiceQuestionSetResponse extends Model
{
    use HasFactory;

    public function theAnswer()
    {
        return $this->belongsTo(MultipleChoiceQuestionAnswer::class, 'answer', 'id');
    }
}
