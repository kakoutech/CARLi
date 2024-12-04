<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    public function scopeMaybePerformSearch($query, $search)
    {
        if ($search) {
            $search = '%' . $search . '%';

            $query->where(function ($query) use ($search) {
                return $query->where('name', 'LIKE', $search)
                    ->orWhere('path', 'LIKE', $search)
                    ->orWhere('slug', 'LIKE', $search);
            });
        }

        return $query;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function getPath()
    {
        return '/' . $this->path;
    }

    public function getPermalink()
    {
        if (!$this->path){
            return;
        }

        return route('page', [$this->path]);
    }

    public function isActive()
    {
        return $this->active;
    }
}
