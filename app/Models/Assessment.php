<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Assessment extends Model
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

    public function getImage()
    {
        if ($this->image_path) {
            return asset(str_replace('public', 'storage', $this->image_path));
        }

        return asset('assets/img/assessment-hub.png');
    }

    public function groups()
    {
        return $this->hasMany(AssessmentGroup::class, 'assessment_id', 'id');
    }

    public function statements()
    {
        return $this->hasMany(AssessmentStatement::class, 'assessment_id', 'id');
    }

    public function getGroupCount()
    {
        return $this->groups()->count();
    }

    public function getQuestionCount()
    {
        return $this->statements()->count();
    }

    public function responses()
    {
        return $this->hasMany(AssessmentResponse::class, 'assessment_id', 'id');
    }

    public function getResponseCount()
    {
        return $this->responses()->count();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function assessmentResponses()
    {
        return $this->hasMany(AssessmentResponse::class, 'assessment_id', 'id');
    }

    public function isActive()
    {
        return $this->active;
    }
}
