<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class MultipleChoiceQuestionSet extends Model
{
    use HasFactory;
    use HasSlug;

    public function scopeMaybePerformSearch($query, $search)
    {
        if ($search) {
            $search = '%' . $search . '%';

            $query->where(function ($query) use ($search) {
                return $query->where('name', 'LIKE', $search);
            });
        }

        return $query;
    }

    public function questions()
    {
        return $this->hasMany(MultipleChoiceQuestion::class, 'multiple_choice_question_set_id', 'id');
    }

    public function getQuestionCount()
    {
        return $this->questions()->count();
    }

    public function topic()
    {
        return $this->belongsTo(CourseTopic::class, 'topic_id', 'id');
    }

    public function subtopic()
    {
        return $this->belongsTo(CourseTopic::class, 'subtopic_id', 'id');
    }

    public function getName()
    {
        return $this->name;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function addQuestion(MultipleChoiceQuestion $question)
    {
        $question->multiple_choice_question_set_id = $this->id;
        $question->save();
    }

}
