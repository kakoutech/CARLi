<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Badge extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function getName()
    {
        return $this->name;
    }

    public function badgeLevels()
    {
        return $this->hasMany(BadgeLevel::class, 'badge_id', 'id');
    }

    public function levels()
    {
        return $this->hasMany(BadgeLevel::class, 'badge_id', 'id');
    }

    public function isActive()
    {
        return $this->active;
    }

}
