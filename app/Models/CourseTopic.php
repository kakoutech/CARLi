<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CourseTopic extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;

    public function scopeMaybePerformSearch($query, $search)
    {
        if ($search) {
            $search = '%' . $search . '%';

            $query->where(function ($query) use ($search) {
                return $query->where('name', 'LIKE', $search)
                    ->orWhere('slug', 'LIKE', $search);
            });
        }

        return $query;
    }

    public function parent()
    {
        return $this->belongsTo(CourseTopic::class, 'parent_id', 'id');
    }

    public function getIcon()
    {
        if ($this->icon_path) {
            return asset(str_replace('public', 'storage', $this->icon_path));
        }

        return null;
    }

    public function getThumbnail()
    {
        if ($this->thumbnail_path) {
            return asset(str_replace('public', 'storage', $this->thumbnail_path));
        }

        return null;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function getName()
    {
        return $this->name;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function getCourseCount()
    {
        return $this->courses()->count();
    }
}
