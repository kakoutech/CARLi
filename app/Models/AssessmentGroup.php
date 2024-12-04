<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AssessmentGroup extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id', 'id');
    }

    public function statements()
    {
        return $this->hasMany(AssessmentStatement::class, 'assessment_group_id', 'id');
    }

    public function markings()
    {
        return $this->hasMany(AssessmentGroupMarking::class, 'assessment_group_id', 'id')->orderBy('score_from', 'ASC');
    }
}
