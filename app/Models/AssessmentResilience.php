<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AssessmentResilience extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('question')->saveSlugsTo('slug');
    }

    public function statements()
    {
        return $this->hasMany(AssessmentResilienceStatement::class, 'assessment_resilience_id', 'id');
    }
}
