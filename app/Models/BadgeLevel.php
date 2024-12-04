<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BadgeLevel extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function userBadges()
    {
        return $this->hasMany(UserBadge::class, 'badge_level_id', 'id');
    }

    public function learners()
    {
        return $this->hasMany(UserBadge::class, 'badge_level_id', 'id');
    }

    public function getLearnerCount()
    {
        return $this->learners()->count();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImage()
    {
        if (!$this->image_path) {
            return asset('assets/badges/1.png');
        }

        return asset($this->image_path);
    }

    public function getCondition()
    {
        return $this->condition;
    }

    public function isActive()
    {
        return $this->active;
    }

}
