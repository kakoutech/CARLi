<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    public function scopeType($query, $type)
    {
        return $query->where('type', '=', $type);
    }

    public function scopeMaybePerformSearch($query, $search)
    {
        if ($search) {
            $search = '%' . $search . '%';

            $query->where(function ($query) use ($search) {
                return $query->where('filename', 'LIKE', $search);
            });
        }

        return $query;
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getPermalink()
    {
        return route('dashboard.resource', [$this->id]);
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getFile()
    {
        return $this->getPermalink();
    }

    public function isEmbed()
    {
        return $this->embed ? true : false;
    }

    public function getEmbed()
    {
        return $this->embed;
    }

    public function isVideo()
    {
        return strpos($this->mime, 'video') !== false;
    }

    public function isImage()
    {
        return strpos($this->mime, 'image') !== false;
    }

    public function isAudio()
    {
        return strpos($this->mime, 'audio') !== false;
    }

    public function isPdf()
    {
        return strpos($this->mime, 'pdf') !== false;
    }

    public function getFormat()
    {
        return strtoupper($this->extension);
    }

    public function getSize()
    {
        return ceil($this->size / 1000) . ' KB';
    }

    public function getThumbnail()
    {
        if (strpos($this->mime, 'image') !== false) {
            return asset(str_replace('public', 'storage', $this->path));
        }

        return asset('assets/img/default-tools-and-resources-image.jpg');
    }
}
