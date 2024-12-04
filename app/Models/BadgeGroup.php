<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BadgeGroup extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function isActive()
    {
        return $this->active;
    }

    public function settings()
    {
        return $this->hasMany(BadgeSetting::class, 'badge_group_id', 'id');
    }

    public function getName()
    {
        return $this->name;
    }
}
