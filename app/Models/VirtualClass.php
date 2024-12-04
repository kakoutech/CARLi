<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class VirtualClass extends Model
{
    use HasFactory;
    use HasSlug;

    protected $casts = [
        'start_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function scopeMaybePerformSearch($query, $search)
    {
        if ($search) {
            $search = '%' . $search . '%';

            $query->where(function ($query) use ($search) {
                return $query->where('title', 'LIKE', $search)
                    ->orWhere('description', 'LIKE', $search);
            });
        }

        return $query;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getThumbnail()
    {
        return $this->getImage();
    }

    public function getImage()
    {
        if ($this->thumbnail_path) {
            return asset(str_replace('public', 'storage', $this->thumbnail_path));
        }

        return asset('assets/img/default-tools-and-resources-image.jpg');
    }

    public function getAttendeeCount()
    {
        return $this->attendees()->count();
    }

    public function isSingle()
    {
        return $this->class_type == 'single';
    }

    public function getRecurrence()
    {
        return ucwords($this->recurrence);
    }

    public function isRecurring()
    {
        return $this->class_type == 'recurring';
    }

    public function getAttachmentCount()
    {
        return $this->attachments()->count();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function isPublic()
    {
        return $this->view_scope == 0;
    }

    public function isPrivate()
    {
        return $this->view_scope;
    }

    public function getViewScope()
    {
        return $this->isPublic() ? 'Public' : 'Private';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function hasResources()
    {
        return $this->resources()->count();
    }

    public function resources()
    {
        return $this->hasMany(VirtualClassAttachment::class, 'virtual_class_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(VirtualClassAttachment::class, 'virtual_class_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(VirtualClassCategory::class, 'virtual_class_category_id', 'id');
    }

    public function enrollLearner(User $learner)
    {
        $current = $this->attendees()->where('learner_id', '=', $learner->id)->first();
        if (!$current) {
            $current = new VirtualClassAttendee();
            $current->virtual_class_id = $this->id;
            $current->learner_id = $learner->id;
            $current->save();

            Gamification::addVirtualClassPoints($learner);
        }

        return $current;
    }

    public function users()
    {
        return $this->hasMany(VirtualClassAttendee::class, 'virtual_class_id', 'id');
    }

    public function attendees()
    {
        return $this->hasMany(VirtualClassAttendee::class, 'virtual_class_id', 'id');
    }
}
