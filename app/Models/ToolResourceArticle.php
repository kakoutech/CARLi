<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ToolResourceArticle extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function getImage()
    {
        if ($this->cover) {
            return asset(str_replace('public', 'storage', $this->cover));
        }
        
        return asset('assets/img/default-tools-and-resources-image.jpg');
    }
    
    public function hasUpload()
    {
        return $this->uploads ? true : false;
    }

    public function getFile()
    {
        return asset(str_replace('public', 'storage', $this->uploads));
    }

    public function isVideo()
    {
        return strtolower($this->format) == 'video';
    }

    public function isImage()
    {
        return strtolower($this->format) == 'image';
    }

    public function isAudio()
    {
        return strtolower($this->format) == 'audio';
    }

    public function isPdf()
    {
        return strtolower($this->format) == 'pdf';
    }


    public function topic()
    {
        return $this->belongsTo(ToolResourceTopic::class, 'tool_resource_topic_id', 'id');
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function getFormat()
    {
        return strtoupper($this->format);
    }

    public function getContent()
    {
        $content = $this->content;
        $content = str_replace("&lt;iframe", '<iframe', $content);
        $content = str_replace("&gt;&lt;/iframe&gt;", '></iframe>', $content);
        return $content;
    }

    public function getUrl()
    {
        if (!$this->slug) {
            return;
        }

        return route('tools-and-resources.view', [$this->slug]);
    }

    public function isActive()
    {
        return $this->active;
    }
}
