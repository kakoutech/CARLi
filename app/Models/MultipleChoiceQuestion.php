<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleChoiceQuestion extends Model
{
    use HasFactory;

    public function addAnswer($answer, $is_correct = false)
    {
        $_answer = new MultipleChoiceQuestionAnswer();
        $_answer->multiple_choice_question_id = $this->id;
        $_answer->answer = $answer;
        $_answer->is_correct = $is_correct;
        $_answer->save();

        return $_answer;
    }

    public function correctAnswers()
    {
        return $this->answers()->where('is_correct', '=', 1)->get();
    }

    public function answers()
    {
        return $this->hasMany(MultipleChoiceQuestionAnswer::class, 'multiple_choice_question_id', 'id');
    }
}
