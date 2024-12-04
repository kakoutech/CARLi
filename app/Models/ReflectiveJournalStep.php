<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ReflectiveJournalStep extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function submissions()
    {
        return $this->hasMany(ReflectiveJournalEntryResponse::class, 'reflective_journal_step_id', 'id');
    }

    public function getSubmissionCount()
    {
        return $this->submissions()->count();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function isActive()
    {
        return $this->active;
    }
}
