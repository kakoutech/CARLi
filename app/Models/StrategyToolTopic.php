<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class StrategyToolTopic extends Model
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

    public function isActive()
    {
        return $this->active;
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

    public function articles()
    {
        return $this->hasMany(StrategyToolArticle::class, 'strategy_tool_topic_id', 'id');
    }

    public function getArticleCount()
    {
        return $this->articles()->count();
    }
}
