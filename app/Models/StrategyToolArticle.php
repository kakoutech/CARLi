<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class StrategyToolArticle extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function topic()
    {
        return $this->belongsTo(StrategyToolTopic::class, 'strategy_tool_topic_id', 'id');
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getIcon()
    {
        if ($this->icon_path) {
            return asset(str_replace('public', 'storage', $this->icon_path));
        }

        return null;
    }

    public function hasResources()
    {
        return $this->resources->count();
    }

    public function resources()
    {
        return $this->hasMany(StrategyToolArticleResource::class);
    }

    public function assignResource($resource)
    {
        $current = $this->resources()->where('resource_id', '=', $resource->id)->first();
        if ($current) {
            return $this;
        }

        $item = new StrategyToolArticleResource();
        $item->strategy_tool_article_id = $this->id;
        $item->resource_id = $resource->id;
        $item->save();

        return $this;
    }

    public function getResourceCount()
    {
        return $this->resources()->count();
    }

    public function getThumbnail()
    {
        if ($this->thumbnail_path) {
            return asset(str_replace('public', 'storage', $this->thumbnail_path));
        }

        return asset('assets/img/default-strategy-tools-image.jpg');
    }

    public function getContent()
    {
        $content = $this->content;
        $content = str_replace("&lt;iframe", '<iframe', $content);
        $content = str_replace("&gt;&lt;/iframe&gt;", '></iframe>', $content);
        return $content;
    }

    public function getPermalink()
    {
        if (!$this->slug) {
            return;
        }

        return route('dashboard.strategy-tools.view', [$this->slug]);
    }

    public function isActive()
    {
        return $this->active;
    }
}
